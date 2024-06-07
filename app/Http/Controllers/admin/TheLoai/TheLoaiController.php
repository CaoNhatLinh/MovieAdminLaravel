<?php

namespace App\Http\Controllers\Admin\TheLoai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Phim_TheLoai;
use App\Models\TapPhim;

use App\Models\TheLoai;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TheLoaiController extends Controller
{
    public function __construct()
    {
    }
    public function config()
    {

        return $config = [
            'js' => [

                'js/plugins/pace/pace.min.js',
                'js/plugins/footable/footable.all.min.js'

            ],
            'linkjs' => [],
            'css' => [
                'css/plugins/footable/footable.core.css'
            ],
            'linkcss' => [],

            'script' => [
                '$(document).ready(function() {

                    $(\'.footable\').footable();
        
                });',
                'document.addEventListener("DOMContentLoaded", function() {
                  
                    $(\'#myModal\').on(\'show.bs.modal\', function(event) {
                       
                        var button = $(event.relatedTarget);
                        var matheloai = button.data(\'id\');
                        var tentheloai = button.data(\'name\');
                        
                        var modal = $(this);
                        modal.find(\'.modal-body input[name="MaTheLoai"]\').val(matheloai);
                        modal.find(\'.modal-body input[name="TenTheLoai"]\').val(tentheloai);
                    });
                });'
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
            ],
            'linkjs' => [],
            'css' => [

                'css/plugins/datapicker/datepicker3.css',
                'css/plugins/chosen/bootstrap-chosen.css'
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
            
            })',
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
            $config = $this->config();
            $title = 'Danh sách thể loại';
            $template = 'theloai.index';
            $theloais = TheLoai::all();
            $data = ['theloais' => $theloais];
            return view('layout', compact(
                'template',
                'title',
                'nguoidung',
                'config',
                'data',
            ));
        } else {
            return redirect()->route('auth.admin')->with('error', 'vui lòng đăng nhập');
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'TenTheLoai' => 'required|unique:TheLoai',

        ]);
        $theloai = new TheLoai();
        $theloai->TenTheLoai = $request->TenTheLoai;
        $result = $theloai->save();

        if ($result) {
            return redirect()->route('theloai.index')->with('success', 'Tạo thể loại thành công.');
        } else {
            return redirect()->back()->with('error', 'Tạo thất bại');
        }
    }


    public function edit(Request $request)
    {
        $request->validate([
            'TenTheLoai' => 'required|unique:TheLoai'
        ]);
        $theloai = TheLoai::find($request->MaTheLoai);
        $theloai->TenTheLoai = $request->TenTheLoai;
        $result = $theloai->save();
        if ($result) {
            return redirect()->route('theloai.index')->with('success', 'Sửa thể loại thành công');
        } else {
            return redirect()->back()->with('error', 'sửa thể loại thất bại.');
        }
    }
    public function delete($id)
    {
        $theloai = TheLoai::find($id);

        if (!$theloai) {
            return redirect()->route('theloai.index')->with('error', 'Lỗi! Thử lại');
        }

        $theloai->delete();

        return redirect()->route('theloai.index')->with('success', 'Xoá thể loại thành công!');
    }
}
