<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Models\Comment;
use App\Models\Phone;
use App\Models\Post;
use App\Models\User;

Route::get('/', HomeController::class);
Route::get('/test', function () {
    // User::create([
    //     'name' => 'Victor Arana',
    //     'email' => 'victor@codersfree.com',
    //     'password' => bcrypt('12345678'),
    // ]);

    // Phone::create([
    //     'number' => '999999999',
    //     'user_id' => 1,
    // ]);

    // $user = User::where('id', 1)
    //     ->with('phone')
    //     ->first();

    $phone = Phone::find(1);

    return $phone->user;
});

Route::get('prueba', function () {
    // Comment::create([
    //     'content' => 'comment 2',
    //     'post_id' => '10'
    // ], [
    //     'content' => 'comment 3',
    //     'post_id' => '10'
    // ]);
    // $comment = Comment::find(1);

    // return $comment->post;

    $post = Post::find(2);

    $post->comments()->create([
        'content' => 'Un comentario de prueba',
    ]);

    return 'comentario criado';
});

Route::resource('posts', PostController::class);

// Route::get('/posts', [PostController::class, 'index'])
//     ->name('posts.index');

// Route::get('/posts/create', [PostController::class, 'create'])
//     ->name('posts.create');

// Route::get('/posts/{post}', [PostController::class, 'show'])
//     ->name('posts.show');

// Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
//     ->name('posts.edit');

// Route::post('/posts', [PostController::class, 'store'])
//     ->name('posts.store');

// Route::put('/posts/{posts}', [PostController::class, 'update'])
//     ->name('posts.update');

// Route::delete('/posts/{post}', [PostController::class, 'destroy'])
//     ->name('posts.destroy');