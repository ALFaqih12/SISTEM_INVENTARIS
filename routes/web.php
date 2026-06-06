<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::redirect('/', '/admin/login');

Route::get('/report/stock/pdf', [ReportController::class, 'stockPdf']);

Route::get(
    '/report/stock/pdf',
    [ReportController::class, 'stockPdf']
)->name('stock-report.pdf');


Route::get('/report/transaction/pdf', [ReportController::class, 'transactionPdf'])
    ->name('transaction-report.pdf');

Route::get('/report/budget/pdf', [ReportController::class, 'budgetPdf'])
    ->name('budget-report.pdf');
