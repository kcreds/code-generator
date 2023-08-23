@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <h2>Dodaj nowy kod</h2>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form class="mt-4" method="POST" action="{{ route('code.store') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="num_codes">Liczba kodów do wygenerowania:</label>
                                <input class="form-control" type="number" name="num_codes" min="1" max="10"
                                    required>
                            </div>
                            <button class="btn btn-primary" type="submit">Generuj kody</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
