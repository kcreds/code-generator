@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2>Usuń kody</h2>

                        @if (session('warning'))
                            <div class="alert alert-warning">{{ session('warning') }}</div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('codes.delete') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="codes">Podaj kody (oddzielone przecinkami lub enterami):</label>
                                <textarea name="codes" id="codes" class="form-control" rows="4" required>{{ old('codes') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-danger mt-3">Usuń kody</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
