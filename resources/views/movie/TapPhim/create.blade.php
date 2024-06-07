<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Thêm tập phim </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form method="POST" action="{{ route('TapPhim.create',$maphim) }}" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="form-group"><label class="col-sm-2 control-label">Tên tập</label>

                        <div class="col-sm-10"><input type="text" name="TenTap" id="TenTap" placeholder="Tên tập" class="form-control" ></div>
                        @if ($errors->has('TenTap'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('TenTap') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Mô tả</label>
                        <div class="col-sm-10"><input type="text" name="MoTa" id="MoTa" placeholder="Mô tả" class="form-control" ></div>
                        @if ($errors->has('MoTa'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('MoTa') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label" required>Đường dẫn phim</label>
                        <div class="col-sm-10"><input type="text" name="LienKetPhim" id="LienKetPhim" placeholder="Đường dẫn phim" class="form-control"></div>
                        @if ($errors->has('LienKetPhim'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('LienKetPhim') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary dim btn-sm " type="submit">Thêm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>