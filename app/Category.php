<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use \Dimsav\Translatable\Translatable;
    
    public $translatedAttributes = ['name' , 'description'];
    protected $fillable = [''];
    


    public function product(){
        return $this->hasmany(Product::class);
    }
}// end of model

