<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\SendResetPasswordWithQueueNotification;
use App\Notifications\SendVerifyWithQueueNotification;
use Cog\Laravel\Ban\Models\Ban;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;

class User extends Authenticatable implements BannableContract, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Bannable, SoftDeletes;
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';
    protected $guarded = false;
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // Связь один ко многим к модели Order (заказы):
    public function orders() {
        return $this->hasMany(Order::class);
    }
    public function offer() {
//        return $this->hasMany(OfferForDelivery::class);
    }
    // Защита маршрута от забаненных людей:
    public function shouldApplyBannedAtScope()
    {
        return true;
    }
    // Связь один ко многим к модели Delivery (доставки):
    public function delivery()
    {
        return $this->hasMany(Delivery::class);
    }
    public function isAdmin() {
        return $this->user_type === self::ROLE_ADMIN;
    }
    public function isUser() {
        return $this->user_type === self::ROLE_USER;
    }
    public function news() {
        return $this->hasMany(News::class);
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new SendVerifyWithQueueNotification());
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SendResetPasswordWithQueueNotification($token));
    }
}
