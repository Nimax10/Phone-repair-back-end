<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Models;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function Index()
    {
        return view("index");
    }
    public function ModelsData()
    {
        $models = Company::with('models')->get();
        return response()->json($models, 200);
    }

    public function test()
    {
        $company_id = 1;
        $models = Company::find($company_id)->Models()->orderBy("nameModel", "DESC")->get();

        $model_id = 7;
        $companies = Models::find($model_id)->Company()->orderBy("name", "DESC")->first();


        return view('test')->with(["models" => $models, "companies" => $companies]);
    }

}
