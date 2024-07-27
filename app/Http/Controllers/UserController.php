<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        {        
             //dapatkan seluruh data user dengan query builder
            $ar_users = DB::table('users')->get();
            //arahkan ke halaman baru dengan menyertakan data user(compact)
            //di resources/views/user/index.blade.php
            return view('users.index',compact('ar_users'));
        }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
        {
            // Mengarahkan ke halaman form input
            return view('users.form');
        } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            // Validasi data form
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8',
                'role' => 'required|in:anggota,admin', // Ensure role is either 'admin' or 'anggota'
            ], [
                'name.required' => 'Nama Wajib di Isi',
                'email.required' => 'Email Wajib di Isi',
                'password.required' => 'Password Wajib di Isi',
                'password.min' => 'Password Minimal 8 Karakter',
                'role.required' => 'Role Wajib di Isi',
                'role.in' => 'Role harus Admin atau Anggota',
            ]);

            // Proses input data ke database menggunakan model User
            $users = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'role' => $validatedData['role'],
            ]);

            // Log aktivitas tambah data users
            activity()
                ->causedBy(auth()->user())
                ->performedOn($users)
                ->event('created')
                ->withProperties(['before' => null, 'after' => $users->fresh()->toArray()])
                ->log('users ' . $users->name . ' ditambahkan dengan role ' . $users->role);

            // Landing page setelah berhasil menyimpan data
            return redirect('/users');
        }


    /**
     * Display the specified resource.
     */
    public function show($id)
        {
              // menampilkan detail users
              $ar_users = DB::table('users')
              ->where('users.id', '=',$id)->get();
              // Menampilkan detail users menggunakan model users
              $users = User::findOrFail($id);
  
              return view('users.show',compact('ar_users'));
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
        {
            //mengarahkan ke halaman form edit users
            $data = DB::table('users')
            ->where('id','=',$id)->get();
            return view('users.form_edit',compact('data'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
        {
            // Ambil data user sebelum diubah
            $users = User::findOrFail($id);
            $oldData = $users->getAttributes(); // Data sebelum diubah


            // Validate incoming request
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8',
                'role' => 'required|in:anggota,admin', // Ensure role is either 'admin' or 'anggota'
            ]);


             // Update the user
            $users->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']), // Assuming you store password hashed
                'role' => $validatedData['role'],
            ]);
            // Ambil data setelah diubah
            $newData = $users->fresh()->toArray(); // Data setelah diubah
            
            // Log aktivitas update data users
            activity()
                ->causedBy(auth()->user())
                ->performedOn($users)
                ->event('updated')
                ->withProperties(
                    [
                        'old' => $oldData,
                        'attributes' => $newData
                    ]
                )
                ->log('Users ' . $users->name . ' Di Updated');
            
            //landing page
            return redirect('/users'.'/'.$id);
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
        {
            // Menghapus data users menggunakan model users
            $users = User::findOrFail($id);
            //menghapus data users
            DB::table('users')->where('id',$id)->delete();
            
            // Log aktivitas hapus data users
            activity()
            ->causedBy(auth()->user())
            ->event('deleted')
            ->log('Users ' . $users->name . ' dihapus');
            
            return redirect('/users');
        }
}
