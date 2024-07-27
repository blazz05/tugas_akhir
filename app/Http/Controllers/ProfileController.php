<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Flash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile_edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:100',
            'password' => 'nullable|min:8',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);

        // Simpan data sebelum perubahan
        $oldAttributes = $user->getAttributes();

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('profile_image')) {
            $imageName = time().'.'.$request->profile_image->extension();
            $request->profile_image->storeAs('public/profile_images', $imageName);

            // Hapus gambar lama jika ada
            if ($user->profile_image) {
                Storage::delete('public/profile_images/'.$user->profile_image);
            }

            // Perbarui gambar profil pengguna
            $data['profile_image'] = $imageName;
        }

        // Perbarui informasi pengguna
        $user->fill($data);
        $user->save();

        // Simpan data setelah perubahan
        $newAttributes = $user->fresh()->getAttributes();

        // Catat aktivitas perubahan profil
        activity()
            ->causedBy(Auth::user()) // Pengguna yang melakukan perubahan
            ->withProperties([
                'old' => $oldAttributes,
                'attributes' => $newAttributes,
            ])
            ->log("User '{$oldAttributes['name']}' updated their profile");

        flash('Your profile has been updated')->success();
        return redirect()->back();
    }
}
