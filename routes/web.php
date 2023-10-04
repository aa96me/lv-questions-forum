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

Route::controller(FrontendController::class)->group(function () {
    Route::get('/users/registration', 'registration')->name('user.registration');
    Route::get('/', 'index')->name('home');
    Route::get('/question/{slug}', 'question')->name('question');
});

Auth::routes(['verify' => false, 'reset' => false]);

Route::resource('/answers', 'AnswerController')->except(['index']);

Route::group(['middleware' => ['user']], function () {

    Route::controller(FrontendController::class)->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/user/update-profile', 'user_update_profile')->name('user.profile.update');
        Route::get('/my-questions/index', 'my_questions')->name('user.my_questions');
        Route::get('/questions/add', 'question_add')->name('question.add');
        Route::post('/questions/store', 'question_store')->name('question.store');
    });

    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

});

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {


    Route::controller(BackendController::class)->group(function () {
        Route::get('/', 'admin_dashboard')->name('admin.dashboard');
        Route::get('profile/index', 'admin_profile')->name('profile.index');
        Route::post('profile/{id}/update', 'admin_profile_update')->name('profile.update');
        Route::get('users/index', 'admin_users_index')->name('users.index');
        Route::get('users/delete/{id}', 'admin_users_delete')->name('users.delete');
        Route::get('setting/index', 'setting_index')->name('settings.index');
        Route::post('settings/update', 'setting_update')->name('settings.update');
        Route::post('settings/update/maintenance', 'setting_maintenance')->name('settings.maintenance');
    });

    Route::controller(QuestionController::class)->prefix('questions')->name('questions.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}/update', 'update')->name('update');
        Route::get('/{id}/delete', 'delete')->name('delete');
        Route::post('/published', 'updatePublished')->name('published');
    });

    Route::controller(AnswerController::class)->group(function () {
        Route::get('/answers/index', 'index')->name('answers.index');
        Route::post('/answers/published', 'updatePublished')->name('answers.published');
        Route::get('/answers/delete/{id}', 'delete')->name('answers.delete');
    });
});
