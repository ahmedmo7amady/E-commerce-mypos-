<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Validation\Rule;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
   
    public function index(Request $request)
    {
        $categories = Category::when($request->search , function($q) use ($request){
            return $q->whereTranslationLike('name' , '%' . $request->search . '%');
        })->latest()->paginate(5);
        return view('layouts.Admin.pages.categories.index' , compact('categories'));
    }//end of index

    
    public function create()
    {
        return view('layouts.Admin.pages.categories.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'ar.*' => 'required|unique:category_translations,name',
            'en.*' => 'required|unique:category_translations,name',
        ]);
        Category::create($request->all());
        session()->flash('success' , __('site.added_succesfully'));
        return redirect()->route('admin.categories.index');

    }//end of store
   
    public function edit(Category $category , Request $request)
    {

        return view('layouts.Admin.pages.categories.edit' , compact('category'));
    }//end of edit


    public function update(Request $request, Category $category)
    {
        $rule = [];
        
           
        foreach(config('translatable.locales') as $locale){

            $rule += [
                $locale.'.name' => [
                    'required',
                    Rule::unique('category_translations','name')->ignore($category->id , 'category_id'),
                ],
            ];

        }//end of foreach
           
            
        $category->update($request->all());
        session()->flash('success' , __('site.updated_succesfully'));
        return redirect()->route('admin.categories.index');

    }


    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success' , __('site.deleted_succesfully'));
        return redirect()->route('admin.categories.index');
    }//end of destroy
}//end of controller
