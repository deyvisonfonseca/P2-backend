<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar as rotas web para sua aplicação.
| Essas rotas são carregadas pelo RouteServiceProvider dentro de um grupo
| que contém o middleware "web".
|
*/

// Rota raiz - redireciona para listagem de categorias

// Rotas de recursos para categorias (CRUD automático)
// Redireciona a raiz para a listagem de categorias
Route::redirect('/', '/categories');

// Rotas RESTful para o CRUD de categorias
Route::resource('categories', CategoryController::class);
