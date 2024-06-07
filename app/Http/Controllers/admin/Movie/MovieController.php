<?php

namespace App\Http\Controllers\admin\Movie;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Phim_TheLoai;
use App\Models\QuocGia;
use App\Models\TapPhim;
use App\Models\TheLoai;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MovieController extends Controller
{
    public function config()
    {
        return $config = [
            'js' => [
                'js/plugins/dataTables/datatables.min.js',
                'js/plugins/pace/pace.min.js',
                'js/plugins/footable/footable.all.min.js',
                'js/plugins/metisMenu/jquery.metisMenu.js',
                'js/plugins/slimscroll/jquery.slimscroll.min.js',
            ],
            'linkjs' => [],
            'css' => [
                'css/plugins/dataTables/datatables.min.css',
                'css/plugins/footable/footable.core.css',
                'css/phim.css',

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
                        ],
                        columnDefs: [{
                            orderable: false,
                            targets: -1,-1
                        }]
        
                    });
        
                });
                ',
                ' $(document).ready(function() {

                    $(\'.footable\').footable({paginate: false});
        
                });'
                ,
                'document.addEventListener("DOMContentLoaded", function() {
                  
                    $(\'#myModal\').on(\'show.bs.modal\', function(event) {
                       
                        var button = $(event.relatedTarget);
                        var matapphim = button.data(\'matapphim\');
                        var tentap = button.data(\'tentap\');
                        var mota = button.data(\'mota\');
                        var lienketphim = button.data(\'lienketphim\');
                        
                        var modal = $(this);
                        modal.find(\'.modal-body input[name="MaTapPhim"]\').val(matapphim);
                        modal.find(\'.modal-body input[name="MoTa"]\').val(mota);
                        modal.find(\'.modal-body input[name="LienKetPhim"]\').val(lienketphim);
                        modal.find(\'.modal-body input[name="TenTap"]\').val(tentap);
                    });
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
    public function index()
    {

        if (Auth::check()) {
            if (!Session::has('NguoiDung')) {
                $authId = Auth::id();
                $nguoidung = User::find($authId);
                Session::put('NguoiDung', $nguoidung);
            }
            $nguoidung = Session::get('NguoiDung');
            $title = 'Movie list';
            $movies = Movie::with('theloais')->orderBy('NgayThem', 'desc')->get();
            $data = ['movies' => $movies];
            $config = $this->config();
            $template = 'movie.index';
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
    public function createView()
    {
        if (Auth::check()) {
            if (!Session::has('NguoiDung')) {
                $authId = Auth::id();
                $nguoidung = User::find($authId);
                Session::put('NguoiDung', $nguoidung);
            }
            $nguoidung = Session::get('NguoiDung');
            $title = 'Thêm Phim';
            $config = $this->configCreateView();
            $template = 'movie.create';
            $theloais = TheLoai::all();
            $partitioned = $theloais->partition(function ($theloai) {
                return in_array($theloai->MaTheLoai, [1, 2]);
            });
            $filteredTheloais = $partitioned[0];
            $remainingTheloais = $partitioned[1];
            return view('layout', compact(
                'template',
                'title',
                'nguoidung',
                'config',
                'filteredTheloais',
                'remainingTheloais',
            ));
        } else {
            return redirect()->route('auth.admin')->with('error', 'vui lòng đăng nhập');
        }
    }

    public function create(Request $request)
    {
        
        $request->validate([
            'TieuDe' => 'required',
            'AnhBia' => 'required|string',
            'NgonNgu' => 'required|string',
            'DaoDien' => 'required|string',
            'DienVien' => 'required|string',
            'AnhBia' => 'required|string',
            'NamPhatHanh' => 'required|integer',
        ]);
        $allowed_extensions = ['jpg', 'png', 'jpeg'];
        $file_extension1 = pathinfo($request->AnhBia, PATHINFO_EXTENSION);
        $file_extension1 = strtolower($file_extension1);
        if (isset($request->Banner)) {
            $file_extension2 = pathinfo($request->Banner, PATHINFO_EXTENSION);
            $file_extension2 = strtolower($file_extension2);
            if (!in_array($file_extension2, $allowed_extensions)) {
                $errors = $request->validate([
                    'Banner' => 'Phần mở rộng của ảnh không hợp lệ. Chỉ chấp nhận jpg, png, jpeg.'
                ]);
                $request->merge(['errors' => $errors]);
            }
        }
        if (!in_array($file_extension1, $allowed_extensions)) {
            $errors = $request->validate([
                'AnhBia' => 'Phần mở rộng của ảnh không hợp lệ. Chỉ chấp nhận jpg, png, jpeg.'
            ]);
            $request->merge(['errors' => $errors]);
        }

        


        $phim = new Movie();
        $phim->TieuDe = $request->TieuDe;
        $phim->MoTa = $request->MoTa;
        $phim->NamPhatHanh = $request->NamPhatHanh;
        $phim->NgonNgu = $request->NgonNgu;
        $phim->DaoDien = $request->DaoDien;
        $phim->ThoiLuong = $request->ThoiLuong;
        $phim->ChatLuong = $request->ChatLuong;
        $phim->TinhTrang = 0;
        $phim->AnhBia = $request->AnhBia;
        $phim->NgayThem = now()->format('Y-m-d');
        $phim->SoTap = $request->SoTap;
        $phim->TieuDeQuocTe = $request->TieuDeQuocTe;
        $phim->DienVien = $request->DienVien;
        if (isset($request->Banner))
        {$phim->Banner = $request->Banner;}
        

        $result = $phim->save();
        if ($result) {
            $theloai_ids = $request->input('TheLoai');
            foreach ($theloai_ids as $theloai_id) {
                $Phim_TheLoai = new Phim_TheLoai();
                $Phim_TheLoai->MaPhim = $phim->MaPhim;
                $Phim_TheLoai->MaTheLoai = $theloai_id;
                $Phim_TheLoai->save();
            }
        }

        if ($result) {
            return redirect()->route('movie.index')->with('success', 'movie created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create movie.');
        }
    }
    
    public function detailView($id)
    {
        if (Auth::check()) {
            if (!Session::has('NguoiDung')) {
                $authId = Auth::id();
                $nguoidung = User::find($authId);
                Session::put('NguoiDung', $nguoidung);
            }
            $nguoidung = Session::get('NguoiDung');
            $title = 'Danh sách tập phim';
            $tapphims = TapPhim::where('MaPhim', $id)->get();
            $name_phim = Movie::find($id)->TieuDe;
            $maphim = $id;
            $data = ['tapphims' => $tapphims];
            $config = $this->config();
            $template = 'movie.TapPhim.index';
            return view('layout', compact(
                'template',
                'title',
                'nguoidung',
                'config',
                'data',
                'name_phim',
                'maphim',
            ));
        } else {
            return redirect()->route('auth.admin')->with('error', 'vui lòng đăng nhập');
        }
    }
    public function editView($id)
    {
        if (Auth::check()) {
            if (!Session::has('NguoiDung')) {
                $authId = Auth::id();
                $nguoidung = User::find($authId);
                Session::put('NguoiDung', $nguoidung);
            }
            $nguoidung = Session::get('NguoiDung');
            $title = 'Thêm Phim';
            $config = $this->configCreateView();
            $template = 'movie.edit';
            $theloais = TheLoai::all();
            $partitioned = $theloais->partition(function ($theloai) {
                return in_array($theloai->MaTheLoai, [1, 2]);
            });
            $filteredTheloais = $partitioned[0];
            $remainingTheloais = $partitioned[1];
            $movie = Movie::with('phimTheLoai')->find($id);
            return view('layout', compact(
                'template',
                'title',
                'nguoidung',
                'config',
                'filteredTheloais',
                'remainingTheloais',
                'movie'
            ));
        } else {
            return redirect()->route('auth.admin')->with('error', 'vui lòng đăng nhập');
        }
    }

    public function edit(Request $request, $id)
    {
        $allowed_extensions = ['jpg', 'png', 'jpeg'];
        $file_extension1 = pathinfo($request->AnhBia, PATHINFO_EXTENSION);
        $file_extension1 = strtolower($file_extension1);
        $file_extension2 = pathinfo($request->Banner, PATHINFO_EXTENSION);
        $file_extension2 = strtolower($file_extension2);
        $request->validate([
            'TieuDe' => 'required',
            'AnhBia' => 'required|string',
            'NgonNgu' => 'required|string',
            'DaoDien' => 'required|string',
            'DienVien' => 'required|string',
            'Banner' => 'required|string',
            'AnhBia' => 'required|string',
            'NamPhatHanh' => 'required|integer',
        ]);

        if (!in_array($file_extension1, $allowed_extensions)) {
            $errors = $request->validate([
                'AnhBia' => 'Phần mở rộng của ảnh không hợp lệ. Chỉ chấp nhận jpg, png, jpeg.'
            ]);
            $request->merge(['errors' => $errors]);
        }

        if (!in_array($file_extension2, $allowed_extensions)) {
            $errors = $request->validate([
                'Banner' => 'Phần mở rộng của ảnh không hợp lệ. Chỉ chấp nhận jpg, png, jpeg.'
            ]);
            $request->merge(['errors' => $errors]);
        }

        $phim = Movie::find($id);
        $phim->TieuDe = $request->TieuDe;
        $phim->MoTa = $request->MoTa;
        $phim->NamPhatHanh = $request->NamPhatHanh;
        $phim->NgonNgu = $request->NgonNgu;
        $phim->DaoDien = $request->DaoDien;
        $phim->ThoiLuong = $request->ThoiLuong;
        $phim->ChatLuong = $request->ChatLuong;
        $phim->TinhTrang = $request->TinhTrang;
        $phim->AnhBia = $request->AnhBia;
        $phim->NgayThem = now()->format('Y-m-d');
        $phim->SoTap = $request->SoTap;
        $phim->TieuDeQuocTe = $request->TieuDeQuocTe;
        $phim->DienVien = $request->DienVien;
        $phim->Banner = $request->Banner;

        $result = $phim->save();
        if ($result) {
            $theloai_ids = $request->input('TheLoai');
            Phim_TheLoai::where('MaPhim', $phim->MaPhim)->delete();
            foreach ($theloai_ids as $theloai_id) {
                $Phim_TheLoai = new Phim_TheLoai();
                $Phim_TheLoai->MaPhim = $phim->MaPhim;
                $Phim_TheLoai->MaTheLoai = $theloai_id;
                $Phim_TheLoai->save();
            }
        }

        if ($result) {
            return redirect()->route('movie.index')->with('success', 'movie created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create movie.');
        }
    }

    public function delete($id)
    {
        $phim = Movie::find($id);
        $tapphims = TapPhim::where('MaPhim', $id)->get();

        if(count($tapphims)>0)
        {
            TapPhim::where('MaPhim', $id)->delete();
        }
        $phim->delete();
        if (!$phim) {
            return redirect()->route('movie.index')->with('error', 'Không tìm thấy phim!');
        }
        return redirect()->route('movie.index')->with('success', 'Phim đã được xóa thành công.');
    }
}
