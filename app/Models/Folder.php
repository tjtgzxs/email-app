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

    public function email()
    {
        return $this->belongsTo(Email::class, 'email_id', 'id');
    }

    public function nicks()
    {
        return $this->hasMany(Nick::class, 'folder_id', 'id');
    }
}
