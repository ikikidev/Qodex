@extends('layouts.app')

@section('content')
    <h1 style="margin-bottom: 1rem; font-size: 1.5rem; font-weight: bold;">Listado de Libros</h1>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>ISBN</th>
                <th>Año Publicación</th>
                <th>Autores</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->publication_year }}</td>
                    <td>
                        @foreach ($book->authors as $author)
                            <a href="{{ route('public.authors.show', $author) }}">{{ $author->name }}</a>@if (!$loop->last), @endif
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay libros disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
