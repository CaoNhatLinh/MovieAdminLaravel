<?php

namespace App\Http\Controllers\admin\TapPhim;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Phim_TheLoai;
use App\Models\TapPhim;
use App\Models\TheLoai;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TapPhimController extends Controller
{
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

    public function createView($id)
    {
        if (Auth::check()) {
            if (!Session::has('NguoiDung')) {
                $authId = Auth::id();
                $nguoidung = User::find($authId);
                Session::put('NguoiDung', $nguoidung);
            }
            $nguoidung = Session::get('NguoiDung');
            $title = 'Thêm tập Phim';
            $config = $this->configCreateView();
            $template = 'movie.TapPhim.create';
            $maphim = $id;
            return view('layout', compact(
                'template',
                'title',
                'nguoidung',
                'config',
                'maphim'
            ));
        } else {
            return redirect()->route('auth.admin')->with('error', 'vui lòng đăng nhập');
        }
    }
    public function create(Request $request, $id)
    {

        $request->validate([
            'TenTap' => 'required',
            'LienKetPhim' => 'required',
        ]);

        $soluongtap = TapPhim::where('MaPhim', $id)->count();
        $phim = Movie::find($id);
        $tongtap = $phim->SoTap;
        if($soluongtap==$tongtap)
        {
            return redirect()->route('movie.detailView', $id)->with('erro', 'Không thể thêm quá số lượng tập phim');
        }
        if ($request->MoTa == null)
            $mota = "Không có mô tả";
        else  $mota =  $request->Mota;
        $tapphim = new TapPhim();
        $tapphim->TenTap = $request->TenTap;

        if ($mota) {
            $tapphim->MoTa = $mota;
        } else {
            $tapphim->MoTa = 'Không có mô tả';
        }
        $tapphim->LienKetPhim = $request->LienKetPhim;
        $tapphim->MaPhim = $id;

        $result = $tapphim->save();
        $this->updateSoTap($tapphim->MaPhim);

        if ($result) {
            return redirect()->route('movie.detailView', $id)->with('success', 'Thêm tập mới thành công.');
        } else {
            return redirect()->back()->with('error', 'Thêm tập mới thất bại.');
        }
    }
    public function edit(Request $request, $id)
    {
        $request->validate([
            'TenTap' => 'required',
            'LienKetPhim' => 'required',
        ]);

        $tapphim = TapPhim::find($request->MaTapPhim);
        $tapphim->TenTap = $request->TenTap;
        $tapphim->MoTa = $request->MoTa;
        $tapphim->LienKetPhim = $request->LienKetPhim;
        $result = $tapphim->save();

        if ($result) {
            return redirect()->route('movie.detailView', $id)->with('success', 'edit phim thành công.');
        } else {
            return redirect()->back()->with('error', 'edit phim thất bại.');
        }
    }
   
    public function delete($maTapPhim)
    {
        $tapphim = TapPhim::find($maTapPhim);
        $maphim = $tapphim->MaPhim;
        if (!$tapphim) {
            return redirect()->route('movie.detailView', $maphim)->with('error', 'Không tìm thấy tập phim!');
        }
        TapPhim::where('MaTapPhim', $maTapPhim)->where('MaPhim', $maphim)->delete();
        $this->updateSoTap($maphim);
        return redirect()->route('movie.detailView', $maphim)->with('success', 'Tập phim đã được xóa thành công.');
    }
    protected function updateSoTap($MaPhim)
    {   
        $TinhTrang = TapPhim::where('MaPhim', $MaPhim)->count();
        Movie::where('MaPhim', $MaPhim)->update(['TinhTrang' => $TinhTrang]);
    }
}
