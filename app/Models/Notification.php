<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'admin_id',
        'direction_send',
        'nb_notif',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
