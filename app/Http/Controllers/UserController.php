<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(){
        return  User::all();
    }
    public function store (){
        request()->validate([
            'nama_anggota' => 'required',
            'user_anggota' => ['required', 'min:3', 'max:255', 'unique:user'],
            'no_induk' => 'required',
            'jenis_kelamin' => ['required','in:Pria,Wanita'],
            'no_telp' => ['required', 'max:15'],
            'alamat' => ['required','max:255'],
            'email' => ['required', 'email:dns', 'unique:user'],
            'password' => ['required', 'min:5', 'max:255']
        ]);
        return User::create([
            'nama_anggota' => request('nama_anggota'),
            'user_anggota' => request('user_anggota'),
            'no_induk' => request('no_induk'),
            'no_telp' => request('no_telp'),
            'alamat' => request('alamat'),
            'jenis_kelamin' =>request('jenis_kelamin'),
            'email' => request('email'),
            'password'=> request('password')
        ]);
    }

    public function update (User $id){
        request()->validate([
            'nama_anggota' => 'required',
            'user_anggota' => 'required',
            'no_induk' => 'required',
            'jenis_kelamin' => ['required','in:Pria,Wanita'],
            'no_telp' => ['required', 'max:15'],
            'alamat' => ['required','max:255'],
            'email' => ['required','string', 'email', 'max:255','unique:id'],
            'password' => ['required', 'string', 'min:5', 'confirmed']

        ]);

        $success = $id->update([
            'nama_anggota' => request('nama_anggota'),
            'user_anggota' => request('user_anggota'),
            'no_induk' => request('no_induk'),
            'no_telp' => request('no_telp'),
            'alamat' => request('alamat'),
            'jenis_kelamin' =>request('jenis_kelamin'),
            'email' => request('email'),
            'password'=> request('password')
        ]);

        return [
            'success' => $success
        ];
    }

    public function destroy(User $id){
        $success = $id->delete();

        return [
            'success' => $success
        ];
    }
}
