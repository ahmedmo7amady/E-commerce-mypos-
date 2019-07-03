<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;

class ClientController extends Controller
{
    public function index(Request $request){


        $clients = Client::when($request->search , function($q) use ($request){
            return $q->where('name' , 'like' , '%' . $request->search . '%')
                   ->orwhere('phone' , 'like' , '%' . $request->search . '%')
                   ->orwhere('address' , 'like' , '%' . $request->search . '%');

        })->latest()->paginate(5);



        return view('layouts.Admin.pages.clients.index' , compact('clients'));
    }//end of index

     public function create()
    {
        return view('layouts.Admin.pages.clients.create');
    }// end of create

     public function store(Request $request)
    {
        $request->validate([
            'name' => 'required' , 
            'phone' => 'required|array|min:1' , 
            'phone.0' => 'required',
            'address' => 'required',
        ]);
        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);
        Client::create($request_data);
        session()->flash('success' , '__(site.added_successfully');
        return redirect()->route('admin.clients.index');
    }// end of store

     public function edit(Client $client)
    {
        return view('layouts.Admin.pages.clients.edit' , compact('client'));
    }// end of edit

     public function update(Request $request , Client $client)
    {
        $request->validate([
            'name' => 'required' , 
            'phone' => 'required|array|min:1' , 
            'phone.0' => 'required',
            'address' => 'required',
        ]);
        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);
         $client->update($request_data);
        session()->flash('success' , '__(site.edited_successfully');
        return redirect()->route('admin.clients.index');
    }// end of update

     public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('success' , '__(site.deleted_successfully');
        return redirect()->route('admin.clients.index');
    }// end of destroy


}//end of controller     
