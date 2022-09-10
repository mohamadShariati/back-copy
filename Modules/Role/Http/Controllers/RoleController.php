<?php

namespace Modules\Role\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Role\Entities\Role;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $roles=Role::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('role::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'attribute_name' =>'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'status' => 'required|numeric|in:0,1'
        ]);
        if($validator->fails()){
            return response()->json(['message' => $validator->errors()->messages()]);
        }

        Role::create([
            'name' =>$request->name,
            'attribute_name' =>$request->attribute_name,
            'status' =>$request->status
        ]);

        return response()->json(['message' => 'role create succesfully']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('role::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('role::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request,Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'attribute_name' =>'required|max:50|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'status' => 'required|numeric|in:0,1'
        ]);
        if($validator->fails()){
            return response()->json(['message' => $validator->errors()->messages()]);
        }

        $inputs = $request->all();
        $role->update($inputs);

        return response()->json(['message' => 'role update succesfully']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'role destroy succesfully']);
    }
}
