@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('You are logged in!') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="mt-1">
                            <h3>Lista kodów</h3>

                            @if ($codes->isEmpty())
                                Brak kodów w bazie danych
                            @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Kod</th>
                                            <th>Data utworzenia</th>
                                            <th>Wygenerowany przez</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($codes as $code)
                                            <tr>
                                                <td>{{ $code->id }}</td>
                                                <td>{{ $code->code }}</td>
                                                <td>{{ $code->created_at }}</td>
                                                <td>{{ $code->user->email }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
