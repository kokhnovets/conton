<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseFeedback extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function feedback() {
        return $this->belongsTo(Feedback::class);
    }
}
