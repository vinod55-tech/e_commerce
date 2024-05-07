<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory;
    use Softdeletes;

    public function productDetails(){
        return $this->hasMany(Productdetail::class,'color_id');
    }
}
