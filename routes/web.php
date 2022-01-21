<?php

use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\VariableController;
use Illuminate\Support\Facades\Artisan;
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


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/alternative', [AlternativeController::class, 'index'])->name('alternative');
    Route::post('/tambahAlternative', [AlternativeController::class, 'store'])->name('tambahAlternative');
    Route::post('/editAlternative', [AlternativeController::class, 'edit'])->name('editAlternative');
    Route::get('/deleteAlternative/{id}', [AlternativeController::class, 'destroy'])->name('deleteAlternative');


    Route::get('/survey', [SurveyController::class, 'index'])->name('survey');
    Route::post('/updateSurvey', [SurveyController::class, 'save'])->name('updateSurvey');


    Route::get('/variable', [VariableController::class, 'index'])->name('variable');
    Route::post('/variableStore', [VariableController::class, 'store'])->name('variableStore');
    Route::post('/variableProfil', [VariableController::class, 'show'])->name('variableProfil');


    Route::get('/criteria', [CriteriaController::class, 'index'])->name('criteria');
    Route::post('/tambahCriteria', [CriteriaController::class, 'store'])->name('tambahCriteria');
    Route::post('/editCriteria', [CriteriaController::class, 'edit'])->name('editCriteria');
    Route::get('/deleteCriteria/{id}', [CriteriaController::class, 'destroy'])->name('deleteCriteria');


    Route::get('/calculation', [CalculationController::class, 'index'])->name('calculation');


    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');
});

Route::get('/dev/symlink', function () {
    Artisan::call('storage:link');
    echo "Done";
});

require __DIR__.'/auth.php';
