<?php

#Test
Route::get('/test', 'Agent\APIController@teste');
Route::get('/lu', 'Main\MainController@lastUpdated');
Route::get('/sv', 'Main\MainController@systemVersion');
Route::get('/cc', 'Main\MainController@countClient');
Route::get('/cv', 'Main\MainController@countVersion');
Route::get('/lv', 'Main\MainController@lastVersion');
Route::get('/lc', 'Main\MainController@dashTest');
Route::get('/dash', function (){
    return view("dashboard.dashboard");
});

Route::get('/test', 'Main\MainController@teste');

Route::group(array('prefix' => 'api'), function()
{
    Route::get('/', function () {
        //return response()->json(['message' => 'Jobs API', 'status' => 'Connected']);
        return redirect('/api/dashboard');
    });
    Route::post('/readJSON', 'Agent\APIController@readJSON');
    Route::get('/json', 'Agent\APIController@listJSON');
    Route::get('/dashboard', 'Main\MainController@dashboardMain');

    //Return Versions System - Qtde
    Route::get('/sv', 'Main\MainController@systemVersion');

});



Route::get('/', function () {

    return redirect('api');

});


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

