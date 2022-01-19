<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public $hidden =
    [
        "login",
    	"password",
    	"api_token",
    ];
    protected $primaryKey = 'id_admin';
    public $timestamps = false;
}