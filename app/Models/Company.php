<?php

namespace App\Models;
use App\Models\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{   
    public $fillable = [
    	'name',
    	'imageCompany',
    	'widthLogo',
        'heightLogo',
    ];
    protected $primaryKey = 'company_code';
    public $timestamps = false;
    public function Models()
    {
        return $this->hasMany(Models::class,'company_code');
    }
}
