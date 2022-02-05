<?php

namespace App\Http\Controllers;

use App\Models\orderedFood;
use Illuminate\Http\Request;

class report extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $order=orderedFood::all()->groupBy('name');
        $name=[];
        $newArray=[];
        foreach($order as $key => $source ){
          $newArray[]=$key." : (".count($source).")";
          $name[]=$key;
        }

        $orderForTotal=orderedFood::all();
        $total=0;
        foreach($orderForTotal as $row){
            $total+=$row->price;
        }
         return response()->json(['order'=>$newArray,'total'=>$total,'name'=>$name]);
    }


    public function filterSearch(Request $request)
    {
        $name=[];
        if($request->name==null){
            $order=orderedFood::all()->groupBy('name');
            foreach($order as $row => $key){
                $name[]=$row;
            }
        }else{
            $name[]=$request->name;
        }

        $startdate='';
        $enddate='';
        if($request->startDate == null || $request->endDate==null){
            $date=orderedFood::latest()->get();
                $startdate='2020-1-1';
                $enddate=$date->max('created_at');
        }else{
            $startdate=$request->startDate;
            $enddate=$request->endDate;
        }



        $orderResult=orderedFood::whereIn('name',$name)->whereBetween('created_at',[$startdate,$enddate])->get()->groupBy('name');
        $newArray=[];
        foreach($orderResult as $key => $source ){
          $newArray[]=$key." : (".count($source).")";
        }

        $orderForTotal=orderedFood::whereIn('name',$name)->whereBetween('created_at',[$startdate,$enddate])->get();
        $total=0;
        foreach($orderForTotal as $row){
            $total+=$row->price;
        }

        return response()->json(['order'=>$newArray,'total'=>$total,'name'=>$name]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        return $request->all();
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
