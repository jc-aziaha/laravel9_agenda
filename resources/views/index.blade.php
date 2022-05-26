@extends('layouts.app')

@section('title')
    Agenda - Liste des contacts
@endsection

@section('content')
    <h1 class="display-5 my-3 text-center">Liste des contacts</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('danger'))
        <div class="alert alert-danger" role="alert">
            {{ session('danger') }}
        </div>
    @endif

    <div class="d-flex justify-content-end align-items-center my-3">
        <a href="{{ route('create') }}" class="btn btn-primary">Nouveau contact</a>
    </div>

    @if (count($contacts) == 0)
        <p class="lead text-center">Aucun contact ajouté à la liste pour l'instant</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom complet</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Options</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->full_name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->age ?? '---' }}</td>
                            <td>
                                <a href="{{ route('edit', $contact->id) }}" class="p-1 btn btn-sm btn-secondary">Modifer</a>
                                <form action="{{ route('delete', $contact->id) }}" method="POST" class="p-1 d-inline">
                                    @csrf  
                                    @method('delete')
                                    <input type="submit" class="btn btn-sm btn-danger" value="Supprimer" onclick="return confirm('Confirmer la suppression de ce contact ? ')">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif



@endsection