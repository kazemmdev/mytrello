<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ColumnController;
use Illuminate\Support\Facades\Route;


Route::apiResource('columns', ColumnController::class);
Route::apiResource('cards', CardController::class);

//Route::get('export-db', function (){
//    Spatie\DbDumper\Databases\MySql::create()
//        ->setDbName('mydb')
//        ->setUserName('mydb')
//        ->setPassword('password')
//        ->setHost('mysql')
//        ->dumpToFile('dump.sql');
//
//    return response()->download('dump.sql');
//
//});
