<?php

use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\LaravelLocalization;
//use Mcamara\LaravelLocalization\LaravelLocalization;
//use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

//use Mcamara\LaravelLocalization;
//use Mcamara\LaravelLocalization\LaravelLocalization;

/*Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale()
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $data=[];
    $data['id']=5;
    $data['name']= 'What Could have Been';

    return view('welcome',$data);
});

Route::get('index','Front\UserController@getIndex');

Route::get('/store','HomeController@store')-> name('store');

Route::get('/products','ProductController@index')-> name('products.index');
Route::delete('/products/{product}','ProductController@destroy')-> name('products.remove');
Route::put('/products/{product}','ProductController@update')-> name('products.update');

Route::get('/addToCart/{product}','ProductController@addToCart')-> name('cart.add');
Route::get('/shopping-cart','ProductController@showCart')-> name('cart.show');

//Route::get('Product','ProductController@Index1');
//Route::post('Cart','CartController@store1') -> name('cart.store');

Route::get('/test1', function () {
    return 'welcome';
});

Route::get('/show-number/{id}', function ($id) {
    return $id ;
}) -> name('a');

Route::get('/show-string/{id?}', function () {
    return 'welcome' ;
}) -> name('b');


//route
Route::namespace('Front')->group(function() {

    // all route only access controller or methods in folder Front
    Route::get('/users','UserController@showUserName');
   //Route::get('/users', [UserControllerr::class, 'login']);

});

//Route::prefix('users')->group(function(){
//    Route::get('show','UserController@showUserName');
//});

/*Route::prefix('users')->group(function(){
    Route::get('show','UserController@showUserName');
    Route::delete('delete','UserController@showUserName');
    Route::get('edit','UserController@showUserName');
    Route::put('update','UserController@showUserName');
});*/

Route::group(['prefix' => 'users','middleware' => 'auth'], function(){
    
    Route::get('/',function(){
        return 'work';
    });

    Route::get('show','UserController@showUserName');
    Route::delete('delete','UserController@showUserName');
    Route::get('edit','UserController@showUserName');
    Route::put('update','UserController@showUserName');

});

Route::get('forPerson',function() {
    return 'with auth';
}) -> middleware('auth');


Route::group(['namespace' => 'Admin'], function() {
    Route::get('second','SecondController@showString0') -> middleware('auth');
    Route::get('second1','SecondController@showString1');
    Route::get('second2','SecondController@showString2');
    Route::get('second3','SecondController@showString3');
});

Route::get('login',function(){
    return 'Must be Login to access this Route';
}) -> name('login');

//Route::get('users','UserController@index')->middleware('auth');

//oute::group(['middleware' => 'auth'],function(){
//    Route::get('users','UserController@index');

//});

Route::resource('news', 'NewsController');

Auth::Routes(['verify' => true]);

Route::get('/home','HomeController@index')->name('home')->middleware('verified');

Route::get('/dashboard', function(){
    return 'dashboard';
});


Route::get('fillable', 'CrudController@getOffer');

/*Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
Route::group(['prefix'=>'offers'],function(){
   // Route::get('store', 'CrudController@store');
 //  Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    Route::get('create', 'CrudController@create');
    Route::post('store', 'CrudController@store') -> name('offers.store');

    Route::get('edit/{Offer_id}', 'CrudController@editOffer');
    Route::post('update/{Offer_id}', 'CrudController@UpdateOffer') -> name('offers.update');
    Route::get('delete/{Offer_id}', 'CrudController@delete') -> name('offers.delete');
    Route::get('all', 'CrudController@getAllOffers') -> name('offers.all');


   });

   Route::get('youtube','CrudController@getVideo');



});
*/

