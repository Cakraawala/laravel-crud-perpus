<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $frog;

    public function __construct(User $user)
    {
        $this->frog = $user;
    }

    public function index(){
        $user = $this->frog->get();
        return response()->json(['List Data' => 'User', 'data'=>$user]);
    }

    public function store (Request $request){
        $request->validate([
            'nama_anggota' => 'required',
            'user_anggota' => ['required', 'min:3', 'max:255', 'unique:user'],
            'no_induk' => 'required|min:3|max:12',
            'jenis_kelamin' => ['required','in:Pria,Wanita'],
            'no_telp' => ['required', 'max:15'],
            'alamat' => ['required','max:255'],
            'email' => ['required', 'email:dns', 'unique:user'],
            'password' => ['required', 'min:5', 'max:255']
        ]);
        $this->frog->create($request->all());
        return $this->index();
    }

    public function update (Request $request, $id){
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
