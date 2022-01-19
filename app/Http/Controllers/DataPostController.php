<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\Orders;
use App\Models\Models;
use Illuminate\Support\Facades\Validator;

class DataPostController extends Controller
{
    public function Order(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'contact-number' => 'required|min:4|max:50',
            'email' => 'required|min:4|email|max:50',
            'models' => 'required',
            'type' => 'min:4|max:200',
        ]);
        if ($validator->fails()) {
            return redirect(route('index'))
                        ->withErrors([
                            'error' => [
                                "code" => 422,
                                "message" => "Validation error",
                                "errors" => $validator->errors(),
                            ]
                        ])
                        ->withInput();;
        }  

        $order = new Orders;

        $order->contact_number = $request->input('contact-number');
        $order->email = $request->input('email');
        if ($request->input('models') !== 'Другое') {
            $model = Models::Where('nameModel', $request->input('models'))->first();
            if (!$model) {
                $order->existing_model = 'false';
            } else {
                $order->company_code = $model->company_code;
                $order->model_code = $model->model_code;
                $order->existing_model = 'true';
            }
        }
        else {
            $order->existing_model = 'false';
        }
        
        $order->type_problem = $request->input('type');
        $order->status = 'На рассмотрении';

        $order->save();

        return redirect(route('admin'));
    }
    public function Question(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:50',
            'contact-number' => 'required|min:4|max:50',
            'text-question' => 'min:4|max:200',
        ]);
        if ($validator->fails()) {
            return redirect(route('index'))
                        ->withErrors([
                            'error' => [
                                "code" => 422,
                                "message" => "Validation error",
                                "errors" => $validator->errors(),
                            ]
                        ])
                        ->withInput();;
        }  

        $question = new Questions;

        $question->name = $request->input('name');
        $question->contact_number = $request->input('contact-number');
        $question->text_question = $request->input('text-question');
        $question->status = 'На рассмотрении';

        $question->save();

        return redirect(route('admin'));
    }
}
