<?php

namespace App\Http\Controllers\tools;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TblMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\TblAksesMenu;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Observers\GenericObserver;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('tools.users', compact('users'));
    }

    public function create()
    {
        $menus = TblMenu::getMenus();
        return view('tools.create', compact('menus'));
    }

    public function edit($id_admin = null)
    {
        // Ambil menu yang sesuai dengan akses pengguna
        $menuItems = TblAksesMenu::getMenus();

        // Cek apakah id_admin diberikan
        if ($id_admin) {
            // Cari akses menu berdasarkan id_admin
            $aksesMenu = TblAksesMenu::where('id_admin', $id_admin)->get();

            // dd($aksesMenu);
            // dd($aksesMenu->toArray());

            if ($aksesMenu->isNotEmpty()) {
                // Buat array untuk menyimpan status akses
                $accessStatus = [];

                // Loop melalui akses menu untuk mengisi $accessStatus
                foreach ($aksesMenu as $menu) {
                    $accessStatus[$menu['kode_menu']] = $menu['opsi']; // Pastikan menggunakan 'kode_menu'
                }

                // dd($accessStatus); // Pastikan ini menunjukkan array dengan kunci dan nilai yang benar

                // Ambil pengguna berdasarkan id_admin
                $user = User::where('id_admin', $id_admin)->first();
                if ($user) {
                    return view('tools.edit_user', compact('user', 'menuItems', 'accessStatus'));
                }
                return redirect()->route('users.index')->with('error', 'User not found');
            }

            return redirect()->route('users.index')->with('error', 'Access menu not found for the given ID Admin');
        }

        return redirect()->route('users.index')->with('error', 'ID Admin is required'); // Pesan jika id_admin tidak ada
    }

    // public function edit($id_admin)
    // {
    //     // Ambil detail pengguna berdasarkan ID
    //     $user = User::where('id_admin', $id_admin)->firstOrFail();

    //     // Ambil menu yang sesuai dengan akses pengguna
    //     $menuItems = TblMenu::getMenus();

    //     // Ambil akses menu yang sudah ada
    //     $aksesMenu = TblAksesMenu::where('id_admin', $id_admin)->get()->pluck('kode_menu', 'opsi')->toArray();

    //     return view('tools.edit_user', compact('user', 'menuItems', 'aksesMenu'));
    // }

    // public function edit($id)
    // {
    //     $user = User::findOrFail($id);

    //     $menuItems = TblMenu::getMenus();

    //     return view('tools.edit_user', compact('menuItems'));
    // }

    public function update(Request $request, $id_admin)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'pangkat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'otoritas' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'akses' => 'sometimes|array',
        ]);

        DB::beginTransaction(); // Mulai transaksi
        try {
            // Temukan user
            $user = User::where('id_admin', $id_admin)->firstOrFail();

            // Update user data
            $user->update(array_merge($validated, ['password' => $request->filled('password') ? Hash::make($request->password) : $user->password]));

            // Jika ada akses baru, hapus akses lama dan simpan yang baru
            if ($request->has('akses')) {
                TblAksesMenu::where('id_admin', $id_admin)->delete();

                foreach ($request->akses as $kodeMenu => $opsi) {
                    TblAksesMenu::create([
                        'id_admin' => $user->id_admin,
                        'username' => $user->name,
                        'kode_menu' => $kodeMenu,
                        'opsi' => $opsi,
                        'tgl_insert' => now()->toDateString(),
                        'wkt_insert' => now()->toTimeString(),
                    ]);
                }
            }

            DB::commit(); // Komit transaksi jika berhasil
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi error
            return redirect()->route('users.index')->with('error', 'Terjadi kesalahan saat memperbarui data pengguna.');
        }

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan pengguna berdasarkan ID atau gagal jika tidak ditemukan
        $user = User::findOrFail($id);

        // Ambil id_admin dari pengguna
        $idAdmin = $user->id_admin;

        // Hapus semua akses yang terkait dengan id_admin ini di TblAksesMenu
        TblAksesMenu::where('id_admin', $idAdmin)->delete();

        // Hapus pengguna
        $user->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User and related access permissions deleted successfully!');
    }

    public function toggleStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => true]);
    }

    public function resetPassword(Request $request, $userId)
    {
        // Validasi input password
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed', // Minimal 8 karakter dan harus dikonfirmasi
        ]);

        $user = User::find($userId);

        if ($user) {
            // Menggunakan Hash::make untuk mengenkripsi password
            $user->password = Hash::make($validated['password']);

            // Simpan perubahan ke dalam database
            $user->save();

            return redirect()->back()->with('success', 'Password berhasil direset.');
        }

        return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
    }

    // public function editUser($id)
    // {
    //     $user = User::find($id);
    //     $menus = TblMenu::getMenus();

    //     return view('tools.edit_user', compact('user', 'menus'));
    // }

    public function logout(): RedirectResponse
    {
        // Catat aktivitas logout menggunakan GenericObserver
        $user = Auth::user(); // Simpan user sebelum logout
        $observer = new GenericObserver();

        // Pastikan user masih ada sebelum mencatat logout
        if ($user) {
            $observer->logout($user);
        }

        // Lakukan proses logout
        Auth::logout();

        // Invalidasi session dan regenerasi token
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login')->with('message', 'Anda telah berhasil logout.');
    }

    public function store(Request $request)
    {
        try {
            Log::info('Request received', $request->all());

            $validated = $request->validate([
                'nama_admin' => 'required|string|max:255',
                'nip' => 'required|string|max:255',
                'pangkat' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'otoritas' => 'required|string|max:255',
                'name' => 'required|string|max:100|unique:users',
                'password' => 'required|string|min:8',
                'akses' => 'required|array',
            ]);

            $idAdmin = 'BCKNO-' . rand(100, 999);
            $status = 'AKTIF';

            $user = User::create([
                'id_admin' => $idAdmin,
                'name' => $validated['name'],
                'password' => Hash::make($validated['password']),
                'nama_admin' => $validated['nama_admin'],
                'nip' => $validated['nip'],
                'pangkat' => $validated['pangkat'],
                'jabatan' => $validated['jabatan'],
                'otoritas' => $validated['otoritas'],
                'created_at' => now(),
                'updated_at' => now(),
                'status' => $status,
            ]);

            Log::info('User created:', $user->toArray());

            // Simpan akses menu
            foreach ($request->akses as $kodeMenu => $opsi) {
                TblAksesMenu::create([
                    'id_admin' => $user->id_admin,
                    'username' => $user->name,
                    'kode_menu' => $kodeMenu,
                    'opsi' => $opsi,
                    'tgl_insert' => now()->toDateString(),
                    'wkt_insert' => now()->toTimeString(),
                ]);
            }

            return redirect()->route('users.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Error saving user: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data gagal disimpan. Error: ' . $e->getMessage());
        }
    }
}
