<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\typesrepair;

class typesrepaircontroller extends Controller
{
    public function TypesData()
    {
        $types = typesrepair::all();
        return response()->json($types, 200);
    }
}
