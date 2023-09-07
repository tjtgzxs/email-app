<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
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
        'folder_id',
    ];
    public function admin()
    {
        return $this->belongsTo(Administrator::class, 'admin_id', 'id');
    }
    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id', 'id');
    }
}
