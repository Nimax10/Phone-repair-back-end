<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Models;
use App\Models\Orders;
use App\Models\Questions;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Company as GlobalCompany;
use Symfony\Component\Console\Question\Question;

class AdminData extends Controller
{
    public function Admin() {
        return view("admin");
    }

    public function DataOrders() {
        $orders = Orders::all();
        foreach ($orders as $value) {
            $company = Company::Where('company_code', $value->company_code)->first();
            $model = Models::Where('model_code', $value->model_code)->first();
            if (!$company || !$model) {
                return response()->json($orders, 200);
            }
            $value->company = $company->name;
            $value->model = $model->nameModel;
        }
        return response()->json($orders, 200);
    }
    public function DataQuest() {
        $questions = Questions::all();
        return response()->json($questions, 200);
    }


    public function order_editOrDelete(Request $request) {
        if ($request->order_line === null || $request->order_column === null) {
            return redirect(route('admin'));
        }
        if ($request->button === 'edit') {
            $order = Orders::Where('id_order', $request->order_line)->first();
            if ($request->order_column === 'contact_number') {
                $order->contact_number = $request->edit_on;
                $order->save();
                return redirect(route('admin'));
            } else if ($request->order_column === 'email') {
                $order->email = $request->edit_on;
                $order->save();
                return redirect(route('admin'));
            } else if ($request->order_column === 'model') {
                $model = Models::Where('nameModel', $request->edit_on)->first();
                if(!$model) {
                    $order->company_code = NULL;
                    $order->model_code = NULL;
                    $order->existing_model = 'false';
                    $order->save();
                    return redirect(route('admin'));
                }
                $order->company_code = $model->company_code;
                $order->model_code = $model->model_code;
                $order->existing_model = 'true';
                $order->save();
                return redirect(route('admin'));
            } else if ($request->order_column === 'existing_model') {
                $order->existing_model = $request->edit_on;
                $order->save();
                return redirect(route('admin'));
            } else if ($request->order_column === 'type_problem') {
                $order->type_problem = $request->edit_on;
                $order->save();
                return redirect(route('admin'));
            } else if ($request->order_column === 'status') {
                $order->status = $request->edit_on;
                $order->save();
                return redirect(route('admin'));
            } else {
                return redirect(route('admin'));
            }
        } else if ($request->button === 'delete') {
            $order = Orders::Where('id_order', $request->order_line)->first();
            $order->delete();
            return redirect(route('admin'));
        }
        return redirect(route('admin'));
    }


    public function question_editOrDelete(Request $request) {
        if ($request->quest_line === null || $request->quest_column === null) {
            return redirect(route('admin'));
        }
        if ($request->button === 'edit') {
            $questions = Questions::Where('id_question', $request->quest_line)->first();
            if ($request->quest_column === 'name') {
                $questions->name = $request->edit_on;
                $questions->save();
                return redirect(route('admin'));
            } else if ($request->quest_column === 'contact_number') {
                $questions->contact_number = $request->edit_on;
                $questions->save();
                return redirect(route('admin'));
            } else if ($request->quest_column === 'text_question') {
                $questions->text_question = $request->edit_on;
                $questions->save();
                return redirect(route('admin'));
            } else if ($request->quest_column === 'status') {
                $questions->status = $request->edit_on;
                $questions->save();
                return redirect(route('admin'));
            } else {
                return redirect(route('admin'));
            }
        } else if ($request->button === 'delete') {
            $questions = Questions::Where('id_question', $request->quest_line)->first();
            $questions->delete();
            return redirect(route('admin'));
        }
        return redirect(route('admin'));
    }

    public function DataCompany() {
        $questions = Company::all();
        return response()->json($questions, 200);
    }

    public function DataModels() {
        $questions = Models::all();
        return response()->json($questions, 200);
    }

    public function company_editOrDelete(Request $request) {
        if ($request->comp_line === null || $request->comp_column === null) {
            return redirect(route('admin'));
        }
        if ($request->button === 'edit') {
            $company = Company::Where('company_code', $request->comp_line)->first();
            if ($request->comp_column === 'name') {
                $company->name = $request->edit_on;
                $company->save();
                return redirect(route('admin'));
            } else if ($request->comp_column === 'imageCompany') {
                $company->imageCompany = $request->edit_on;
                $company->save();
                return redirect(route('admin'));
            } else if ($request->comp_column === 'widthLogo') {
                $company->widthLogo = $request->edit_on;
                $company->save();
                return redirect(route('admin'));
            } else if ($request->comp_column === 'heightLogo') {
                $company->heightLogo = $request->edit_on;
                $company->save();
                return redirect(route('admin'));
            } else {
                return redirect(route('admin'));
            }
        } else if ($request->button === 'delete') {
            $company = Company::Where('company_code', $request->comp_line)->first();
            unlink(public_path($company->imageCompany));
            $company->delete();
            return redirect(route('admin'));
        }
        return redirect(route('admin'));
    }

    public function company_create(Request $request) {
        $image_name = $request->file("imageCompany")->getClientOriginalName();

        $image_path = "assets/css/img/images/";
        $request->file("imageCompany")->move(public_path($image_path), $image_name);

        $company = new Company;
        
        $company->company_code = Auth::id();
        $company->name = $request->name;
        $company->imageCompany = $image_path.$image_name;
        $company->widthLogo = $request->widthLogo;
        $company->heightLogo = $request->heightLogo;

        $company->save();
        return redirect(route('admin'));
    }

    public function model_editOrDelete(Request $request) {
        if ($request->model_line === null || $request->model_column === null) {
            return redirect(route('admin'));
        }
        if ($request->button === 'edit') {
            $model = Models::Where('model_code', $request->model_line)->first();
            if ($request->model_column === 'company_code') {
                $model->company_code = $request->edit_on;
                $model->save();
                return redirect(route('admin'));
            } else if ($request->model_column === 'nameModel') {
                $model->nameModel = $request->edit_on;
                $model->save();
                return redirect(route('admin'));
            } else if ($request->model_column === 'imgModel') {
                $model->imgModel = $request->edit_on;
                $model->save();
                return redirect(route('admin'));
            } else {
                return redirect(route('admin'));
            }
        } else if ($request->button === 'delete') {
            $model = Models::Where('model_code', $request->model_line)->first();
            unlink(public_path($model->imgModel));
            $model->delete();
            return redirect(route('admin'));
        }
        return redirect(route('admin'));
    }

    public function model_create(Request $request) {
        $image_name = $request->file("imgModel")->getClientOriginalName();

        $image_path = "assets/css/img/images/";
        $request->file("imgModel")->move(public_path($image_path), $image_name);

        $model = new Models;
        
        $model->model_code = Auth::id();
        $model->company_code = $request->company_code;
        $model->nameModel = $request->nameModel;
        $model->imgModel = $image_path.$image_name;

        $model->save();
        return redirect(route('admin'));
    }

    public function admin_create(Request $request) {
        $admin = new Admin;

        $admin->id_admin = Auth::id();
        $admin->login = $request->login;
        $admin->password = $request->password;
        $admin->api_token = null;

        $admin->save();
        return redirect(route('admin'));
    }
}
