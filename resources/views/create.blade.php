@extends('layouts.app')

@section('title')
    Agenda - Nouveau contact
@endsection

@section('content')
    <h1 class="text-center my-3 display-5">Nouveau contact</h1>

    <div class="container my-5">
        <form action="{{ route('store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="full_name">Nom complet</label>
                <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name') }}">
                <div class="text-danger">{{ $errors->first('full_name') }}</div>
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
                <div class="text-danger">{{ $errors->first('email') }}</div>
            </div>
            <div class="mb-3">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" class="form-control" value="{{ old('age') }}">
                <div class="text-danger">{{ $errors->first('age') }}</div>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-success" />
            </div>
        </form>
    </div>
@endsection