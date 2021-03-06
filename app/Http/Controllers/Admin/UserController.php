<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only(['update','edit']);
        $this->middleware(['permission:delete_users'])->only('destroy');

    }

    public function index(Request $request)
    {

        $users = User::whereRoleIs('admin')->where(function($q) use ($request){
            return $q->when($request->search,function($query)use($request){

                return $query->where('first_name','like','%' . $request->search . '%')
                ->orWhere('last_name' , 'like' , '%' . $request->search . '%');
            });

        })->latest()->paginate(5);
        
        return view('layouts.Admin.pages.users.index' , compact('users'));


    }//end of the index

    public function create()
    {
        return view ('layouts.admin.pages.users.create');
    }//end of create

    public function store(Request $request)
    {


        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required',Rule::unique('users')],
            'image' => 'image',
            'password' => 'required|confirmed',
            'permissions' => 'required|min:1'
        ]);
        $request_data = $request->except(['password' ,'password_confirmation' , 'permissions' ,'image']);
        $request_data['password'] = bcrypt($request->password);

        if($request->image){
            Image::make($request->image)
            ->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path('uploads/user_images/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }//end if 
        $user = User::create($request_data);

        $user->attachRole('admin');

        $user->syncPermissions($request->permissions);

        session()->flash('success' , __('site.added_succesfully'));

        return redirect()->route('admin.users.index');
    } 


    public function edit(User $user)
    {
        return view('layouts.Admin.pages.users.edit' , compact('user'));
    }//end edit function


    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'image' => 'image',
            'email' => ['required',Rule::unique('users')->ignore($user->id),],
            'permissions' => 'required|min:1'

        ]);
        $request_data = $request->except(['permissions' , 'image']);

        if($request->image){
            if($user->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
             }
            Image::make($request->image)
            ->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path('uploads/user_images/'.$request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }//end if 

        $user->update($request_data);
        $user->syncPermissions($request->permissions);// to usedit in update or add its(sync)
        session()->flash('success' , __('site.updated_succesfully'));

        return redirect()->route('admin.users.index');

    }//end of update

    public function destroy(User $user)
    {
        if($user->image != 'default.png'){
           Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
        }
        $user->delete();
        session()->flash('success' , __('site.deleted_succesfully'));
        return redirect()->route('admin.users.index');

    }
}//end of controller
