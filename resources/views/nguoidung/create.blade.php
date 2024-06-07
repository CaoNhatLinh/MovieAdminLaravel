<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Thêm người dùng </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>

                </div>
            </div>
            <div class="ibox-content">
                <form method="POST" action="{{ route('user.create') }}" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Họ tên</label>
                        <div class="col-sm-10"><input type="text" name="HoTen" id="HoTen" placeholder="Họ tên" class="form-control" required>
                            @if ($errors->has('HoTen'))
                            <span class="help-block m-b-none label label-warning">{{ $errors->first('HoTen') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Username</label>

                        <div class="col-sm-10"><input type="text" name="TenDangNhap" id="person_id" placeholder="Username" class="form-control" required></div>
                        @if ($errors->has('TenDangNhap'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('TenDangNhap') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10"><input type="password" name="MatKhau" id="MatKhau" placeholder="password" class="form-control" required>
                            @if ($errors->has('password'))
                            <span class="help-block m-b-none label label-warning">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10"><input type="email" name="Email" id="Email" placeholder="Email" class="form-control" required></div>
                        @if ($errors->has('Email'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('Email') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Giới tính</label>

                        <div class="col-sm-10">
                            <select class="form-control m-b" name="GioiTinh" required data-placeholder="chọn giới tính">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                            @if ($errors->has('GioiTinh'))
                            <span class="help-block m-b-none label label-warning">{{ $errors->first('GioiTinh') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                    <div class="form-group" id="data_1">
                        <label class="col-sm-2 control-label">Ngày sinh</label>
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" name="NgaySinh" id="NgaySinh" required value="01/01/2000">
                            </div>
                        </div>
                        @if ($errors->has('NgaySinh'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('NgaySinh') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Quyền</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="MaQuyen" data-placeholder="Chọn quyền người dùng">
                                @foreach($Quyens as $Quyen)
                                <option value="{{ $Quyen->MaQuyen }}">{{ $Quyen->TenQuyen }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('MaQuyen'))
                            <span class="help-block m-b-none label label-warning">{{ $errors->first('MaQuyen') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary dim btn-sm " type="submit">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>