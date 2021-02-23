<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberFiles extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nb_download_files',
        'nb_delivery_files',
    ];

    public function user() {
        $this->belongs(User::class);
    }
}
