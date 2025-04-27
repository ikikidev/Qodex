@extends('layouts.app')

@section('content')
    <div class="card" style="padding: 2rem; max-width: 400px; margin: auto;">
        <h1 style="margin-bottom: 1rem; font-size: 1.5rem; font-weight: bold;">{{ $author->name }}</h1>

        <p><strong>Fecha de nacimiento:</strong> {{ optional($author->birthdate)->format('d/m/Y') }}</p>
        <p><strong>Nacionalidad:</strong> {{ $author->nationality }}</p>

        <h2 style="margin-top: 2rem; font-size: 1.2rem; font-weight: bold;">Libros escritos:</h2>

        <ul>
            @forelse ($author->books as $book)
                <li>{{ $book->title }} ({{ $book->publication_year }})</li>
            @empty
                <li>Este autor no tiene libros registrados.</li>
            @endforelse
        </ul>

        <div style="margin-top: 2rem;">
            <a href="{{ route('public.books.index') }}">&larr; Volver al listado de libros</a>
        </div>
    </div>
@endsection
