@extends('layouts.app')

@section('title', 'Laravel 11 | Edit post ')

@section('content')
    <h1>Formulario para criar um novo post</h1>

    @if ($errors->any())
        <div>
            <h2>Errores: </h2>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('posts.update', $post) }}" method="post">
        @csrf

        @method('PUT')

        <label for="title">Titulo</label>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"><br><br>
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}"><br><br>
        <label for="category">Categoria</label>
        <input type="text" name="category" id="category" value="{{ old('category', $post->category) }}"><br><br>
        <label for="content">Conteúdo</label>
        <textarea name="content" id="content">{{ old('content', $post->content) }}</textarea><br><br>
        <button type="submit">Atualizar post</button>
    </form>
@endsection
