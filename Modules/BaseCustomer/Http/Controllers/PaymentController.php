<?php

namespace Modules\BaseCustomer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\BaseCustomer\Entities\Payment;
use Illuminate\Contracts\Support\Renderable;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $payments = Payment::orderBy('created_at', 'desc')->simplePaginate(15);
        // return view('admin.payment',compact('payments')) ;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('basecustomer::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'exists:base_customers,id',
            'amount' => 'required|regex:/^[0-9]+$/u',
            'date_deposite' => 'required',
            'create_user' => 'exists:users,id',
            'status' => 'required|numeric|in:0,1',
        ]);


        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->messages()]);
        }
        // dd($request);

        Payment::create([
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
            'date_deposite' => $request->date_deposite,
            'create_user' => $request->create_user,
            'status' => $request->status,

        ]);
        return response()->json(['message' => 'payment create succesfully']);
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
    public function update(Request $request,Payment $payment)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'exists:base_customers,id',
            'amount' => 'required|regex:/^[0-9]+$/u',
            'date_deposite' => 'required',
            'create_user' => 'exists:users,id',
            'status' => 'required|numeric|in:0,1',
        ]);


        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->messages()]);
        }
      
        
        $inputs = $request->all();
        
        $payment->update($inputs);

        return response()->json(['message' => 'payment Update succesfully']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(['message' => 'payment Deleted succesfully']);

    }
}
