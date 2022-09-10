<?php

namespace Modules\Request\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;
use Modules\Request\Entities\Request as EntitiesRequest;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $requests = EntitiesRequest::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('request.index',compact('requests'));
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
            'request_user'=>  'exists:users,id',
            'request_date'=> 'required',
            'base_product_id'=> 'exists:base_products,id',
            'subject'=> 'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'description'=> 'required|max:500|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'priority'=> 'required|numeric|in:0,1,2',
            'status'=> 'required|numeric|in:0,1',
            'complete_user'=> 'exists:users,id',
            'complete_date'=> 'required',
            'create_user'=> 'exists:users,id',
            'update_user'=> 'exists:users,id',
        ]);

        if($validator->fails()){
            return response()->json(['message' => $validator->errors()->messages()]);
        }

        EntitiesRequest::create([
            'request_user'=> $request->request_user,
            'request_date'=> $request->request_date,
            'base_product_id' =>$request->base_product_id,
            'subject'=>$request->subject,
            'description'=> $request->description,
            'periority'=> $request->periority,
            'status'=> $request->status,
            'complete_user'=>$request->complete_user,
            'complete_date'=> $request->complete_date,
            'create_user'=> $request->create_user,
            'update_user'=>$request->update_user
        ]);

        return response()->json(['message' => 'request created succesfully']);
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
    public function update(Request $request, EntitiesRequest $entitiesRequest)
    {
        $validator = Validator::make($request->all(), [
            'request_user'=>  'exists:users,id',
            'request_date'=> 'required',
            'base_product_id'=> 'exists:base_products,id',
            'subject'=> 'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'description'=> 'required|max:500|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'priority'=> 'required|numeric|in:0,1,2',
            'status'=> 'required|numeric|in:0,1',
            'complete_user'=> 'exists:users,id',
            'complete_date'=> 'required',
            'create_user'=> 'exists:users,id',
            'update_user'=> 'exists:users,id',
        ]);

        if($validator->fails()){
            return response()->json(['message' => $validator->errors()->messages()]);
        }

        $inputs = $request->all();
        $entitiesRequest->update($inputs);

        return response()->json(['message' => 'request update succesfully']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(EntitiesRequest $entitiesRequest)
    {
        $entitiesRequest->delete();
        return response()->json(['message' => 'request destroy succesfully']);
    }
}
