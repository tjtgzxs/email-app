<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\UserController;
use Encore\Admin\Facades\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    protected $table = 'emails';
    protected $fillable = [
        'email',
        'email_username',
        'email_password',
        'email_host',
        'email_port',
        'tele_token',
        'tele_chat_id',
        'admin_uid',
    ];

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }
    public function admin()
    {
        return $this->belongsTo(Administrator::class, 'admin_uid', 'id');
    }


}
