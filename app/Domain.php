<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    public function Category(){
        return $this->belongsTo(Category::class);
    }
    public function Subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
}

