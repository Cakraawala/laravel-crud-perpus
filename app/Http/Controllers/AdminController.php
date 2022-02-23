<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return  Admin::all();
    }
    public function store (){
        request()->validate([
            'nama' => 'required',
            'user_admin' => 'required',
            'password' => 'required'
        ]);
        return Admin::create([
            'nama' => request('nama'),
            'user_admin' => request('user_admin'),
            'password' => request('password')
        ]);
    }

    public function update (Admin $id){
        request()->validate([
            'nama' => 'required',
            'user_admin' => 'required',
            'password' => 'required'
        ]);

        $success = $id->update([
            'nama' => request('nama'),
            'user_admin' => request('user_admin'),
            'password' => request('password')
        ]);

        return [
            'success' => $success
        ];
    }

    public function show(Admin $id)
    {
        try {
            $item = $this->model->with('books')->findOrFail($id);
            return response(['data' => $item, 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Item Not Found!', 'status' => 404]);
        }
    }

    public function destroy(Admin $id){
        $success = $id->delete();

        return [
            'success' => $success
        ];
    }

}

