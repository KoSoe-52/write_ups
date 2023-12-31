<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WriteUp;
use App\Models\Category;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::leftJoin("write_ups","categories.id","=","write_ups.category_id")
                     ->select("categories.name","categories.image",DB::raw("COUNT(write_ups.id) as total"))
                     ->groupBy(["categories.name","categories.image"])->get();
        $colors = [];
        /**
         * categories ရှိသလောက် colors ကို generate လုပ်ဆောင်သည်
         */
        if(count($categories) > 0)
        {
             for($i=0;$i<count($categories);$i++)
             {
                $colors[] = "#".dechex(rand(0x000000, 0xFFFFFF));
             }
        }
        return view("dashboard.index",compact('categories','colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
