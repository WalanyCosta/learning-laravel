@extends('layouts.app')


@section('title')
    Laravel 11 | {{ $post->title }}
@endsection

{{-- @section('title', 'Laravel') --}}

@section('content')
    <a href="{{ route('posts.index') }}">Voltar aos posts</a>


    <h1>Titulo: {{ $post->title }}</h1>
    <p>
        <strong>Categoria:</strong> {{ $post->category }}
    </p>
    <p>
        {{ $post->content }}
    </p>

    <a href="{{ route('posts.edit', $post) }}">
        Editar post
    </a>

    <form action="{{ route('posts.destroy', $post) }}" method="post">
        @csrf
        @method('DELETE')

        <button type="submit">
            Eliminar post
        </button>
    </form>
@endsection
