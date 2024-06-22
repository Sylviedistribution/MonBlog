<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
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


Route::get("/", function () {
    return redirect('blog');
});


Route::prefix('blog')->controller(BlogController::class)->group(function () {
    //POST

    //FONCTIONS DE LISTING
    Route::get("/", "index")->name("index");
    Route::get("/index", "index")->name("index");
    Route::get('/show/{slug}/{id}', 'show')->name('show.post');
    Route::get('/search', 'search')->name('search');

    Route::middleware('auth')->group(function () {

        Route::get('/list/my-post/{user}', 'listMyPost')->name('list.my.post')->middleware('auth');

        //FONCTIONS D'ACTIONS
        Route::get("/create/post", "create")->name("create.post");
        Route::get('/edit/{post}', 'edit')->name('edit.post');
        Route::post('/store', 'store')->name('store.post');

        Route::post('/update/{post}', 'update')->name('update.post')->middleware('auth');
        Route::get('/delete/{post}', 'delete')->name('delete.post')->middleware('auth');

        //COMMENTAIRE
        Route::post('/comment/{post_id}', 'commentStore')->name('comment.store');

    });

    Route::middleware('auth2')->group(function () {
        Route::get('/list/post', 'listPost')->name('list.post');
        //USER
        Route::get('/list/user', 'listUser')->name('list.user');
        Route::get('/changeState/{user}', 'changeState')->name('change.state.user');
        Route::get('/delete/{user}', 'delete')->name('delete.user');

        //CATEGORIE
        Route::prefix('categorie')->group(function () {
            Route::get('/create', 'createCategorie')->name('create.categorie');
            Route::get('/{slug}', 'afficherParCategorie')->name('show.by.categorie');
            Route::post('/save', 'saveCategorie')->name('save.categorie');
        });

    });

    // AUTHENTIFICATION
    Route::controller(AuthController::class)->group(function () {
        Route::middleware('guest2')->group(function () {
            Route::post('/loginAction', 'loginAction')->name('login.action');
            Route::post('/registerSave', 'registerSave')->name('register.save');
            Route::get('/login', 'login')->name('login');
            Route::get('/register', 'register')->name('register');
        });
        Route::get('/logout', 'logout')->name('logout')->middleware('auth');
    });

});


