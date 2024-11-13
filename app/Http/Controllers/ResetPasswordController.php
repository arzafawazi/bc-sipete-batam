<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class ResetPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('auth.resetpw'); // Pastikan Anda memiliki view untuk ini
    }

    public function updatePassword(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:1',  // Validasi password minimal 8 karakter
        ]);

        if ($validator->fails()) {
            return redirect()->route('password.reset')
                ->withErrors($validator)
                ->withInput();
        }

        // Ambil user berdasarkan user_id dari request
        $user = User::find($request->input('user_id'));

        if (!$user) {
            return redirect()->route('password.reset')->withErrors(['error' => 'User tidak ditemukan.']);
        }

        // Update password user
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect ke halaman login setelah berhasil mengubah password
        return redirect()->route('password.reset')->with('success', 'Password berhasil direset!');
    }
}
