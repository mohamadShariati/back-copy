<?php

namespace Modules\BaseProduct\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;
use Modules\BaseProduct\Entities\BaseProduct;

class BaseProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $baseProducts = BaseProduct::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('base-product.index', compact('baseProducts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        dd('baseProduct.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'status' => 'required|numeric|in:0,1',
            'create_user' => 'exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->messages()]);
        }

        BaseProduct::create([
            'name' => $request->name,
            'status' => $request->status,
            'create_user' => $request->create_user
        ]);

        return response()->json(['message' => 'product create succesfully']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(BaseProduct $baseProduct)
    {
        return view('baseproduct::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(BaseProduct $baseProduct)
    {
        dd($baseProduct);
        // dd('hi');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, BaseProduct $baseProduct)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'status' => 'required|numeric|in:0,1',
            'create_user' => 'exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->messages()]);
        }

        $inputs = $request->all();
        $baseProduct->update($inputs);

        return response()->json(['message' => 'product update succesfully']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(BaseProduct $baseProduct)
    {
        $baseProduct->delete();
        return response()->json(['message' => 'product destroy succesfully']);
    }

    public function test()
    {
       
        $baseProducts = BaseProduct::find(1)->contracts()->orderBy('id')->get();
        dd($baseProducts);
        // foreach ($baseProducts as $baseProduct) {
        //     echo $baseProduct->description;
        // }
    }
}
