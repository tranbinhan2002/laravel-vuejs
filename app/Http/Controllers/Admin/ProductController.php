<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::when(request('search'),function($query){
            $query->where('name','like','%'. request('search') .'%')->paginate(5);
        })->with('category')->paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required| integer',
            'unit'=> 'required',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image')->getClientOriginalName();
            $fileName = time() . '-' . $file;
            $image = Storage::url($request->file('image')->storeAs('public/product', $fileName));
        }

        $product= Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'image' => $image,
            'unit' => $request->unit,
            'description' => $request->description,
        ]);

        $product->save();

        return response()->json($product, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if ($product) {
            return response()->json($product, 200);
        } else {
            return response()->json('failed', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required| integer',
            'description' => 'required',
        ]);
        $image = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image')->getClientOriginalName();
            $fileName = time() . '-' . $file;
            unlink(public_path() .'/'.$product->image);
            $image = Storage::url($request->file('image')->storeAs('public/product', $fileName));
        } else {
            $image = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'image' => $image,
            'unit' => $request->unit,
            'description' => $request->description,
        ]);

        $product->save();

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product) {
            $product->delete();
            unlink(public_path() .'/'.$product->image);
            return response()->json('success', 200);
        } else {
            return response()->json('failed', 404);
        }
    }
    public function changeStatus(Product $product)
    {
        if($product){
            $product->update(['status'=> !$product->status]);
            return  response()->json('success', 200);
        }
        else{
            return response()->json('failed',404);
        }
     
    }
}
