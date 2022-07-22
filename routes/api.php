<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ColumnController;
use Illuminate\Support\Facades\Route;


Route::apiResource('columns', ColumnController::class);
Route::apiResource('cards', CardController::class);


Route::get('export-db', function () {
    Spatie\DbDumper\Databases\PostgreSql::create()
        ->setDbName(config('database.connections.pgsql.database'))
        ->setUserName(config('database.connections.pgsql.username'))
        ->setPassword(config('database.connections.pgsql.password'))
        ->setHost(config('database.connections.pgsql.host'))
        ->dumpToFile('dump.sql');

    Spatie\DbDumper\Databases\Sqlite::create()
        ->setDbName(database_path('database.sqlite'))
        ->dumpToFile('dump.sql');

    return response()->download('dump.sql');
});
Route::get('list-cards', [CardController::class, 'index']);

Route::get('access-token', function () {
    return \App\Models\AccessToken::create(['token' => uniqid()])->token;
});
