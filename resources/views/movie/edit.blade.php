<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                Chỉnh sửa thông tin phim
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form method="POST" action="{{ route('movie.edit',$movie->MaPhim) }}" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="form-group"><label class="col-sm-2 control-label">Tiêu đề</label>

                        <div class="col-sm-10"><input type="text" name="TieuDe" id="TieuDe" placeholder="Tiêu đề" class="form-control" required value="{{$movie->TieuDe }}"></div>
                        @if ($errors->has('TieuDe'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('TieuDe') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Tiêu đề Quốc tế</label>

                        <div class="col-sm-10"><input type="text" name="TieuDeQuocTe" id="TieuDeQuocTe" placeholder="Tiêu đề quốc tế" class="form-control" required value="{{$movie->TieuDeQuocTe }}"></div>
                        @if ($errors->has('TieuDeQuocTe'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('TieuDeQuocTe') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">thời lượng</label>

                        <div class="col-sm-10"><input type="text" name="ThoiLuong" id="ThoiLuong" placeholder="40 phút/tập" value="{{$movie->ThoiLuong }}" class="form-control"></div>
                        @if ($errors->has('ThoiLuong'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('ThoiLuong') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Tổng Số tập</label>
                        <div class="col-sm-10"><input type="number" name="SoTap" id="SoTap" placeholder="Nhập tổng số tập" value="{{$movie->SoTap }}" class="form-control"></div>
                        @if ($errors->has('SoTap'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('SoTap') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Năm phát hành</label>
                        <div class="col-sm-10"><input type="number" name="NamPhatHanh" id="NamPhatHanh" placeholder="Năm phát hành" class="form-control" required value="{{$movie->NamPhatHanh }}">
                            @if ($errors->has('NamPhatHanh'))
                            <span class="help-block m-b-none label label-warning">{{ $errors->first('NamPhatHanh') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Đạo diễn</label>
                        <div class="col-sm-10"><input type="text" name="DaoDien" id="DaoDien" placeholder="Nhập đạo diễn" value="{{$movie->DaoDien}}" class="form-control"></div>
                        @if ($errors->has('DaoDien'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('DaoDien') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Diễn viên</label>

                        <div class="col-sm-10"><input type="text" name="DienVien" id="DienVien" placeholder="nhập diễn viên" value="{{$movie->DienVien }}" class="form-control"></div>
                        @if ($errors->has('DienVien'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('DienVien') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Kiểu phim</label>

                        <div style="display:flex;align-items: center;" class="col-sm-10">

                            @foreach ($filteredTheloais as $theloai)
                            <?php $isChecked = $movie->PhimTheLoai->contains('MaTheLoai', $theloai->MaTheLoai); ?>
                            
                            <input style="margin: 0px 0 0;" type="radio" id="theloai_{{ $theloai->MaTheLoai }}" name="TheLoai[]" value="{{ $theloai->MaTheLoai }}" {{ $isChecked ? 'checked' : '' }}>
                            <label style="margin: 0px 15px  0 2px;" for="theloai_{{ $theloai->MaTheLoai }}">{{ $theloai->TenTheLoai }}</label>
                            @endforeach



                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Thể loại</label>
                        <div style="display:flex;align-items: center; flex-wrap: wrap;" class="col-sm-10 ">
                            @foreach ($remainingTheloais as $theloai)
                            <div style="margin-bottom:3px; padding:0 10px">
                                <input style="margin: 0px 0 0;" type="checkbox" id="theloai_{{ $theloai->MaTheLoai }}" name="TheLoai[]" value="{{ $theloai->MaTheLoai }}" @if($movie->PhimTheLoai->contains('MaTheLoai', $theloai->MaTheLoai)) checked @endif>
                                <label style="margin: 0px 15px  0 2px; width:max-content" for="theloai_{{ $theloai->MaTheLoai }}">{{ $theloai->TenTheLoai }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Quốc gia</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b chosen-select" tabindex="2" data-placeholder="Chọn 1 quốc gia" name="QuocGia">
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
                                            <option value="{{ $countryName }}" {{$movie->QuocGia == $countryName ? 'selected' : ''}}> {{ htmlspecialchars($countryName) }}</option>
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
                                @if ($errors->has('QuocGia'))
                                <span class="help-block m-b-none label label-warning">{{ $errors->first('QuocGia') }}</span>
                                @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Định dạng phim</label>

                        <div class="col-sm-10">
                            <select class="form-control m-b" name="NgonNgu" required data-placeholder="chọn ngôn ngữ">
                                <option value="Vietsub" @if($movie->NgonNgu == 'Vietsub') selected @endif>Vietsub</option>
                                <option value="Engsub" @if($movie->NgonNgu == 'Engsub') selected @endif>Engsub</option>
                                <option value="Lồng tiếng" @if($movie->NgonNgu == 'Lồng tiếng') selected @endif>Lồng tiếng</option>
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
                            <textarea id="MoTa" name="MoTa" rows="4" cols="50" type="text" class="form-control">{{htmlspecialchars_decode($movie->MoTa)}}</textarea>
                            @if ($errors->has('MoTa'))
                            <span class="help-block m-b-none label label-warning">{{ $errors->first('MoTa') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Chất Lượng</label>

                        <div class="col-sm-10">
                            <select class="form-control m-b" name="ChatLuong" required data-placeholder="chọn chất lượng">
                                <option value="2k" @if($movie->ChatLuong == '2k') selected @endif>2k</option>
                                <option value="HD" @if($movie->ChatLuong == 'HD') selected @endif>HD</option>
                                <option value="720p" @if($movie->ChatLuong == '720p') selected @endif>720p</option>
                                <option value="480p" @if($movie->ChatLuong == '480p') selected @endif>480p</option>
                                <option value="360p" @if($movie->ChatLuong == '360p') selected @endif>360p</option>
                            </select>
                            @if ($errors->has('ChatLuong'))
                            <span class="help-block m-b-none label label-warning">{{ $errors->first('ChatLuong') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Ảnh bìa</label>
                        <div class="col-sm-10"><input type="text" name="AnhBia" id="AnhBia" placeholder="Đường dẫn ảnh bìa" class="form-control" value="{{$movie->AnhBia}}"></div>
                        @if ($errors->has('AnhBia'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('AnhBia') }}</span>
                        @endif
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Banner</label>
                        <div class="col-sm-10"><input type="text" name="Banner" id="Banner" placeholder="Đường dẫn banner" class="form-control" value="{{$movie->Banner}}"></div>
                        @if ($errors->has('Banner'))
                        <span class="help-block m-b-none label label-warning">{{ $errors->first('Banner') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary dim btn-sm " type="submit">Sửa</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>