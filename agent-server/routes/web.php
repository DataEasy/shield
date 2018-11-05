<?php

Auth::routes();

Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('/api/dashboard');
});

#Test
Route::get('/lu', 'Main\MainController@lastUpdated');
Route::get('/sv', 'Main\MainController@systemVersion');
Route::get('/cc', 'Main\MainController@countClient');
Route::get('/cv', 'Main\MainController@countVersion');
Route::get('/lv', 'Main\MainController@lastVersion');
Route::get('/sumv', 'Main\MainController@sumVersions');
Route::get('/cli', 'Client\ClientController@listClientDashboard');
Route::get('/clid', 'Client\ClientController@clientDetails');
Route::get('/cd/{id}', 'Client\ClientController@cdTest');

Route::get('/dash', function (){
    return view("layout.main");
});

Route::get('/test', 'Main\MainController@teste');

Route::get('/client', function () {
    return redirect('api/client');
});

Route::get('/api/login', function () {
    return redirect('/api/dashboard');
});

Route::get('/dashboard', function () {
    return redirect('/api/dashboard');
});

Route::group(array('prefix' => 'api'), function()
{

    Route::post('/readJSON', 'Agent\APIController@readJSON');
    Route::get('/json', 'Agent\APIController@listJSON');
    Route::get('/dashboard', 'Main\MainController@dashboardMain');
    Route::get('/client', 'Main\MainController@dashboardClient');
    Route::get('/client/details/{id}', 'Client\ClientController@clientDetails');
    Route::get('/client/detailsresume/{id}', [
        'as' => 'resume', 'uses' => 'Client\ClientController@clientDetailsResume'
    ]);

    //Return Versions System - Qtde
    Route::get('/sv', 'Main\MainController@systemVersion');

});

Route::get('/', function () {
    return redirect('api/dashboard');
});


Route::post('register', 'Auth\RegisterController@register');

/*

curl -X POST \
 http://localhost:8000/readJSON\
 -H 'cache-control: no-cache' \
 -H 'content-type: application/json' \
 -d '{
   "title": "Título",
   "description": "Descrição",
   "local": "Goiânia / GO",
   "remote": "yes",
   "type": 3,
   "company_id": 1
}'

*/





