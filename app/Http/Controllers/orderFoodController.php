<?php

namespace App\Http\Controllers;

use App\Models\foods;
use App\Models\orderedFood;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class orderFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return response()->json([
           'food'=>orderedFood::latest()->paginate(20)
       ]);
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
        $foods= foods::where('number_of_sale','<>',0)->get();
        if(count($foods)>0){
            foreach($foods as $row){
                for($x=0;$x<$row->number_of_sale;$x++){
                    auth('api')->user()->orderedFood()->create([
                        'name'=>$row->name,
                        'price'=>$row->price,
                    ]);
                }
            }

            foods::where('number_of_sale','<>',0)->update(['number_of_sale'=>0]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        orderedFood::where('id',$id)->delete();
    }
}
