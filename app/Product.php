<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [''];
    public $translatedAttributes = ['name' , 'description'];
    protected $appends = ['image_path' , 'profit_percent'];

    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' .  $this->image);
    }// end of path

    public function getProfitPercentAttribute(){

        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent , 2 ) ;

    }// end of profit percent func

    public function category(){

        return $this->belongsTo(Category::class);
    }
}// end of model
