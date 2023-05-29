<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferForDelivery extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    // Обратная связь к модели User
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    // Обратная связь к модели Order
    public function order() {
        return $this->belongsTo(Order::class, 'user_id', 'id');
    }
    // Акцессор для форматирования даты:
    public function getDateAsCarbonAttribute() {
        return Carbon::parse($this->created_at);
    }
}
