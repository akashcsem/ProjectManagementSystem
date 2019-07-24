<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return "Project Management System";
});

Route::middleware(['auth'])->group(function(){
  Route::resource('companies', 'CompanyController');
  Route::resource('projects', 'ProjectController');
  Route::get('projects/create/{id?}', 'ProjectController@create');
  Route::post('projects/adduser', 'ProjectController@addProjectUser')->name('projects.adduser');
  Route::resource('tasks',    'TaskController');
  Route::resource('roles',    'RoleController');
  Route::resource('comments', 'CommentController');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
