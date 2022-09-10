<?php

namespace Modules\Request\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Request\Entities\RequestLog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;

class RequestLogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $contracts = RequestLog::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('request.index',compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('request::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'request_id'=>  'exists:requests,id',
            'subject'=> 'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'description'=> 'required|max:500|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'status'=> 'required|numeric|in:0,1',
            'create_user'=> 'exists:users,id',
        ]);

        if($validator->fails()){
            return response()->json(['message' => $validator->errors()->messages()]);
        }

        RequestLog::create([
            'request_id'=> $request->request_id,
            'subject'=> $request->subject,
            'description' =>$request->description,
            'status'=>$request->status,
            'create_user'=> $request->create_user,
            'periority'=> $request->periority,
        ]);

        return response()->json(['message' => 'requestLog created succesfully']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('request::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('request::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request,RequestLog $requestLog)
    {
        $validator = Validator::make($request->all(), [
            'request_id'=>  'exists:requests,id',
            'subject'=> 'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'description'=> 'required|max:500|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'status'=> 'required|numeric|in:0,1',
            'create_user'=> 'exists:users,id',
        ]);

        if($validator->fails()){
            return response()->json(['message' => $validator->errors()->messages()]);
        }

        $inputs = $request->all();
        $requestLog->update($inputs);

        return response()->json(['message' => 'requestLog update succesfully']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(RequestLog $requestLog)
    {
        $requestLog->delete();
        return response()->json(['message' => 'log delete succesfully']);
    }
}
