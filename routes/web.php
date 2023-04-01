<?php

use App\Filament\Pages\Result;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/admin');
});

// Route::get('/{id}/results', function () {
//     return ;
// })->name('student.results');

Route::get('send_mail/{student}', [MainController::class, 'sendMail'])->name('students.results.mail');
Route::get('print_pdf/{student}', [MainController::class, 'generatePdf'])->name('students.results.print');
Route::get('print_pdf/students', [MainController::class, 'studentPdf'])->name('all-students.results.print');
