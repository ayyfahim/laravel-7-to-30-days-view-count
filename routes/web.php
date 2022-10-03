<?php

use App\Models\PageVisit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {

    $addSelectQuery = [
        'last7DaysViewCount' => PageVisit::selectRaw('count(*)')->whereColumn('user_Id', 'users.id')->whereBetween(
            'visited_at',
            [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()]
        ),
        'last30DaysViewCount' => PageVisit::selectRaw('count(*)')->whereColumn('user_Id', 'users.id')->whereBetween(
            'visited_at',
            [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()]
        ),
    ];
    dd(User::with('page_visits')->select()->addSelect($addSelectQuery)->get());

    return view('welcome');
});
