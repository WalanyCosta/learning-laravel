# Learning Laravel

## Comandos laravel



## Rotas

Os metodos de rotas no laravel são os mesmo que se tem num javascript ou biblioteca javascript como:

- POST
- GET
- PUT
- PATCH
- DELETE

Exemplos.:

```php

Route::get('/', function () {
    return "Welcome to the homepage";
});

Route::post('/', function () {
    return "Welcome to the homepage";
});

Route::put('/', function () {
    return "Welcome to the homepage";
});

Route::patch('/', function () {
    return "Welcome to the homepage";
});

Route::delete('/', function () {
    return "Welcome to the homepage";
});

```
Notas.: As mesmas regras que se tem no javascript aqui também tem.

#### Rotas com parametros

Para passar parametro na url é feito da seguinte forma:

```php

Route::get('/posts/{post}', function ($post) {
    return "Aqui se mostrará todos os posts {$post}";
});

Route::get('/posts/{post}/{category}', function ($post, $category) {
    return "Aqui se mostrará todos os posts {$post} da categoria {$category}";
});

```
E podemos também esse parametro como opcional veja abaixo:

```php

Route::get('/posts/{post}/{category?}', function ($post, $category = null) {

    if ($category) {
        return "Aqui se mostrará todos os posts {$post} da categoria {$category}";
    }

    return "Aqui se mostrará todos os posts {$post}";
});

```
Obs.: a ordem de organização importa muito por que pode até surgir erro.

Exemplo.:

```php

Route::get('/', function () {
    return "Welcome to the homepage";
});

Route::get('/posts', function () {
    return "Aqui se mostrará todos os posts";
});

Route::get('/posts/{post}', function ($post) {
    return "Aqui se mostrará todos os posts {$post}";
});

Route::get('/posts/create', function () {
    return "Aqui se mostrará um formulário para criar post";
});

```

## Controllers

O camando para criar arquivo controller:

```shell

php artisan make:controller <nome_arquivo>

``` 

Exemplo de conetar um controller com rota.:

```php

# HomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return "Bem-vindo a pagina principal";
    }
}

# web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

```

Exemplo para chamar de forma simplista sem ter de usar um array, mas é mais usando quando no controller só ter apenas um unico metodo e que seja metodo magico (__invoke).:

```php

# HomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        return "Bem-vindo a pagina principal";
    }
}

# web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', HomeController::class);

```

## Views

È onde fica a parte visual ou o html. Mas no laravel essas views não têm a extensão .html nem .php, têm como extensão .blade.php.

Exemplo de como passar valor de parametro para uma view.:

```php
#show.blade.php

 <h1>Aqui se mostrará todos os posts <?= $post ?></h1>

#PostController.blade.php

 public function show($post)
    {
        //compact('post'); ['post'=> $post]
        
        return view('posts.show', [
            'post' => $post
        ]);
    }

```

Exemplo de outra forma de passar valor de parametro para uma view.:

```php
#show.blade.php

 <h1>Aqui se mostrará todos os posts {{ $post }}</h1>

#PostController.blade.php

  public function show($post)
    {
        //compact('post'); ['post'=> $post]

        return view('posts.show', compact('post'));
    }

```
### Comandos fornecidos pela extensão

@if -

exemplo.:

```php

 @if (true)
        <p>Conteúdo de post</p>
    @endif

```
@ifelse - 

Exemplo.:

```php

@if (true)
        <p>Verdadeiro de post</p>
    @else
        <p>Falso post</p>
    @endif

```

@switch -

Exemplo.:
```php

@@switch($type)
        @case(1)
            
            @break
        @case(2)
            
            @break
        @default
            
    @endswitch

```
@foreach - 

Exemplo.:

```php

@foreach ($collection as $item)
        <p>Conteúdo de post</p>
@endforeach

```
@php -

Exemplo.:

```php
@php
    $var = 'hello laravel';
    
    echo $var;
@endphp

```
### Components with blade

Exemplo.:

```php
# alert.blade.php

<div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
    <span class="font-medium">Info alert!</span> {{ $slot }}
</div>

# Show.blade.php

<body>
    <div class="max-w-4xl mx-auto px-4">
        <h1>Aqui se mostrará todos os posts {{ $post }}</h1>
        <x-alert>
            Conteudo do alerta
        </x-alert>
    </div>
</body>

```

Exemplos passando mais de um paramentro ou variavel no component.:

```php

# alert.blade.php

<div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
    <span class="font-medium">{{$title ?? 'info Alert!'}}</span> {{ $slot }}
</div>

# show.blade.php

<body>
    <div class="max-w-4xl mx-auto px-4">
        <h1>Aqui se mostrará todos os posts {{ $post }}</h1>
        <x-alert type="Info">
            <x-slot:title>
                Titulo do Alerta
            </x-slot>
        Conteudo do alerta
        </x-alert>
    </div>
</body>

```

Exemplo.:

```php
# alert.blade.php

@php
    $class = match ($type) {
        'info' => 'text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400',
        'danger' => 'text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400',
        'success' => 'text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400',
        'warning' => 'text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300',
        'Dark' => 'text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300',
    };
@endphp

<div class="p-4 mb-4 text-sm rounded-lg {{ $class }}" role="alert">
    <span class="font-medium">{{ $title ?? 'dafa' }}</span> {{ $slot }}
</div>

# show.blade.php

<body>
    <div class="max-w-4xl mx-auto px-4">
        <h1>Aqui se mostrará todos os posts {{ $post }}</h1>
        <x-alert type="Info">
            <x-slot:title>
                Titulo do Alerta
            </x-slot>
        Conteudo do alerta
        </x-alert>
    </div>
</body>
```
#### Class Components 

Comando para criar components de class esta abaixo:

```bash

php artisan make:component <nome-arquivo>
```


## Templates

Os também são formas de reutilização de codigos assim como os components mais só que elas se encaixam no contexto de components como layouts que. 

Exemplo.:

```php

# layouts/app-layout.blade.php
<html lang="en">
<head>
    <title> @yield('title', 'curso de laravel')</title>
</head>
<body>
    <header></header>
    @yield('content')
    <footer></footer>
</body>
</html>

# view/show.blade.php
@section('title', 'Laravel')

@section('content')
    <div class="max-w-4xl mx-auto px-4">
        <h1>Aqui se mostrará todos os posts {{ $post }}</h1>
        <x-alert type="info" class='mb-4'>
            <x-slot:title>
                Titulo do Alerta
            </x-slot>
            Conteudo do alerta
        </x-alert>
        <p>Hello word</p>
    </div>
@endsection

```
### stack
Também e outras forma de criar templates no laravel.

Exemplo.:

```php
# layouts/app-layout.blade.php
<head>
   @stack('css')
</head>

# view/show.blade.php
@push('css')
    <style>
        body: {
            background: #f4f4f4;
        }
    </style>
@endpush

@push('css')
    <style>
        body: {
            color: #f4f4f4;
        }
    </style>
@endpush

```

Nota.:A diferença que existe entre yield e stack que só pode ser chamado uma vez por arquivos diferente do stack que pode ser chamado mais de uma vez. 

## Base de dados

Comando para rodar as migrações:
```shell
php artisan migrate
```
Comando para eliminar as tabelas criadas com migrates ou irá executar os metodos downs da migrates.
```shell
php artisan migrate:rollback
```
Comando para criar migrate 

```shell
php artisan make:migration <name_migrate>
```

Nota.: Ao criar migrates segui essa regra <action_nametable_table> e para adicionar uma column na tabela a regra é <action_columnname_to_nametable_table>

```shell
php artisan make:migrate create_categories_table
```
```shell
php artisan make:migration add_avatar_to_users_table
```
obs.:Quando se adiciona uma nova coluna numa tabela não se deve esquecer a propriedade nullable afim de evitar erro na base de dados. 


Comando usando para re-executar as migrates permitindo fazer um update na tabelas.

```shell
php artisan migrate:refresh
```
Comando tambem para re-executar as migration.
```shell
php artisan migrate:fresh
```
## Eloquent

Comando usado para criar model está descrito abaixo:
```shell
php artisan make:model <name-arquivo>
// cria modelo e ao mesmo tempo a migration
php artisan make:model <name-arquivo> -m
```

Exemplo de como salvar dados usando eloquent:

```php
#Model/Post.php

class Post extends Model
{
    protected $table = 'post';
}

#rotas

Route::get('example', function () {
    $post = new Post;
    $post->title = 'Titulo de post 2';
    $post->content = 'Conteudo de post 2';
    $post->category = 'Categoria de post 2';

    $post->save();

    return $post;
});

```
obs.: o atributo protegido de nome table pode ser omitido desde que a tabela na base de dados segue o padrão do eloquent que é deve ter o nome em minusculo e esse mesmo nome deve esta no plural da língua inglesa e não outra língua. E model deve estar no singular com letra maiuscula.

Exemplo de como buscar um registo pelo id:

```php
#Model/Post.php

class Post extends Model
{
    protected $table = 'post';
}

#rotas

Route::get('example', function () {
    $post = Post::find(1)

    return $post;
});

```

Exemplo de como buscar um registo por qualquer atributo da tabela:

```php
#Model/Post.php

class Post extends Model
{
    protected $table = 'post';
}

#rotas

Route::get('example', function () {
     $post = Post::where('title', 'Titulo de post 1')->first();

    return $post;
});

```
Exemplo de como editar ou atualizar um registro:

```php
#Model/Post.php

class Post extends Model
{
    protected $table = 'post';
}

#rotas

Route::get('example', function () {
     $post = Post::where('title', 'Titulo de post 2')->first();

    $post->category = 'Marketing';
    $post->save();

    return $post;
});

```
Exemplo de como buscar toda registo da tabela:

```php
#Model/Post.php

class Post extends Model
{
    protected $table = 'post';
}

#rotas

Route::get('example', function () {
    $posts = Post::all();
    return $posts;
});
```

Exemplo de como buscar muito registo por condição:

```php
#Model/Post.php

class Post extends Model
{
    protected $table = 'post';
}

#rotas

Route::get('example', function () {
    $posts = Post::where('id', '>', '1')->get();
    return $posts;
});
```

Exemplo de como buscar muito registo por ordem descente e crescente:

```php
#Model/Post.php

class Post extends Model
{
    protected $table = 'post';
}

#rotas

Route::get('example', function () {
    $posts = Post::orderBy('id', 'desc')->get();
    return $posts;
});
```

Exemplo de como buscar muito registo por ordem descente e selecionado as colunas que desejam ver:

```php
#Model/Post.php

class Post extends Model
{
    protected $table = 'post';
}

#rotas

Route::get('example', function () {
   $posts = Post::orderBy('category', 'asc')
        ->select('id', 'title', 'category')
        ->get();
    return $posts;
});
```
Exemplo de como buscar todos registo, mas só dois registo:

```php
#Model/Post.php

class Post extends Model
{
    protected $table = 'post';
}

#rotas

Route::get('example', function () {
   $posts = Post::orderBy('category', 'asc')
        ->select('id', 'title', 'category')
        ->take(2)
        ->get();
    return $posts;
});
```
### Mutators y accessors

O laravel permite que os atributos a ser inserido um determinado valor antes de ir para base de dados modificar esses dados e nao só quando entra um valor.

Mutadors são os setters por permite fazer uma modificação nos dados do atributo.

Accessors são os getters permite acessar o dados ou visualizar o dados.

Exemplos de mutators e accessores:

```php

class Post extends Model
{
    protected $table = 'post';

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => strtolower($value),
            get: function (string $value) {
                return ucfirst($value);
            }
        );
    }
}

```
### Casting

Attribute casting provides functionality similar to accessors and mutators without requiring you to define any additional methods on your model. E são usado em casos mais genericos.

Exemplo.:

```php

#Model/Post.php
 protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }
#routes/web.php
$post = Post::find(9);
    return $post->published_at->format('d-m-Y');

```

Exemplo.:

```php

#Model/Post.php
 protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }
#routes/web.php
 $post = Post::find(1);
    dd($post->is_active);
```

```php
$post = Post::find(4);
    return $post->created_at->format('d-m-Y');

    return $post->created_at->diffForHumans();

```

### Seeders

Comando usando para rodar as seeds no laravel esta descrita em baixo:

```bash
php artisan db:seed
```
Comando para executar migrate e seeds ao mesmo tempo, está descrita em baixo:

```bash
php artisan migrate:fresh --seed
```
Comando para criar arquivos seeds, ver em baixo o comando:
```bash
php artisan make:seeder <name_seed>
```
Exemplo de como chamar seeders no arquivo principal ou no arquivo DatabaseSeeder:

```php
#
class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      UserSeeder::class,
      PostSeeders::class,
    ]);
  }
}

```

Obs.: A pastas ou diretorios no laravel são escrita em letras minusculas mais importar devem ser capitalize ou a primeira letra deve ser maiuscula.

Nota.: Quando dois arquivos ou mais têm o mesmo namespace, se um quizer usar recurso do outro não necessita importar o outro.

### Factories

Comando usado para criar arquivo factory e:

```bash
php artisan make:factory <name_factory>
```
## Paginação

```php
#PostController
 $posts = Post::orderBy('id', 'desc')
            ->paginate(10);

 return view("posts.index", compact('posts'));
#index.blade.php
//codigo para exibição da paginação
{{ $posts->links() }}

```



##Routes

Comando usando para listar as rotas criadas:
```bash
php artisan r:l
```
### Routes with name

```php
# web.php
Route::get('/posts/', [PostController::class, 'index'])
    ->name('posts.index');
#example.blade.php

//Aqui tempo o exemplo de como chamar essa rota com nome 
<a href="{{ route('posts.index') }}">Voltar aos posts</a>
```

### Routes resource

Essa simplificação de rota é só quando se usa o padrão do laravel ao criar rota.

```php
#web.php
Route::resource('posts', PostController::class);

```
Exemplo de simplificação de routas para api:
```php
#web.php
// usando quando se usa api
Route::apiResource('posts', PostController::class);

```

### Route Model

Usado para simplificar o processo de buscar por de um elemento de uma tabela. 

```php
//codigo sem route model
public function show($post)
    {
        $post = Post::find($post);
        return view('posts.show', compact('post'));
    }

//codigo com route model
 public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

```
Essa simplificar de busca tem como padrão a buscar por id da tabela, mas pode ser alterada veja o exemplo abaixo:

```php
// adicionar esse metodo indicar um atributo da base de dado como nesse caso slug e já alterar de id para slug.

public function getRouteKeyName()
    {
        return 'slug';
    }
```
## Assinatura massiva

Também é um jeito de simplificar uns dos processos do CRUD que e o processo de criar, atualizar e deletar. Isto ajuda quando se tem muito campos para registrar, atualizar.

```php

#PostController.php
//Codigo antigo
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category = $request->category;
        $post->content = $request->content;
        $post->save();

        return redirect()->route('posts.index');
    }
//Codigo novo usando assinatura massiva
    public function store(Request $request)
    {
        Post::create($request->all());
        return redirect()->route('posts.index');
    }
```
Mas para o código acima não exibir é necessário mencionar os atributos que irão ser recebido.

Exemplo.:

```php
#model/Post.php
 class Post extends Model{

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category',
    ];
}

```
Podemos fazer o contrario em vez de mencionar-mos os atributos poderia indicar aqueles que nao poderão ser recebido:

```php
#model/Post.php
 class Post extends Model{

    protected $guarded = [
        'is_active'
    ];
}
```
E abaixo temos exemplo de como fazer atualiza:

```php

public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return redirect()->route('posts.show', $post);
    }

```
## Validation

Para validar no laravel é muito facil visto que o laravel já trás consigo lib pronta para validação. Abaixo tem um exemplo de como se faz.

```php
#Controller/PostController.php
public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:5', 'max:200'],
            'slug' => 'required|unique:posts',
            'category' => 'required',
            'content' => 'required',
        ]);

        Post::create($request->all());
        return redirect()->route('posts.index');
    }
```
E para exibir esses erros na tela de forma é só fazer como no exemplo abaixo.:

```php
#views/create.php
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

```
Mas também tem outra forma de apresentar esse erro na tela, abaixo terá um exemplo demostrando como fazer:

```php
<form action="{{ route('posts.store') }}" method="post">
        @csrf
        <label for="title">Titulo: </label>
        <input type="text" name="title" id="title" value="{{ old('title') }}">
        @error('title')
            <p>{{ $message }}</p>
        @enderror
        <br><br>
</form>
```
Obs.: O `old('title')` é função que se usa para poder manter a informação no campo quando se dar um submit e der um erro.

```php
 public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'min:5', 'max:200'],
            'slug' => "required|unique:posts,slug,{$post->id}",
            'category' => 'required',
            'content' => 'required',
        ]);

        $post->update($request->all());
        return redirect()->route('posts.show', $post);
    }
```
No codigo acima temos um `['required', 'min:5', 'max:200']` e abaixo `"required|unique:posts,slug,{$postt->id}"` essas expressão são validações de campos. O paranteses recto `[]` são usado quando se adicionar mais de uma validação em um respectivo campo e a `|` entre as palavra de validação são para permitir adicionar mais de uma validação no campo.

Nota: O `[]` são mais usado em validações que precisão de validação mais complexas, ou quando se tem muita validação num campo se quer organizar melhor. Senão se não forem esse caso, melhor usar outro.

## Form Request

`php artisan make:request <name_request>` é um comando usado para criar form request.

## Localization

`php artisan lang:publish` comando usado para criar language de forma manual.

E para adicionar outros de forma automática idioma além do padrão que é o inglês, basta seguir o seguintes passos:

1- O primeiro passo é baixar a bibioteca essa lib 

```bash 
composer require laravel-lang/common
```
2- O depois de ter baixado é só executar esse comando para adicionar para traduzir tudo para outra linguagem.

```bash
    php artisan lang:add pt
```
3- O depois é só alterar a variavel de ambiente `APP_LOCALE` de **en** para **pt**.

```
    APP_LOCALE = pt
```

E tudo já está traduzido.

## How to send e-mail in laravel

Para criar-mos a integração com enviador de email ou mail provider devemos executar o comando a baixo:

```bash
php artisan make:mail <name>
```
### Using Markdown in laravel to build email content

`php artisan vendor:publish --tag=laravel-mail` comando para custumizar 

### Relationships

