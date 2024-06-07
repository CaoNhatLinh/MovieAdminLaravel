<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{$name_phim}}</h5>

                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="form-group">
                    <a class="btn-link font-bold" href="{{ route('TapPhim.createView',$maphim) }}">
                        <button class="btn btn-primary btn-sm dim">
                            Thêm tập phim
                        </button>
                    </a>
                    <input type="text" class="form-control input-sm m-b-xs " id="filter" placeholder="Search in table">
                </div>

                <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                    <thead>
                        <tr>
                            <th>Tên tập</th>
                            <th>Mô tả</th>
                            <th>Link phim</th>
                            <th data-sort-ignore="true">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data['tapphims']!=null)
                        @foreach($data['tapphims'] as $tapphim)
                        <tr class="gradeA">
                            <td>{{ $tapphim->TenTap }}</td>
                            <td>{{ $tapphim->MoTa }}</td>
                            <td>{{ $tapphim->LienKetPhim }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-primary dim btn-sm" data-toggle="modal" data-target="#myModal" data-mota="{{ $tapphim->MoTa }}" data-tentap="{{ $tapphim->TenTap }}" data-matapphim="{{ $tapphim->MaTapPhim }}" data-lienketphim="{{ $tapphim->LienKetPhim }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                     <a href="{{ route('TapPhim.delete', $tapphim->MaTapPhim) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa tập phim này không?');"><button class="btn btn-danger dim btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <ul class="pagination pull-right"></ul>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('TapPhim.edit',$maphim)}}" method="post">
                            @csrf
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <i class="fa fa-laptop modal-icon"></i>
                                    <h4 class="modal-title">Chỉnh sửa tập phim</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Tên tập</label>
                                        <input type="text" placeholder="Tên tập phim" class="form-control" name="TenTap">
                                        @if ($errors->has('TenTap'))
                                        <span class="help-block m-b-none label label-warning" label label-warning>{{ $errors->first('TenTap') }}</span>
                                        @endif
                                        <label>Mô tả</label>
                                        <input type="text" placeholder="Mô tả" class="form-control" name="MoTa">
                                        @if ($errors->has('MoTa'))
                                        <span class="help-block m-b-none label label-warning" label label-warning>{{ $errors->first('MoTa') }}</span>
                                        @endif
                                        <label>Liên kết phim</label>
                                        <input type="text" placeholder="Liên kết phim" class="form-control" name="LienKetPhim">
                                        @if ($errors->has('LienKetPhim'))
                                        <span class="help-block m-b-none label label-warning" label label-warning>{{ $errors->first('LienKetPhim') }}</span>
                                        @endif
                                        <input type="hidden" name="MaTapPhim" value="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>