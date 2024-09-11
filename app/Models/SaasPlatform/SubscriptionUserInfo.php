<?php

namespace App\Models\SaasPlatform;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionUserInfo extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function subscription_package()
    {
        return $this->hasOne(SubscriptionPackage::class, 'id', 'subscription_package_id');
    }
    public function package_duration()
    {
        return $this->hasOne(SubscriptionPackageDuration::class, 'id','subscription_package_duration_id');
    }
}
