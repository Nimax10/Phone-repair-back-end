<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typesrepair extends Model
{
    use HasFactory;

    protected $table = 'typesrepair';
    public $timestamps = false;
    protected $primaryKey = 'id_type';
}
