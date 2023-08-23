<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CodeController extends Controller
{
    //Funkcja zwracająca widok z listą kodów, dane są dodawane do widoku w Providers\AppServiceProvider.php 
    //Tutaj jest funckja z pobieraniem danych Http\View\Composer\CodeComposer.php
    public function index()
    {
        return view('codes.index');
    }

    // Funckaj wyświetlania formularza generującego kody
    public function createCode()
    {
        return view('codes.create');
    }

    // Funckaj wyświetlania formularza usuwającego kody
    public function deleteCode()
    {
        return view('codes.delete');
    }

    // Funkcja losowania unikalnego kodu
    private function generateUniqueCode()
    {
        do {
            $code = random_int(1000000000, 9999999999);
        } while (Code::where('code', $code)->exists());

        return $code;
    }

    // Funkcja pobierania wygenerowanego kodu i zapisywania do bazy
    public function storeCode(Request $request)
    {
        //Własne wiadmości w zależnośći od błędu walidacji
        $validationMessages = [
            'count.required' => 'Wprowadź liczbę',
            'count.integer' => 'Pole przyjmuje tylko liczby całkowite',
            'count.min' => 'Wprowadzona liczba musi być większa niż :min',
            'count.max' => 'Wprowadzona liczba być mniejsza niż :max',
        ];

        $request->validate([
            'count' => 'required|integer|min:1|max:10',
        ], $validationMessages);

        $count = $request->input('count');

        // Rozpoczęcie transakcji do bazy danych aby w razie błędu nie zapisywały się kody już wygenerowane
        try {
            DB::beginTransaction();

            for ($i = 0; $i < $count; $i++) {
                $uniqueCode = $this->generateUniqueCode();
                Code::create(['code' => $uniqueCode]);
            }

            DB::commit();

            return redirect()->route('code.create')->with('success', 'Kody zostały dodane');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->route('code.create')->with('error', 'Wystąpił błąd podczas zapisu kodów.');
        }
    }

    // Funkcja usuwania kodów
    public function deleteCodes(Request $request)
    {
        $request->validate([
            'codes' => 'required',
        ]);

        $inputCodes = preg_split('/[\s,]+/', $request->input('codes'));
        $invalidCodes = [];
        $missingCodes = [];

        // Sprawdzanie poprawności kodów i istnienia w bazie
        foreach ($inputCodes as $code) {
            if (!preg_match('/^\d{10}$/', $code)) {
                $invalidCodes[] = $code;
            } elseif (!Code::where('code', $code)->exists()) {
                $missingCodes[] = $code;
            }
        }

        if (count($invalidCodes) > 0) {
            return back()->with('warning', 'Niepoprawne kody: ' . implode(', ', $invalidCodes));
        }

        if (count($missingCodes) > 0) {
            return back()->with('warning', 'Nie znaleziono następujących kodów w bazie danych: ' . implode(', ', $missingCodes));
        }

        // Rozpoczęcie transakcji do bazy danych
        try {
            DB::beginTransaction();

            Code::whereIn('code', $inputCodes)->delete();

            DB::commit();

            return back()->with('success', 'Kody zostały usunięte.');
        } catch (Exception $e) {
            DB::rollback();

            return back()->with('error', 'Wystąpił błąd podczas usuwania kodów.');
        }
    }
}
