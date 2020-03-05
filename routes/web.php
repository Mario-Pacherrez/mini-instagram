<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//use App\Image;

Route::get('/', function () {
    /*
    $images = Image::all();
    foreach ($images as $image){
        echo $image->image_path."<br/>";
        echo $image->description."<br/>";
        echo $image->user->name.' '.$image->user->surname."<br/>";

        if(count($image->comments) >=1) {
            echo '<h4>Comentarios</h4>';
            foreach ($image->comments as $comment) {
                echo $comment->user->name.' '.$comment->user->surname.': ';
                echo $comment->content."<br/>";
            }
        }
        echo 'LIKES: '.count($image->likes);
        echo "<hr/>";
    }

    die();
    */
    return view('welcome');
});

// GENERALES
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// USUARIO
Route::get('/configuracion', 'UserController@config')->name('config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/perfil/{id_user}', 'UserController@profile')->name('profile');
Route::get('/gente/{search?}', 'UserController@index')->name('user.index');

// IMÁGEN
Route::get('/subir-imagen', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/image/{id_image}', 'ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id_image}', 'ImageController@delete')->name('image.delete');
Route::get('/image/editar/{id_image}', 'ImageController@edit')->name('image.edit');
Route::post('/image/update', 'ImageController@update')->name('image.update');

// COMENTARIO
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id_comment}', 'CommentController@delete')->name('comment.delete');

// LIKES
Route::get('/like/{id_image}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{id_image}', 'LikeController@dislike')->name('like.delete');
Route::get('/likes', 'LikeController@index')->name('likes');