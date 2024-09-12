<?php

//namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class User extends Model
// {
//     use HasFactory;

//     protected $table = 'users';

//     // Make sure to only include the fields you want to be mass-assignable
//     // In User.php model
// protected $fillable = ['name', 'email', 'password', 'role_id'];


//     public function role()
//     {
//         return $this->belongsTo(Role::class);
//     }
// }


namespace App\Models;

use App\Models\SaasPlatform\SubscriptionPackage;
use Illuminate\Foundation\Auth\User as Authenticatable; // Import Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // Extend Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password', 'role_id', 'expire_date', 'subscription_package_id', 'customer_id', 'phone', 'company_name', 'registration_date'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function subscription_package()
    {
        return $this->hasOne(SubscriptionPackage::class, 'id', 'subscription_package_id');
    }
}
