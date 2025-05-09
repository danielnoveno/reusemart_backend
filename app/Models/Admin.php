<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Admin extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'admins';
    protected $primaryKey = 'ID_ADMIN';
    public $timestamps = true;

    protected $fillable = [
        'NAMA_ADMIN',
        'EMAIL_ADMIN',
        'PASSWORD_ADMIN'
    ];
    protected $hidden = [
        'PASSWORD_ADMIN'
    ];
}
