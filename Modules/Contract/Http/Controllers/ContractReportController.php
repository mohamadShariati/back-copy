<?php

namespace Modules\Contract\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;
use Modules\Contract\Entities\ContractReport;

class ContractReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $ContractReports = ContractReport::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('report.contract-report', compact('ContractReports'));
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
            'contract_id' => 'exists:contracts,id',
            'description' => 'required|max:500|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'attribute_name' => 'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'amount' => 'required|regex:/^[0-9]+$/u',
            'create_user' => 'exists:users,id',
            'send_date' => 'required',
            'contract_date' => 'required',
            'status' => 'required|numeric|in:0,1',
           
        ]);

        if($validator->fails())
        {
            return response()->json(['message'=>$validator->errors()->messages()]);
        }

        ContractReport::create([
            'customer_id' =>$request->customer_id,
            'description' =>$request->description,
            'attribute_name' =>$request->attribute_name,
            'amount' =>$request->amount,
            'create_user' =>$request->create_user,
            'send_date' =>$request->send_date,
            'contract_date'=> $request->contract_date,
            'status' =>$request->status,
        ]);
        
        return response()->json(['message' =>'ContractReport created succesfully']);
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
    public function update(Request $request,ContractReport $contractReport)
    {
        $validator = Validator::make($request->all(), [
            'contract_id' => 'exists:contracts,id',
            'description' => 'required|max:500|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'attribute_name' => 'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'amount' => 'required|regex:/^[0-9]+$/u',
            'create_user' => 'exists:users,id',
            'send_date' => 'required',
            'contract_date' => 'required',
            'status' => 'required|numeric|in:0,1',
        ]);

        if ($validator->fails()){
            return response()->json(['message' => $validator->errors()->messages()]);
        }

        $inputs = $request->all();
        $contractReport->update($inputs);

        return response()->json(['message' => 'ContractReport update succesfully']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(ContractReport $contractReport)
    {
        $contractReport->delete();
        return response()->json(['message' => 'report destroy succesfully']);
    }
}
