<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Danh sách phim</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <a class="btn-link font-bold" href="{{ route('movie.createView') }}">
                        <button class="btn btn-primary btn-sm dim">
                            Thêm phim
                        </button>
                    </a>
                    <table class="footable table table-stripped toggle-arrow-tiny dataTables-example" data-page-size="15">
                        <thead>
                            <tr>
                                <th data-toggle="true">Mã phim</th>
                                <th>Tiêu đề</th>
                                <th data-hide="all">Mô tả</th>
                                <th data-hide="all">Năm phát hành</th>
                                <th data-hide="all">Ngôn ngữ</th>
                                <th data-hide="all">Đạo diễn</th>
                                <th>Thời lượng</th>
                                <th>Tình trạng</th>
                                <th>Số tập</th>
                                <th data-hide="phone">Ảnh bìa</th>
                                <th data-hide="all">Diễn viên</th>
                                <th data-hide="all">thể loại</th>
                                <th data-hide="phone">Ngày thêm</th>

                                <th data-sort-ignore="true">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['movies'] as $movie)
                            <tr>
                                <td>{{ $movie->MaPhim }}</td>
                                <td>{{ $movie->TieuDe }}</td>
                                <td>{{ $movie->MoTa}}</td>

                                <td>
                                    {{ $movie->NamPhatHanh }}
                                </td>
                                <td>{{ $movie->NgonNgu }}</td>
                                <td>{{ $movie->DaoDien }}</td>
                                <td>{{ $movie->ThoiLuong }}</td>
                                <td>@if($movie->TinhTrang)
                                    Hiện tập: {{ $movie->TinhTrang }}
                                    @else
                                    Chưa có tập phim
                                    @endif</td>
                                <td>{{ $movie->SoTap }}</td>
                                <td> <img object-fit: contain; width="50px" height="60px" src="{{ $movie->AnhBia }}" alt=""></td>
                                <td>{{ $movie->DienVien }}</td>
                                <td>
                                    @if ($movie->theloais->isNotEmpty())
                                    @foreach ($movie->theloais as $index => $theloai)
                                    {{ $theloai->TenTheLoai }}@if($index < $movie->theloais->count() - 1), @endif
                                        @endforeach
                                        @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($movie->NgayThem)->format('Y-m-d') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="me-2" href="{{route('movie.detailView',$movie->MaPhim)}}">
                                            <button class="btn btn-outline btn-primary dim btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>
                                        <a class=" me-2" href="{{route('movie.editView', $movie->MaPhim)}}">
                                            <button class="btn btn-outline btn-primary dim btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('movie.delete', $movie->MaPhim) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa phim này không?');"><button class="btn btn-danger dim btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

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