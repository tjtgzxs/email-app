<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $table = 'folders';
    protected $fillable = [
        'email_id',
        'folder',
        'from',
        'analyze',
        'continue',
        'to',
    ];

}
