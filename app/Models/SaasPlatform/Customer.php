<?php

namespace App\Models\SaasPlatform;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function role()
    {
        return $this->hasOne(Role::class, 'id','role_id');
    }
    public function subscription_package()
    {
        return $this->hasOne(SubscriptionPackage::class, 'id','subscription_package_id');
    }
    public function duration()
    {
        return $this->hasOne(SubscriptionPackageDuration::class, 'id','subscription_package_duration_id');
    }
}
