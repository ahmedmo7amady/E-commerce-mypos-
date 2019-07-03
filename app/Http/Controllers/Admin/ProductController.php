<?php

namespace App\Http\Controllers\admin;
use App\Category;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::when($request->search , function($q) use ($request){
            
            return $q->whereTranslationLike('name' , '%' .  $request->search . '%' );

        })->when($request->category_id , function($q) use ($request){

            return $q->where('category_id' ,$request->category_id);

        })->latest()->paginate(5);


        return view ('layouts.Admin.pages.product.index' , compact('categories' , 'products'));
    }//end of index

 
    public function create()
    {
        $categories = Category::all();
        return view ('layouts.Admin.pages.product.create' , compact('categories'));
    }//end of create

    public function store(Request $request)
    {

        $rules =[
            'category_id' => 'required',
        ];

        foreach(config('translatable.locales') as $locale){
            $rules +=   [ $locale . '.name' => 'required|unique:product_translations,name'];
            $rules +=   [ $locale . '.description' => 'required'];
        }

        $rules += [
            'purchase_price' => 'required', 
            'sale_price' => 'required',
            'stock' => 'required',
        ];
        // dd($request->all());
        $request->validate($rules);
        $request_data = $request->all();

        if($request->image){
            
            Image::make($request->image)
            ->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path('uploads/product_images/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

         
        }//end if 

        Product::create($request_data);
        session()->flash('success' , __('site.added_successfully'));
        return redirect()->route('admin.products.index');

    }//end of store


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('layouts.Admin.pages.product.edit' , compact('categories' , 'product'));
    }//end of edit

 
    public function update(Request $request, Product $product)
    {
        $rules =[
            'category_id' => 'required',
        ];

        foreach(config('translatable.locales') as $locale){
            $rules +=   [ $locale . '.name' => ['required' , Rule::unique('product_translations' , 'name' )->ignore($product->id , 'product_id')]];
            $rules +=   [ $locale . '.description' => 'required'];
        }

        $rules += [
            'purchase_price' => 'required', 
            'sale_price' => 'required',
            'stock' => 'required',
        ];
        // dd($request->all());
        $request->validate($rules);
        $request_data = $request->all();

        if($request->image){
            if($product->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
             }//end of if 
            
            Image::make($request->image)
            ->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path('uploads/product_images/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }//end if 

        $product->update($request_data);
        session()->flash('success' , __('site.edited_successfully'));
        return redirect()->route('admin.products.index');
    }//end of update


    public function destroy(Product $product)
    {
        if($product->image != 'default.png'){
            Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
         }
        $product->delete();
        session()->flash('success' , __('site.deleted_successfully'));
        return redirect()->route('admin.products.index');    }//end of destroy
}//end of contorller
