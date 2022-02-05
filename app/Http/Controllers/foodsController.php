<?php

namespace App\Http\Controllers;

use App\Http\Requests\foodRequest;
use App\Models\foods;
use Illuminate\Http\Request;

class foodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['foods'=>foods::latest()->get()]);
    }
    public function indexOrder()
    {
        $foods=foods::where('number_of_sale','<>',0)->get();

        $total=0;
        foreach($foods as $row){
            $total+=$row->price * $row->number_of_sale;
        }

        
        return response()->json([
            'foods'=>foods::where('number_of_sale','<>',0)->get(),
            'total'=>$total]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(foodRequest $request)
    {
        auth('api')->user()->foods()->create($request->only('name','price'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['food'=>foods::where('id',$id)->with('user')->get()]);
    }
    public function singleOrder($id)
    {
        return response()->json(['food'=>foods::where('id',$id)->get()]);
    }
    public function search($search)
    {
        return response()->json(['food'=>foods::where('name','LIKE','%'.$search.'%')->get()]);
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
    public function order(Request $request, $id)
    {
        foods::findOrFail($id)->update($request->only('number_of_sale'));
    }
    public function update(Request $request, $id)
    {
        foods::findOrFail($id)->update($request->only('name','price'));
    }
    public function singleOrderUpdate(Request $request, $id)
    {
        foods::findOrFail($id)->update($request->only('number_of_sale'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        foods::findOrFail($id)->delete();
    }
}
