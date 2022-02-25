<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $frog;

    public function __construct(Admin $admin)
    {
        $this->frog = $admin;
    }

    public function index(){
        $admins = $this->frog->get();
        return response()->json(['List Data' => 'Admin',
                        'data' => $admins]);
    }


    public function store (Request $request){
        $request->validate([
            'nama' => 'required',
            'user_admin' => 'required|unique:admin|min:3|max:255',
            'password' => 'required'
        ]);
        $this->frog->create($request->all());
        return $this->index();
    }

    public function update ($id, Request $request){
        try {
            $data = $this->frog->findOrFail($id);
            $data->update($request->all());
            return response()->json(['Message' => 'Data edited successfully', 'data' => $data]);
        }catch (ModelNotFoundException){
            return response()->json(['Error' => '404', 'Message' => 'Item not found or not created yet!']);
        }
    }

    public function destroy($id){
        try{
            $data = $this->frog->findOrFail($id);
            $data->delete();
            return response()->json([
                'Message' => 'Data Successfully deleted'
            ]);
        } catch (ModelNotFoundException) {
            return response()->json(['Error' => '404','Message' => 'Item not found or not created yet!']);
        }
    }

    public function show($id){
        try{
            $data = $this->frog->findOrFail($id);
            return response(['List Data' => $data]);
        } catch (ModelNotFoundException) {
            return response()->json(['Error' => '404', 'Message' => 'Item not found or not created yet!']);
        }
    }


}
