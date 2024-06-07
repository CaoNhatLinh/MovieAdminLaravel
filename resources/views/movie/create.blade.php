<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Thêm phim </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>

                </div>
            </div>
            <div class="ibox-content">
                <form method="POST" action="{{ route('movie.create') }}" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="form-group"><label class="col-sm-2 control-label">Tiêu đề</label>

                        <div class="col-sm-10"><input type="text" name="TieuDe" id="TieuDe" placeholder="Tiêu đề" class="form-control" required></div>
                        @if ($errors->has('TieuDe'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('TieuDe') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Tiêu đề Quốc tế</label>

                        <div class="col-sm-10"><input type="text" name="TieuDeQuocTe" id="TieuDeQuocTe" placeholder="Tiêu đề quốc tế" class="form-control" required></div>
                        @if ($errors->has('TieuDeQuocTe'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('TieuDeQuocTe') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">thời lượng</label>

                        <div class="col-sm-10"><input type="text" name="ThoiLuong" id="ThoiLuong" placeholder="40 phút/tập" class="form-control"></div>
                        @if ($errors->has('ThoiLuong'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('ThoiLuong') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Tổng Số tập</label>
                        <div class="col-sm-10"><input type="number" name="SoTap" id="TinhTrang" placeholder="Nhập tổng số tập" class="form-control"></div>
                        @if ($errors->has('SoTap'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('SoTap') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Năm phát hành</label>
                        <div class="col-sm-10"><input type="number" name="NamPhatHanh" id="NamPhatHanh" placeholder="Năm phát hành" class="form-control" required value="2024">
                            @if ($errors->has('NamPhatHanh'))
                            <span class="help-block m-b-none label label-warning">{{ $errors->first('NamPhatHanh') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Đạo diễn</label>

                        <div class="col-sm-10"><input type="text" name="DaoDien" id="DaoDien" placeholder="Nhập đạo diễn" class="form-control"></div>
                        @if ($errors->has('DaoDien'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('DaoDien') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Diễn viên</label>

                        <div class="col-sm-10"><input type="text" name="DienVien" id="DienVien" placeholder="nhập diễn viên" class="form-control"></div>
                        @if ($errors->has('DienVien'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('DienVien') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Kiểu phim</label>

                        <div style="display:flex;align-items: center;" class="col-sm-10">
                            @foreach ($filteredTheloais as $theloai)
                            <input style="margin: 0px 0 0;" type="radio" id="theloai_{{ $theloai->MaTheLoai }}" name="TheLoai[]" value="{{ $theloai->MaTheLoai }}">
                            <label style="margin: 0px 15px  0 2px;" for="theloai_{{ $theloai->MaTheLoai }}">{{ $theloai->TenTheLoai }}</label>
                            @endforeach

                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Thể loại</label>

                        <div style="display:flex;align-items: center; flex-wrap: wrap;" class="col-sm-10 ">
                            @foreach ($remainingTheloais as $theloai)
                            <div style="margin-bottom:3px; padding:0 10px">
                                <input style="margin: 0px 0 0;" type="checkbox" id="theloai_{{ $theloai->MaTheLoai }}" name="TheLoai[]" value="{{ $theloai->MaTheLoai }}">
                                <label style="margin: 0px 15px  0 2px; width:max-content" for="theloai_{{ $theloai->MaTheLoai }}">{{ $theloai->TenTheLoai }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Quốc Gia</label>

                        <div class="col-sm-10">
                            <select class="form-control m-b chosen-select" tabindex="2" data-placeholder="Chọn 1 Quốc gia" name="QuocGia">
                                <option value="">Select</option>
                                <?php
                                $filePath = public_path('js/countries.json');

                                if (file_exists($filePath)) {
                                    $jsonContent = file_get_contents($filePath);
                                    $countries = json_decode($jsonContent, true);
                                    if (json_last_error() === JSON_ERROR_NONE) {
                                        foreach ($countries as $country) {
                                            $countryName = $country['name']['common'];
                                ?>
                                            <option value="{{ $countryName }}"> {{ htmlspecialchars($countryName) }}</option>
                                <?php
                                        }
                                        echo '</select>';
                                    } else {
                                        echo 'Error decoding country data';
                                    }
                                } else {
                                    echo 'File not found';
                                }
                                ?>


                            </select>
                            @if ($errors->has('QuocGia'))
                            <span class="help-block m-b-none label label-warning">{{ $errors->first('QuocGia') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Định dạng phim</label>

                        <div class="col-sm-10">
                            <select class="form-control m-b" name="NgonNgu" required data-placeholder="chọn ngôn ngữ">
                                <option value="Vietsub">Vietsub</option>
                                <option value="Engsub">Engsub</option>
                                <option value="Lồng tiếng">Lồng tiếng</option>
                            </select>
                            @if ($errors->has('NgonNgu'))
                            <span class="help-block m-b-none label label-warning">{{ $errors->first('NgonNgu') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea id="MoTa" name="MoTa" rows="4" cols="50" type="text" placeholder="Nhập mô tả" class="form-control"></textarea>
                            @if ($errors->has('MoTa'))
                            <span class="help-block m-b-none label label-warning">{{ $errors->first('MoTa') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Chất Lượng</label>

                        <div class="col-sm-10">
                            <select class="form-control m-b" name="ChatLuong" required data-placeholder="chọn chất lượng">
                                <option value="2k">2k</option>
                                <option selected value="HD">HD</option>
                                <option value="720p">720p</option>
                                <option value="720p">480p</option>
                                <option value="360p">360p</option>
                            </select>
                            @if ($errors->has('ChatLuong'))
                            <span class="help-block m-b-none label label-warning">{{ $errors->first('ChatLuong') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Ảnh bìa</label>
                        <div class="col-sm-10"><input type="text" name="AnhBia" id="AnhBia" placeholder="Đường dẫn ảnh bìa" class="form-control"></div>
                        @if ($errors->has('AnhBia'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('AnhBia') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Banner</label>
                        <div class="col-sm-10"><input type="text" name="Banner" id="Banner" placeholder="Đường dẫn banner" class="form-control"></div>
                        @if ($errors->has('Banner'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('Banner') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary dim btn-sm " type="submit">thêm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>