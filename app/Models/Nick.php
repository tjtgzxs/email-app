<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nick extends Model
{
    use HasFactory;
    protected $table = 'nicks';
    protected $fillable = [
        'email',
        'nick',
        'admin_id',
    ];
}
