<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guarded = [];

    protected $hidden = [
        'password'
    ];

    public function scopeAmbassadors($query)
    {
        return $query->where('is_admin', 0);
    }

    public function scopeAdmins($query)
    {
        return $query->where('is_admin', 1);
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->where('complete', 1);
    }

    public function getRevenueAttribute()
    {
        return $this->orders->sum(fn(Order $order) => $order->ambassador_revenue);
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
