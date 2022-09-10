<?php

namespace Modules\Contract\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Contract\Entities\Contract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $contracts = Contract::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('request.index',compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() 
    {
        return view('contract::create');
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
            'mobile' => ['required', 'digits:11', 'unique:contracts'],
            'contract_date' => 'required',
            'contract_subject' => 'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'status' => 'required|numeric|in:0,1',
            'start_date' => 'required',
            'end_date' => 'required',
            'notification_date' => 'required',
            'amount' => 'required|regex:/^[0-9]+$/u',
            'create_user' => 'exists:users,id',
            'description' => 'required|max:500|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
        ]);


        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->messages()]);
        }
        // dd($request);

        Contract::create([
            'customer_id' => $request->customer_id,
            'mobile' => $request->mobile,
            'contract_date' => $request->contract_date,
            'contract_subject' => $request->contract_subject,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'notification_date' => $request->notification_date,
            'amount' => $request->amount,
            'create_user' => $request->create_user,
            'description' => $request->description,
        ]);
        return response()->json(['message' => 'Contract create succesfully']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('contract::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('contract::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request,Contract $contract)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'exists:base_customers,id',
            'mobile' => ['required', 'digits:11'],
            'contract_date' => 'required',
            'contract_subject' => 'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'status' => 'required|numeric|in:0,1',
            'start_date' => 'required',
            'end_date' => 'required',
            'notification_date' => 'required',
            'amount' => 'required|regex:/^[0-9]+$/u',
            'create_user' => 'exists:users,id',
            'description' => 'required|max:500|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
        ]);


        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->messages()]);
        }

        $inputs = $request->all();
        
        $contract->update($inputs);

        return response()->json(['message' => 'Contract Update succesfully']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();
        return response()->json(['message' => 'Contract Delete succesfully']);
    }
}
