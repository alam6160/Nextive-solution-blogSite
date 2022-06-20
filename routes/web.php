<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\blogController;



Route::get('/', function () {
    return view('welcome');
});


/*information for this blog:

admin login : admin@gmail.com  and password: 12345678
user login: user@gmail.com  and password: 12345678

there is an views/admin file in the admin folder and views/blogView file in blogview folder.
this project is only for test my laravel skill.
i did not setup full bloging system due to being busy with other work that's why I am very sorry.

thak you for all.

*/



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin route

Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminindex'])->name('admin.home')->middleware('user-access');


Route::middleware(['user-access'])->group(function () 
{

  Route::get('/show-blog-page', [adminController::class, 'index'])->name('blog.show');

  Route::get('/insert-blog', [adminController::class, 'create'])->name('blog.create');

  Route::post('/create-blog',[adminController::class,'store'])->name('blog.insert');

  Route::get('/edit-blog/{id}',[adminController::class,'edit'])->name('blog.edit');

  Route::post('/update-blog/{id}',[adminController::class,'update'])->name('blog.update');

  Route::get('/delete-blog/{id}',[adminController::class,'destroy'])->name('blog.destroy');

});





//frontend blog route

Route::get('/blog',[blogController::class,'blogindex']);
Route::get('/blog-contract',[blogController::class,'blogcontract'])->name('blog.contract');




