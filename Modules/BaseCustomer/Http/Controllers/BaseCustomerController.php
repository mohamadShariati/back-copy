<?php

namespace Modules\BaseCustomer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;
use Modules\BaseCustomer\Entities\BaseCustomer;

class BaseCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $customers = BaseCustomer::orderBy('created_at', 'desc')->simplePaginate(15);
        // return view('admin.customer',compact('customers')) ;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('basecustomer.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'agent' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'real_or_legal' => 'required|numeric|in:0,1',
            'province' => 'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'city' => 'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'address' => 'required|max:200|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'tel' => ['required', 'digits:8'],
            'mobile' => ['required', 'digits:11', 'unique:base_customers'],
            'manager_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'create_user' => 'exists:users,id',
            'status' => 'required|numeric|in:0,1',
        ]);


        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->messages()]);
        }
        // dd($request);

        BaseCustomer::create([
            'company_name' => $request->company_name,
            'agent' => $request->agent,
            'real_or_legal' => $request->real_or_legal,
            'province' => $request->province,
            'city' => $request->city,
            'address' => $request->address,
            'tel' => $request->tel,
            'mobile' => $request->mobile,
            'manager_name' => $request->manager_name,
            'create_user' => $request->create_user,
            'status' => $request->status,
        ]);
        return response()->json(['message' => 'BaseCustomer create succesfully']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('basecustomer::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('basecustomer::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request,BaseCustomer $baseCustomer)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'agent' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'real_or_legal' => 'required|numeric|in:0,1',
            'province' => 'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'city' => 'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'address' => 'required|max:200|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'tel' => ['required', 'digits:8'],
            'mobile' => ['required', 'digits:11'],
            'manager_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'create_user' => 'exists:users,id',
            'status' => 'required|numeric|in:0,1',
        ]);


        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->messages()]);
        }

        $inputs = $request->all();

        $baseCustomer->update($inputs);

        return response()->json(['message' => 'BaseCustomer Update succesfully']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(BaseCustomer $baseCustomer)
    {
        $baseCustomer->delete();
        return response()->json(['message' => 'BaseCustomer Delete succesfully']);

    }
}
