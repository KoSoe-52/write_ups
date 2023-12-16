<?php

namespace App\Http\Controllers;

use App\Models\WriteUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\WriteUpPoint;
use App\Models\User;
class WriteUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $write_ups = WriteUp::query();
        $requestArray = array();
        if(!empty($request->title))
        {
            $write_ups->where("title","LIKE",'%'.$request->title.'%');
            $requestArray[] = $request->title;
        }
        if(!empty($request->category_id))
        {
            $write_ups->where("category_id",$request->category_id);
            $requestArray[] = $request->category_id;
        }
        if(count($requestArray) > 0)
        {
            $write_ups = $write_ups->orderBy("id","DESC")->paginate(10);
            $write_ups = $write_ups->appends($request->all());
        }else
        {
            $write_ups = $write_ups->orderBy("id","DESC")->paginate(10);
        }
        $categories = Category::all();
        return view("write_ups.index",compact("write_ups","categories"));
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
        if(Auth::user()->role_id == 1)
        {
            $validate = Validator::make(
                $request->only('title','category_id','content','point','status'),
                [
                    'title' => ['required'],
                    'category_id' => ['required'],
                    'content' => ['required'],
                    'point' => ['required'],
                    'status' => ['required'],
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
                $data->point = $request->point;
                $data->status = $request->status;
                $data->save();
                /**
                 * point save
                 */
                $point = new WriteUpPoint();
                $point->point = $request->point;
                $point->write_up_id = $data->id;
                $point->save();
                return response()->json([
                    "status"  => true,
                    "msg"     => "Content created",
                    "data" => []
                ]);
            }
        }else
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
                $data->status = $request->status;
                $data->save();
                /**
                 * point save
                 */
                $point = new WriteUpPoint();
                $point->point = 0;
                $point->write_up_id = $data->id;
                $point->save();
                return response()->json([
                    "status"  => true,
                    "msg"     => "Content created",
                    "data" => []
                ]);
            }
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(WriteUp $writeUp)
    {
        return view("write_ups.show",compact("writeUp"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WriteUp $writeUp)
    {
        $categories = Category::all();
        return view("write_ups.edit",compact('writeUp','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WriteUp $writeUp)
    {
        if(Auth::user()->role_id == 1)
        {
            $validate = Validator::make(
                $request->only('title','category_id','content','point','status'),
                [
                    'title' => ['required'],
                    'category_id' => ['required'],
                    'content' => ['required'],
                    'point' => ['required'],
                    'status' => ['required'],
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
                // return response()->json([
                //     "status"  => true,
                //     "msg"     => "Successfully updated!",
                //     "data" => [$writeUp->user_id]
                // ]);
                /**
                 * user or team တင်ထားတဲ့ write up ဆိုရင် point အတိုးအလျော့လုပ်ပေးရမည်
                 */
                if($writeUp->users->role_id == 2 || $writeUp->users->role_id == 3)
                {
                        $currentPoint = WriteUpPoint::where("write_up_id",$writeUp->id)->first();

                        $officialPoint =  ($request->point - $currentPoint->point);
                        /**
                         * get user point
                         */
                        $user = User::find($writeUp->user_id);
                        $user_point = $user->user_point + $officialPoint;
                        $user->user_point = $user_point;
                        $user->update();
                        /**
                         * update write_up_points
                         */
                        WriteUpPoint::where("write_up_id",$writeUp->id)->update(["point"=>$request->point]);
                    
                }else
                {
                    /**
                     * admin update
                     */
                    WriteUpPoint::where("write_up_id",$writeUp->id)->update(["point"=>$request->point]);
                }
                $writeUp->title = $request->title;
                $writeUp->category_id = $request->category_id;
                $writeUp->content = $request->content;
                $writeUp->point = $request->point;
                $writeUp->status = $request->status;
                $writeUp->update();
                return response()->json([
                    "status"  => true,
                    "msg"     => "Successfully updated!",
                    "data" => []
                ]);
            }
        }else{
            $validate = Validator::make(
                $request->only('title','category_id','content'),
                [
                    'title' => ['required'],
                    'category_id' => ['required'],
                    'content' => ['required'],
                    //'point' => ['required'],
                    //'status' => ['required'],
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
                $writeUp->title = $request->title;
                $writeUp->category_id = $request->category_id;
                $writeUp->content = $request->content;
               // $writeUp->point = $request->point;
               // $writeUp->status = $request->status;
                $writeUp->update();
                return response()->json([
                    "status"  => true,
                    "msg"     => "Successfully updated!",
                    "data" => []
                ]);
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WriteUp $writeUp)
    {

        /**
         * process ၃ ခု ဆောင်ရွက်ရသည်
         */
        DB::beginTransaction();
        try{
            $write_ups_point = WriteUpPoint::where("write_up_id",$writeUp->id)->first();
            /**
             * get payment point
             */
            $paymentPoint = (int) $write_ups_point->point;
            $write_ups_point->delete();
            /**
             * get user_id
             */
            $user_id = $writeUp->user_id;
            $writeUp->delete();
            /**
             * ပေးထားတဲ့ user point ကို ပြန်နုတ် ယူသည်
             */
            if($paymentPoint > 0)
            {
                $user = User::find($user_id);
                $user->user_point = (int) ($user->user_point - $paymentPoint);
                $user->update();
            }
        }catch(\Exception $e)
        {
            DB::rollback();
            return response()->json([
                "status"  => false,
                "msg"     => "INTERNAL SERVER ERROR!",
                "data" => []
            ],500);
        } 
        DB::commit(); 
        return response()->json([
            "status" => true,
            "msg" => "Write Up ပယ်ဖျက်ခြင်း အောင်မြင်ပါသည်",
            "data" => []
        ]);
    }
}
