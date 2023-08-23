<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function deleteUser()
    {
        $id = auth()->user()->id;

        $user = User::find($id);

        $user->delete();

        return redirect()->route('login')->with('success', 'Użytkownik został pomyślnie usunięty');
    }
}
