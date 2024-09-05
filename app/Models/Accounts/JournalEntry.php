<?php

namespace App\Models\Accounts;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function journal_entry_details()
    {
        return $this->hasMany(JournalEntryDetail::class, 'journal_entry_id');
    }

    public function data_inputed_by()
    {
        return $this->hasOne(User::class, 'id','created_by');
    }
}
