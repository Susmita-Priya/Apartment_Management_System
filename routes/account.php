<?php

use App\Http\Controllers\Accounts\AccountController;
use App\Http\Controllers\Accounts\AccountGroupController;
use App\Http\Controllers\Accounts\AccountingReportController;
use App\Http\Controllers\Accounts\JournalEntryController;
use Illuminate\Support\Facades\Route;


// ---------------- accounting -------------------------- //

Route::get('account/delete/{id}', [AccountController::class, 'destroy'])->name('account.delete');
Route::resource('account', AccountController::class);

Route::get('account/group/delete/{id}', [AccountGroupController::class, 'destroy'])->name('account-group.delete');
Route::resource('account-group', AccountGroupController::class);

Route::get('journal/entry/delete/{id}', [JournalEntryController::class, 'destroy'])->name('journal-entry.delete');
Route::resource('journal-entry', JournalEntryController::class);

Route::get('journal-add-more-input', [JournalEntryController::class, 'addMoreInput']);

// report
Route::get('general/ledger/report', [AccountingReportController::class, 'generalLedger'])->name('general-ledger-report');
Route::get('balance/sheet', [AccountingReportController::class, 'balance_sheet'])->name('balance_sheet');