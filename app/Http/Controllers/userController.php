<?php

namespace App\Http\Controllers;

use App\Http\Requests\userRequest;
use App\Models\foods;
use App\Models\orderedFood;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index()
    {   
         $user=auth('api')->id();
             
        return response()->json(['users'=>User::latest()->where('id','<>',$user)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function countData(){
        $user=count(User::all());
        $foods=count(foods::all());
        $orders=count(orderedFood::all());

        return response()->json([
            "users"=>$user,
            "foods"=>$foods,
            "orders"=>$orders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(userRequest $request)
    {
     

        $request->merge(['password'=>Hash::make($request->password)]);
        User::create($request->only('name','email','password'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['user'=>User::findOrFail($id)]);
    }
    public function currentUser()
    {
        return response()->json(['user'=>auth('api')->user()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(userRequest $request, $id)
    {
        if($request->password==""){
            User::findOrFail($id)->update($request->only('name','email'));
        }else{
            $request->merge(['password'=>Hash::make($request->password)]);
            User::findOrFail($id)->update($request->only('name','email','password'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
    }
}
