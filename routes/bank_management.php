<?php


use App\Http\Controllers\Bank\BankTransactionController;
use App\Http\Controllers\Bank\BankTransactionTypeController;
use Illuminate\Support\Facades\Route;





// ----------------  bank management -------------------------- //

// transaction type 
Route::get('bank/transaction/type/delete/{id}', [BankTransactionTypeController::class, 'destroy'])->name('bank_transaction_type.delete');
Route::resource('bank_transaction_type', BankTransactionTypeController::class);


// bank transaction
Route::get('bank/transaction/delete/{id}', [BankTransactionController::class, 'destroy'])->name('bank_transaction.delete');
Route::get('bank/transaction/report', [BankTransactionController::class, 'transactionReport'])->name('bank_transaction_report');
Route::resource('bank_transaction', BankTransactionController::class);
