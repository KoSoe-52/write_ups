<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role_id == 1)
        {
            $files = File::orderBy("id","DESC")->paginate(15);
        }else
        {
            $files = File::where("user_id",Auth::user()->id)->orderBy("id","DESC")->paginate(15);
        }
        return view("files.index",compact("files"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("files.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->only('pdf_file'), [
            'pdf_file' => ['required'],
        ]);
        if ($validate->fails()) {
            return response()->json([
                "status"  => false,
                "msg"     => "Insufficient fields",
                "data" => $validate->errors()->toArray()
            ]);
        } else {
            $fileName = date('d-m-Y').'_'.time().'_'.$request->pdf_file->getClientOriginalName();
            $filePath = $request->file('pdf_file')->storeAs('files', $fileName, 'public');
            $data = new File();
            $data->name = "files/".$fileName;
            $data->user_id = Auth::user()->id;
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
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }
}
