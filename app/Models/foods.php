<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class foods extends Model
{
    use HasFactory;
    protected $fillable=['name','price','number_of_sale'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
