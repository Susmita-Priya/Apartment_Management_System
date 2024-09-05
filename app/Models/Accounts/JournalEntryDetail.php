<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntryDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function account()
    {
        return $this->hasOne(Account::class, 'id','account_id');
    }

    public function account_group()
    {
        return $this->hasOne(AccountGroup::class, 'id','account_group_id');
    }
}
