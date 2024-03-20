<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.login');
});

Route::group(['middleware' => 'guest:admin'], function () {
    Route::get('/', [LoginController::class, 'login']);
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
});

Route::group(['middleware' => 'auth:admin' , 'checkStatus'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::group(['prefix'=> 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::get('/trash_categories', [CategoryController::class, 'trashedCategories'])->name('trash-categories');
        Route::get('/create',[CategoryController::class, 'create'])->name('category.create');
        Route::post('/store',[CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
//        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
        Route::get('/categories/soft_delete/{id}', [CategoryController::class, 'softDelete'])->name('categories.soft-delete');
        Route::get('/search_categories', [CategoryController::class, 'searchByCategory'])->name('search_categories');
    });

    Route::group(['prefix'=> 'tags'], function () {
        Route::get('/', [TagController::class, 'index'])->name('tags');
        Route::get('/trash_tags', [TagController::class, 'trashedTags'])->name('trash-tags');
        Route::get('/create',[TagController::class, 'create'])->name('tag.create');
        Route::post('/store',[TagController::class, 'store'])->name('tag.store');
        Route::get('/edit/{id}', [TagController::class, 'edit'])->name('tag.edit');
        Route::post('/update/{id}', [TagController::class, 'update'])->name('tag.update');
//        Route::get('/delete/{id}', [TagController::class, 'destroy'])->name('tag.destroy');
        Route::get('/tags/soft_delete/{id}', [TagController::class, 'softDelete'])->name('tags.soft-delete');
        Route::get('/search_tags', [TagController::class, 'searchByTag'])->name('search_tags');
    });

    Route::group(['prefix'=> 'news'], function () {
        Route::get('/', [NewsController::class, 'index'])->name('news');
        Route::get('/trash_news', [NewsController::class, 'trashedNews'])->name('trash-news');
        Route::get('/create',[NewsController::class, 'create'])->name('news.create');
        Route::post('/store',[NewsController::class, 'store'])->name('news.store');
        Route::get('/view_media/{id}', [NewsController::class, 'viewMedia'])->name('news.view-media');
        Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
        Route::post('/update/{id}', [NewsController::class, 'update'])->name('news.update');
//        Route::get('/delete/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
        Route::get('/news/soft_delete/{id}', [NewsController::class, 'softDelete'])->name('news.soft-delete');
        Route::post('remove_image_news', [NewsController::class, 'removeImageNews'])->name('remove_image_news');
        Route::get('/search_news', [NewsController::class, 'searchByNews'])->name('search_news');
    });


    Route::group(['prefix'=> 'users'], function () {
        Route::get('/', [UsersController::class, 'index'])->name('users');
        Route::get('/trash_users', [UsersController::class, 'trashedUsers'])->name('trash-users');
        Route::get('/create',[UsersController::class, 'create'])->name('user.create');
        Route::post('/store',[UsersController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [UsersController::class, 'update'])->name('user.update');
//        Route::get('/delete/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
        Route::get('/users/soft_delete/{id}', [UsersController::class, 'softDelete'])->name('users.soft-delete');
        Route::post('edit_status_user', [UsersController::class, 'editStatusUser'])->name('edit_status_user');

    });
});
