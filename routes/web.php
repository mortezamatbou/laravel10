<?php

use App\Http\Controllers\CoinsController;
use App\Http\Controllers\EntityTestsController;
use App\Http\Controllers\MyUsersController;
use App\Http\Controllers\PermissionTest;
use App\Http\Controllers\TestDbController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use \App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestController;

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

Route::prefix('/entity')->controller(EntityTestsController::class)->group(function () {
    Route::get('/', 'index')->name('entity.index');
    Route::get('/{id}', 'show')->whereNumber('id')->name('entity.detail');
    Route::post('/{id}', 'update')->whereNumber('id')->name('entity.update');
    Route::get('/add', 'store_form')->name('entity.store_form');
    Route::post('/add', 'store')->name('entity.store');
});

Route::prefix('/model')->controller(MyUsersController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/select', 'advanceSelect');
    Route::get('/insert', 'insertNewUser');
    Route::get('/state', 'checkState');
    Route::get('/mass', 'massAssignment');
    Route::get('/events', 'checkEvents');
    Route::get('/my_users/{id}', function (string $id) {
        return \App\Models\MyUsers::findOrFail($id);
    });
});

Route::prefix('coins')->controller(CoinsController::class)->group(function () {
    Route::get('/', 'index')->name('coins.index');
    Route::get('/{id}', 'detail')->whereNumber('id')->name('coins.detail');
    Route::post('/{id}', 'coin_update')->whereNumber('id')->name('coins.update');
    Route::get('/add', 'coin_add_form')->name('coins.add.form');
    Route::post('/add', 'coin_add')->name('coins.add');
});

Route::prefix('permission')->controller(PermissionTest::class)->group(function () {
    Route::get('/', 'index')->name('permission.index');
    Route::get('/user/add', 'user_add')->name('permission.user.add');
    Route::post('/user/add', 'user_add')->name('permission.user.store');

    Route::get('/permissions', 'permission_list')->name('permission.permissions');
    Route::get('/roles', 'role_list')->name('permission.roles');

    Route::get('/test', 'test')->name('permission.test');
});


Route::get('/db/test', [TestDbController::class, 'test_db']);
Route::get('/db/chunk', [TestDbController::class, 'test_chunk']);
Route::get('/db/chunkById', [TestDbController::class, 'test_chunk_by_id']);
Route::get('/db/lazy', [TestDbController::class, 'test_lazy']);
Route::get('/db/aggregates', [TestDbController::class, 'test_aggregates']);
Route::get('/db/joins', [TestDbController::class, 'test_joins']);
Route::get('/db/union', [TestDbController::class, 'test_union']);
Route::get('/db/where', [TestDbController::class, 'test_where']);

Route::get('/injection', function (Request $request) {
    return redirect('/injection/new')->withInput();
})->name('injection');

Route::get('/injection/new', function (Request $request) {
    return $request->old();
})->name('injection-new');

Route::view('/', 'index')->name("home-page");

//Route::view('/login', 'index')->name('login');
Route::post('/login', function (Request $request) {
    if ($request->post('username') == 'username' && $request->post('password') == 'pass') {
        Route::redirect('/login', '/dashboard');
    }
});

Route::get('/optional/{optionalValue?}', function (string $optionalValue = null) {
    return $optionalValue ? "Your optional value is <b>$optionalValue<b>." : 'Your optional value is empty';
})->name('optional-parameter-test');

Route::get('/info/mobile/{mobile}/{token}', function (Request $request, string $mobile, string $token) {
    return "Mobile number info for <b>$mobile</b><br>Token: $token " . base64_decode($token);
})->name('mobile-info');

Route::get('/otp/mobile/{mobile}/{token}', function (Request $request, string $mobile, string $token) {
    return "OTP sent to <b>$mobile</b><br>Token: $token " . base64_decode($token);
})->name('mobile-otp');

Route::get('/search/{mobile}', function (string $mobile) {
    $mobile_info = route('mobile-info', ['mobile' => $mobile, 'token' => base64_encode(rand(1, 10))]);
    $mobile_otp = route('mobile-otp', ['mobile' => $mobile, 'token' => base64_encode(rand(1, 10))]);
    echo "<a href='$mobile_info'>Info</a> ";
    echo "<a href='$mobile_otp'>OTP</a>";
})->name('search');

Route::prefix('dashboard')
    ->middleware(['mytoken'])
    ->controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard-home');
        Route::get('/coins', 'coins')->name('dashboard-coins');
        Route::get('/coins/{symbol}', 'coin_detail')->whereIn('symbol', ['BTC', 'ETH', 'ADA'])->name('coin-detail');
        Route::get('/profile', 'profile')->name('dashboard-profile');
        Route::get('/portfolio', 'portfolio')->name('dashboard-portfolio');
    });

Route::prefix('test')->group(function () {
    Route::get('/', [TestController::class, 'index'])->name('test-index');
    Route::get('/options', [TestController::class, 'options'])->name('test-options');
    Route::get('/methods/{name}', [TestController::class, 'methods'])->name('test-methods');
});

Route::resource('photos', \App\Http\Controllers\PhotosController::class)->only(['show', 'create']);
