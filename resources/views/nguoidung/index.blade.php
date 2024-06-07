<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Danh sách người dùng</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>

                    </div>
                </div>
                <div class="ibox-content">
                    <a class="btn-link font-bold" href="{{ route('user.createView') }}">
                        <button class="btn btn-primary btn-sm dim">
                            Thêm người dùng
                        </button>
                    </a>
                    <table class="footable table table-stripped toggle-arrow-tiny dataTables-example" data-page-size="15">
                        <thead>
                            <tr>
                                <th data-toggle="true">id</th>
                                <th>Họ tên</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>MaQuyen</th>
                                <th data-sort-ignore="true">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(count($data['NguoiDungs'])>0)
                            @foreach ($data['NguoiDungs'] as $NguoiDung)
                            <tr>
                                <td>{{ $NguoiDung->MaNguoiDung }}</td>
                                <td>{{ $NguoiDung->HoTen }}</td>
                                <td>{{ $NguoiDung->TenDangNhap }}</td>
                                <td>{{ $NguoiDung->Email}}</td>
                                <td>
                                    {{ $NguoiDung->GioiTinh }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($NguoiDung->NgaySinh)->format('Y-m-d') }}</td>
                                <td>@if($NguoiDung->Quyen)
                                {{ $NguoiDung->Quyen->TenQuyen }}
                                    @else
                                    Không có quyền
                                    @endif
                              
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class=" me-2" href="{{route('user.editView', $NguoiDung->MaNguoiDung)}}">
                                            <button class="btn btn-outline btn-primary dim btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('user.resetpassword', $NguoiDung->MaNguoiDung) }}" onclick="return confirm('reset thành mật khẩu mặc định là: \'123456\'?');" ><button class="btn btn-info dim btn-sm">
                                            reset password
                                        </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <ul class="pagination pull-right"></ul>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>