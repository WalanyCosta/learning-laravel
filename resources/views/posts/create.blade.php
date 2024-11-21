@extends('layouts.app')

@section('title', 'Laravel 11 | New post')

@section('content')
    <h1>Formulario para criar um novo post</h1>
    {{-- @if ($errors->any())
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
    @endif --}}
    <form action="{{ route('posts.store') }}" method="post">
        @csrf
        <label for="title">Titulo: </label>
        <input type="text" name="title" id="title" value="{{ old('title') }}">
        @error('title')
            <p>{{ $message }}</p>
        @enderror
        <br><br>
        <label for="slug">Slug: </label>
        <input type="text" name="slug" id="slug" value="{{ old('slug') }}">
        @error('slug')
            <p>{{ $message }}</p>
        @enderror
        <br><br>
        <label for="category">Categoria: </label>
        <input type="text" name="category" id="category" value="{{ old('category') }}">
        @error('category')
            <p>{{ $message }}</p>
        @enderror
        <br><br>
        <label for="content">Conteúdo</label>
        <textarea name="content" id="content">
            {{ old('content') }}
        </textarea>
        @error('title')
            <p>{{ $message }}</p>
        @enderror
        <br><br>
        <button type="submit">cria post</button>
    </form>
@endsection
