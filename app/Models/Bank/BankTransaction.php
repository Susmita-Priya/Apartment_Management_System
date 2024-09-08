<?php

namespace App\Models\Bank;

use App\Models\Accounts\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function account()
    {
        return $this->hasOne(Account::class, 'id','account_id');
    }

    public function transaction_type()
    {
        return $this->hasOne(BankTransactionType::class, 'id','bank_transaction_type_id');
    }
    
}
