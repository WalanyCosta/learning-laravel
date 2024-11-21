@extends('layouts.app')

@section('title')
    Laravel 11 | posts
@endsection

@section('content')
    <h1>Aqui se mostrará todos os post</h1>

    <a href="{{ route('posts.create') }}">Novo post</a>

    <ul>
        @foreach ($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post) }}">
                    {{ $post->title }}
                </a>
            </li>
        @endforeach
    </ul>
    {{ $posts->links() }}
@endsection
