<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    // Обратная связь к модели User:
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Связь один ко многим к модели Image:
    public function images() {
        return $this->hasMany(Image::class);
    }
    // Связь один ко многим к модели OfferForDelivery:
    public function offers() {
        return $this->hasMany(OfferForDelivery::class);
    }
    // Акцессор для форматирования даты:
    public function getDateAsCarbonAttribute() {
        return Carbon::parse($this->created_at);
    }
    // Связь один к одному к модели Delivery
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }
    // Связь один ко многим к модели Status:
    public function statuses() {
        return $this->hasMany(Status::class);
    }
}
