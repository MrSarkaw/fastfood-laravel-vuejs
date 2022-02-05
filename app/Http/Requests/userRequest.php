<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class userRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $user=$request->id;
        if(in_array($this->method(),['PUT','PATCH'])){
            return [
                'name'=>'required',
                'email'=>'required|email|unique:users,email,'.$user,
                'password'=>'sometimes|required|min:6',
            ];
    }else{
        return [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
        ];
    }
    }

    public function messages(){
        return[
            'name.required'=>"ببورە : تكایە ناو پڕبكەرەوە",
            'email.required'=>"ببورە : تكایە ئیمەیل پڕبكەرەوە",
            'email.email'=>"ببورە : تكایە دڵنیابەرەوە لە ئیمەیل ",
            'email.unique'=>"ببورە : ئەم ئیمەیلە بەكارهاتووە",
            'email.required'=>"ببورە : تكایە ئیمەیل پڕبكەرەوە",
            'password.required'=>"ببورە : تكایە تێپەڕوشە پڕبكەرەوە",
            'password.min'=>"ببورە : تێپەڕوشە ئەبێ زیاتر لە 6"
        ];
    }
}
