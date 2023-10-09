<?php

namespace App\Http\Controllers;

use App\Models\WriteUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
class WriteUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $write_ups = WriteUp::paginate(10);
        return view("write_ups.index",compact("write_ups"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("write_ups.create",compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->only('title','category_id','content'),
            [
                'title' => ['required'],
                'category_id' => ['required'],
                'content' => ['required'],
            ]
        );
        if($validate->fails()){
            return response()->json([
                "status"  => false,
                "msg"     => "Insufficient fields",
                "data" => $validate->errors()->toArray()
            ]);
        }else
        {
            $data = new WriteUp();
            $data->title = $request->title;
            $data->category_id= $request->category_id;
            $data->content = $request->content;
            $data->user_id = Auth::user()->id;
            $data->save();
            return response()->json([
                "status"  => true,
                "msg"     => "Content created",
                "data" => []
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WriteUp $writeUp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WriteUp $writeUp)
    {
        return view("write_ups.edit",compact('writeUp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WriteUp $writeUp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WriteUp $writeUp)
    {
        //
    }
}
