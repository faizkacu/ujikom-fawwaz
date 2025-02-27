<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        return view('profile.index', compact('profile'));
    }

    public function update(Request $request, Profile $profile)
    {
        $profile->update($request->all());

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
