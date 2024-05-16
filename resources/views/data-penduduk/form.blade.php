<div class="card shadow mb-4 main-page">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Penduduk</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tmpLahir">Nama Lengkap <font color="red">*</font></label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="tmpLahir" id="tmpLahir" @if (!empty($data)) value="{{$data->anggota->tmpLahir}}" @endif>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tmpLahir">NIK <font color="red">*</font></label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="NIK" name="tmpLahir" id="tmpLahir" @if (!empty($data)) value="{{$data->anggota->tmpLahir}}" @endif>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tmpLahir">Jenis Kelamin <font color="red">*</font></label>
                    <div class="form-radio">
                        <div class="radio radio-inline">
                            <label>
                            <input type="radio" name="jnskelamin" value="L" id="radioL">
                            <i class="helper"></i>Laki Laki
                            </label>
                        </div>
                        <div class="radio radio-inline">
                            <label>
                            <input type="radio" name="jnskelamin" value="P" id="radioP">
                            <i class="helper"></i>Perempuan
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tmpLahir">Tanggal Lahir<font color="red">*</font></label>
                    <div class="input-group">
                        <input type="date" class="form-control" placeholder="NIK" name="tglLahir" id="tglLahir" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="provinsi">Provinsi<font color="red">*</font></label>
                    <div class="input-group">
                        <select name="provinsi" id="provinsi" class="form-control"></select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="provinsi">Kabupaten<font color="red">*</font></label>
                    <div class="input-group">
                        <select name="provinsi" id="provinsi" class="form-control"></select>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="alamat">Alamat<font color="red">*</font></label>
                    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"></textarea>
                </div>
            </div>
        </div>
    <button type="button" onclick="addRow()" class="btn btn-primary waves-effect btn-cancel" data-toggle="modal" data-target="#large-Modal"><i class="feather icon-plus"></i>Kembali</button>
    <button type="button" onclick="addRow()" class="btn btn-primary waves-effect btn-cancel float-right" data-toggle="modal" data-target="#large-Modal"><i class="feather icon-plus"></i>Simpan</button>
</div>
</div>

<script type="text/javascript">
    $('.btn-cancel').click(function(e){
        e.preventDefault();
        $('.other-page').fadeOut(function(){
            $('.other-page').empty();
            $('.main-page').fadeIn();
            // $('#datagrid').DataTable().ajax.reload();
        });
    });
</script>
