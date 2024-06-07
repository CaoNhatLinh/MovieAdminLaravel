<?php

namespace App\Http\Controllers\admin\NguoiDung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function __construct()
    {
    }


    public function index()
    {
        if (Auth::id() > 0) {
            return redirect()->route('movie.index')->with('succes', 'Đăng nhập thành công');
        }

        return view('nguoidung.auth.login');
    }

    public function login(Request $request)
{
    $username = $request->input('TenDangNhap');
    $password = $request->input('MatKhau');

    $user = User::where('TenDangNhap', $username)
            ->where('MaQuyen', 'Admin')
            ->first();

    if ($user) {
        Auth::login($user, $request->input('remember'));

        Session::put('NguoiDung', $user);
        return redirect()->route('movie.index');
    } else {
        return redirect()->back()->with('error', 'username hoặc mật khẩu không chính xác');
    }
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Session::forget('NguoiDung');
        return redirect()->route('auth.admin');
    }
}
