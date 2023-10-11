<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WriteUp;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $web = WriteUp::where("category_id",1)->count();
        $crypto = WriteUp::where("category_id",2)->count();
        $pwn = WriteUp::where("category_id",3)->count();
        $re = WriteUp::where("category_id",4)->count();
        $forensic = WriteUp::where("category_id",5)->count();
        return view("dashboard.index",compact('web','crypto','pwn','re','forensic'));
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
