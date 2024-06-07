<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Danh sách thể loại</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="form-group">
                    <button class="btn btn-primary dim btn-sm" data-toggle="modal" data-target="#modalCreate">
                       thêm thể loại mới
                    </button>
                    <input type="text" class="form-control input-sm m-b-xs " id="filter" placeholder="Search in table">
                </div>

                <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                    <thead>
                        <tr>
                            <th>Mã thể loại</th>
                            <th>Tên thể loại</th>
                            <th data-sort-ignore="true">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['theloais'] as $theloai)
                        <tr class="gradeA">
                            <td>{{ $theloai->MaTheLoai }}</td>
                            <td>{{ $theloai->TenTheLoai }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-primary dim btn-sm" data-toggle="modal" data-target="#myModal" data-id="{{ $theloai->MaTheLoai }}" data-name="{{ $theloai->TenTheLoai }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="{{ route('theloai.delete', $theloai->MaTheLoai) }}" onclick="return confirm('Bạn chắc chắn muốn xoá thể loại này không?');">
                                        <button class="btn btn-danger dim btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach

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
                        <form action="{{ route('theloai.edit')}}" method="post">
                            @csrf
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <i class="fa fa-laptop modal-icon"></i>
                                    <h4 class="modal-title">Chỉnh sửa thể loại</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Tên thể loại</label>
                                        <input type="text" placeholder="Tên thể loại" class="form-control" name="TenTheLoai">
                                        @if ($errors->has('TenTheLoai'))
                                        <span class="help-block m-b-none label label-warning" label label-warning>{{ $errors->first('TenTheLoai') }}</span>
                                        @endif
                                        <input type="hidden" name="MaTheLoai" value="">
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

                <div class="modal inmodal" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('theloai.create')}}" method="post">
                            @csrf
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <i class="fa fa-laptop modal-icon"></i>
                                    <h4 class="modal-title">Thêm thể loại</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Tên thể loại</label>
                                        <input type="text" placeholder="Tên thể loại" class="form-control" name="TenTheLoai">
                                        @if ($errors->has('TenTheLoai'))
                                        <span class="help-block m-b-none label label-warning" label label-warning>{{ $errors->first('TenTheLoai') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>