<?php

namespace App\Http\Controllers\Admin\NguoiDung;

use App\Http\Controllers\Controller;
use App\Models\Quyen;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class NguoiDungController extends Controller
{
    public function __construct()
    {
    }
    public function config()
    {




        return $config = [
            'js' => [
                'js/plugins/dataTables/datatables.min.js',
                'js/plugins/pace/pace.min.js',
                'js/plugins/footable/footable.all.min.js',
            ],
            'linkjs' => [],
            'css' => [
                'css/plugins/dataTables/datatables.min.css',
                'css/plugins/footable/footable.core.css',

            ],
            'linkcss' => [],

            'script' => [
                '
                $(document).ready(function(){
                    $(\'.dataTables-example\').DataTable({
                        pageLength: 10,
                        searching: true, 
                        ordering: true, 
                        responsive: true,
                        info: false,  
                        paging: true,
                        lengthChange: false,
                        dom: \'<"html5buttons"B>lTfgitp\',
                        buttons: [
                           
                            {extend: \'print\',
                             customize: function (win){
                                    $(win.document.body).addClass(\'white-bg\');
                                    $(win.document.body).css(\'font-size\', \'10px\');
        
                                    $(win.document.body).find(\'table\')
                                            .addClass(\'compact\')
                                            .css(\'font-size\', \'inherit\');
                            }
                            }
                        ]
        
                    });
        
                });
                ',
            ]


        ];
    }
    public function configCreateView()
    {

        return $config = [
            'js' => [

                'js/plugins/pace/pace.min.js',
                'js/plugins/datapicker/bootstrap-datepicker.js',
                'js/plugins/chosen/chosen.jquery.js',
                'js/plugins/jasny/jasny-bootstrap.min.js'
            ],
            'linkjs' => [
                'https://cdn.tailwindcss.com'
            ],
            'css' => [

                'css/plugins/datapicker/datepicker3.css',
                'css/plugins/chosen/bootstrap-chosen.css',
                'css/plugins/jasny/jasny-bootstrap.min.css',
                'css/profile.css'
            ],
            'linkcss' => [],

            'script' => [
                ' $(document).ready(function(){
                    $(\'#data_1 .input-group.date\').datepicker({
                        todayBtn: "linked",
                        keyboardNavigation: false,
                        forceParse: false,
                        calendarWeeks: true,
                        autoclose: true
                    });
                    $(\'.chosen-select\').chosen({ width: "100%" });
                    })
                 ',
                '
                 tailwind.config = {
                     prefix: \'tw-\',
                     corePlugins: {
                         preflight: false, // Set preflight to false to disable default styles
                     },
                 }',

            ]


        ];
    }
    public function configDetail()
    {
        return $config = [
            'js' => [
                'js/inspinia.js',

            ],
            'linkjs' => [
                'https://cdn.tailwindcss.com'
            ],
            'css' => [],
            'linkcss' => [],

            'script' => [
                '
                tailwind.config = {
                    prefix: \'tw-\',
                    corePlugins: {
                        preflight: false, // Set preflight to false to disable default styles
                    },
                }',
            ]
        ];
    }
    public function index()
    {

        if (Auth::check()) {
            if (!Session::has('NguoiDung')) {
                $authId = Auth::id();
                $nguoidung = User::find($authId);
                Session::put('NguoiDung', $nguoidung);
            }
            $nguoidung = Session::get('NguoiDung');
            $title = 'Danh sách người dùng';
            $NguoiDungs = User::all();
            $data = ['NguoiDungs' => $NguoiDungs];
            $config = $this->config();
            $template = 'NguoiDung.index';
            return view('layout', compact(
                'template',
                'title',
                'nguoidung',
                'config',
                'data',

            ));
        } else {
            return redirect()->route('auth.admin')->with('error', 'Please log in first');
        }
    }
    public function createView()
    {
        if (Auth::check()) {
            if (!Session::has('NguoiDung')) {
                $authId = Auth::id();
                $nguoidung = User::find($authId);
                Session::put('NguoiDung', $nguoidung);
            }
            $nguoidung = Session::get('NguoiDung');
            $title = 'Thêm người dùng người dùng';
            $config = $this->configCreateView();
            $Quyens = Quyen::all();
            $template = 'NguoiDung.create';
            return view('layout', compact(
                'template',
                'title',
                'nguoidung',
                'config',
                'Quyens'
            ));
        } else {
            return redirect()->route('auth.admin')->with('error', 'Please log in first');
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'TenDangNhap' => 'required|String|unique:NguoiDung',
            'MatKhau' => 'required|string',
            'Email' => 'required|email',
            'MaQuyen' => 'required',
        ]);
        $nguoidung = new User();
        $nguoidung->HoTen = $request->HoTen;
        $nguoidung->TenDangNhap = $request->TenDangNhap;
        $nguoidung->MatKhau = $request->MatKhau;
        $dateTime = DateTime::createFromFormat('d/m/Y', $request->NgaySinh);
        $date = $dateTime->format('Y-m-d');
        $nguoidung->NgaySinh = $date;
        $nguoidung->Email = $request->Email;
        $nguoidung->GioiTinh = $request->GioiTinh;
        $nguoidung->NgayDangKy = now();
        $nguoidung->MaQuyen = $request->MaQuyen;
        $result = $nguoidung->save();
        if ($result) {
            return redirect()->route('user.index')->with('success', 'thêm người dùng thành công.');
        } else {
            return redirect()->back()->with('error', 'Failed to create employee.');
        }
    }
    
    public function resetpassword($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.index')->with('error', 'User not found!');
        }
        $user->MatKhau = '123456';
        $result = $user->save();
        if ($result) {
            return redirect()->route('user.index')->with('success', 'Reset mật khẩu thành công!');
        } else {
            return redirect()->back()->with('error', 'Reset mật khẩu thất bại! Hãy thử lại.');
        }
    }
}
