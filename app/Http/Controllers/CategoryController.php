<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy("id","DESC")->paginate(10);
        return view("categories.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->only('name','image'), [
            'name' => ['required','unique:categories,name'],
            'image' => ['required'],
        ]);
        if ($validate->fails()) {
            return response()->json([
                "status"  => false,
                "msg"     => "Insufficient fields",
                "data" => $validate->errors()->toArray()
            ]);
        } else {
            $fileName = date('d-m-Y').'_'.time().'_'.$request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('categories', $fileName, 'public');
            $data = new Category();
            $data->name = $request->name;
            $data->image = $filePath;
            $data->save();
            return response()->json([
                "status"  => true,
                "msg"     => "Category created successfully",
                "data" => []
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view("categories.edit",compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validate = Validator::make($request->only('name'), [
            'name' => ['required']
        ]);
        if ($validate->fails()) {
            return redirect()->route("categories.edit",$category->id)->with("error","Update category error");
        } else {
            if($request->has("image"))
            {
                $fileName = date('d-m-Y').'_'.time().'_'.$request->image->getClientOriginalName();
                $filePath = $request->file('image')->storeAs('categories', $fileName, 'public');
            }else
            {
                $filePath = $category->image;
            }
            $category->name = $request->name;
            $category->image = $filePath;
            $category->save();
            return redirect()->route("categories.edit",$category->id)->with("success","Successfully updated");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
