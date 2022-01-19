<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{   
    public $fillable = [
    	'company_code',
    	'nameModel',
    	'imgModel',
    ];
    protected $primaryKey = 'model_code';
    public $timestamps = false;
    public function Company()
    {
        return $this->belongsTo(Company::class, 'company_code');
    }
}
