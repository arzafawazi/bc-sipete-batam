<?php

namespace App\Http\Controllers;

use App\Models\TblAksesMenu;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TblMenu;
use Illuminate\Http\Request;

class RoutingController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // public function __construct()
    // {
    //     // $this->
    //     // middleware('auth')->
    //     // except('index');
    // }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index(Request $request)
    // {
    //     if (Auth::user()) {
    //         return redirect('/dashboard');
    //     } else {
    //         return redirect('login');
    //     }
    // }

    // /**
    //  * Display a view based on first route param
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function root(Request $request, $first)
    // {
    //     if ($first === 'dashboard') {

    //         return view('dashboard.index');
    //     }

    //     if ($first === 'home') {

    //         return view('dashboard.index');
    //     }
    //     return view($first);
    // }

    // /**
    //  * second level route
    //  */
    // public function secondLevel($first, $second, $id = null)
    // {
    //     if ($first === 'tools' && $second === 'users') {
    //         $menuItems = TblAksesMenu::getMenus(); // Ambil menu yang sesuai dengan akses pengguna

    //         $menuToEdit = TblMenu::find($id);
    //         if ($id) {
    //             $user = User::find($id);
    //             if ($user) {
    //                 return view('tools.edit_user', compact('user', 'menuItems', 'menuToEdit'));
    //             }
    //             return redirect()->route('users.index')->with('error', 'User not found');
    //         }

    //         $users = User::all();
    //         return view('tools.users', compact('users', 'menuItems'));
    //     }

    //     if ($first === 'Dokpenindakan' && $second === 'DaftarSbp') {

    //         return view('Dokpenindakan.DaftarSbp.index');
    //     }

    //     if ($first === 'Dokpenindakan' && $second === 'rekam') {

    //         return view('Dokpenindakan.DaftarSbp.rekam');
    //     }

    //     return view($first . '.' . $second);
    // }
    // /**
    //  * third level route
    //  */
    // public function thirdLevel(Request $request, $first, $second, $third)
    // {

    //     $menus = TblMenu::getMenus();
    //     if ($first === 'tools' && $second === 'users' && $third === 'create') {
    //         return view('tools.create', compact('menus'));
    //     }

    //     return view($first . '.' . $second . '.' . $third);
    // }
}