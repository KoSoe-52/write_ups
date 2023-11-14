<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view("users.index",compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->only('username','password','role_id'), [
            'username' => ['required','min:5','max:16','unique:users,username'],
            'password' => ['required', 'min:5', 'max:16'],
            'role_id' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                "status"  => false,
                "msg"     => "Insufficient fields",
                "data" => $validate->errors()->toArray()
            ]);
        } else {
            $data = new User();
            $data->username = $request->username;
            $data->password = Hash::make($request->password);
            $data->role_id = (int) $request->role_id;
            $data->save();
            return response()->json([
                "status"  => true,
                "msg"     => "Account created successfully",
                "data" => []
            ]);
        }
    }
    public function changeForm(Request $request)
    {
        return view("users.changepassword");
    }
    public function changePassword(Request $request)
    {
        $validate = Validator::make(
            $request->only('password','new_password','confirm_password'),
            [
                'password' => ['required', new MatchOldPassword],
                'new_password' => ['required', 'min:5', 'max:16','different:password'],
                'confirm_password' => ['same:new_password'],
            ]
        );
        if($validate->fails()){
            //return redirect("change-password")->withErrors($validate)->withInput(); 
            return response()->json([
                "status"  => false,
                "msg"     => "Insufficient fields",
                "data" => $validate->errors()->toArray()
            ]);
        }else
        {
            $data = User::find(Auth::user()->id);
            $data->password = Hash::make($request->new_password);
            $data->update();
            return response()->json([
                "status"  => true,
                "msg"     => "Password changed successfully",
                "data" => []
            ]);
        }
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
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            "status" => true,
            "msg" => "Deleted user",
            "data" => []
        ]);
    }
}
