<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'password' => 'required|string',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        // Ambil data pengguna berdasarkan nama yang diinput
        $user = \App\Models\User::where('name', $this->input('name'))->first();

        // Jika pengguna ditemukan, periksa statusnya
        if ($user) {
            if ($user->status !== 'AKTIF') {
                throw ValidationException::withMessages([
                    'name' => __('Akun anda belum aktif'),
                ]);
            }

            // Jika status pengguna aktif, lakukan pengecekan autentikasi password
            if (!Auth::attempt($this->only('name', 'password'), $this->filled('remember'))) {
                RateLimiter::hit($this->throttleKey());

                throw ValidationException::withMessages([
                    'name' => __('Username atau password anda salah'),
                ]);
            }
        } else {
            // Jika pengguna tidak ditemukan, berikan pesan bahwa username atau password salah
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'name' => __('Username atau password anda salah'),
            ]);
        }

        // Bersihkan batas percobaan login jika autentikasi berhasil
        RateLimiter::clear($this->throttleKey());
    }




    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'name' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('name')) . '|' . $this->ip();
    }
}