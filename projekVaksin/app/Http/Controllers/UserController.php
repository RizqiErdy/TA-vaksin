<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->UserModel = new User();
    }

    public function index()
    {
        $data = [
            'title' => 'Users',
            'user'=>$this->UserModel->AllData(),
        ];
        return view('admin.user.index',$data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User',
        ];
        return view('admin.user.create',$data);
    }

    public function store()
    {
        Request()->validate(
            [
                'name' => 'required',
                'email' => 'required | email | unique:users',
                'password' => 'required | min:8',
            ],
            [
                'name.required' => 'Wajib diisi !!!',
                'email.required' => 'Wajib diisi !!!',
                'email.unique' => 'Email Sudah Terdaftar !!!',
                'password.required' => 'Wajib diisi !!!',
                'password.min' => 'Password minimal 8 Karakter',
            ]
        );

        $user = [
            'name' => Request()->name,
            'email'=> Request()->email,
            'password' => Hash::make(Request()->password),
        ];

        $this->UserModel->addData($user);
        return redirect()->route('User')->with('pesan', 'Data berhasil ditambahkan');
    }

    public function update($id)
    {
        Request()->validate(
            [
                'name' => 'required',
                'email' => 'required | email',
            ],
            [
                'name.required' => 'Wajib diisi !!!',
                'email.required' => 'Wajib diisi !!!',
            ]
        );

        $user = [
            'name' => Request()->name,
            'email'=> Request()->email,
        ];

        $this->UserModel->UpdateUser($id, $user);
        return redirect()->route('User')->with('pesan', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $this->UserModel->DeleteUser($id);
        return redirect()->route('User')->with('pesan', 'Data berhasil dihapus');
    }
}
