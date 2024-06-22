<div class="card shadow mb-4 main-page">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Penduduk</h6>
    </div>
    <div class="card-body">
        <form class="form-save">
            <div class="row">
                @if(!empty($data))
                    <input type="hidden" name="id" value="{{ $data->id_penduduk }}">
                @endif
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap <font color="red">*</font></label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama_lengkap" id="nama_lengkap" @if (!empty($data)) value="{{$data->anggota->tmpLahir}}" @endif>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nik">NIK <font color="red">*</font></label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="NIK" name="nik" id="nik" @if (!empty($data)) value="{{$data->anggota->tmpLahir}}" @endif>
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
                        <label for="tglLahir">Tanggal Lahir<font color="red">*</font></label>
                        <div class="input-group">
                            <input type="date" class="form-control" placeholder="NIK" name="tglLahir" id="tglLahir" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="provinsi">Provinsi<font color="red">*</font></label>
                        <div class="input-group">
                            <select name="provinsi" id="prov" class="form-control">
                                <option value="" selected>.:: Pilih Provinsi ::.</option>
                                @foreach ($provinsi as $prov)
                                <option value="{{ $prov->id }}" {{ (!empty($data->provinsi_id)) && $prov->id == $data->provinsi ? 'selected' : '' }}>{{ $prov->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="provinsi">Kabupaten<font color="red">*</font></label>
                        <div class="input-group">
                            <select name="kabupaten" id="kab" class="form-control" disabled>
                                @if (!empty($data))
                                    @foreach ($kabupaten as $kab)
                                        <option value="{{ $data->kabupaten_id }}" {{ $kab->id == $data->kabupaten ? 'selected' : ''}}>{{ $kab->nama }}</option>
                                    @endforeach
                                @endif
                            </select>
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
        </form>
    <button type="button" class="btn btn-secondary waves-effect btn-cancel"><i class="feather icon-plus"></i>Kembali</button>
    <button type="button" onclick="addRow()" class="btn btn-primary waves-effect btn-cancel float-right"><i class="feather icon-plus"></i>Simpan</button>
</div>
</div>

<script type="text/javascript">
    $('#prov').select2({
        placeholder: '.:: Pilih Provinsi ::.',
        width: '100%',
    });
    $('#kab').select2({
        placeholder: '.:: Pilih Kabupaten ::.',
        width: '100%',
    });
    $('.btn-cancel').click(function(e){
        e.preventDefault();
        $('.other-page').fadeOut(function(){
            $('.other-page').empty();
            $('.main-page').fadeIn();
        });
    });

    $(document).ready(function () {
        $('#prov').change(function() {
            var id = $('#prov').val();
            $.post("{!! route('getKabupaten') !!}", {
                id: id
            }).done(function(data) {
                if (data.length > 0) {
                    var kab = '<option>.:: Pilih Kabupaten ::.</option>';
                    $.each(data, function(k, v) {
                        kab += '<option value="' + v.id + '">' + v.nama +'</option>';
                    });

                    $('#kab').html(kab);
                    $('#kab').removeAttr('disabled');
                    $('#kab').select2();

                    @if (!empty($data))
                        $('#kab').val('{{ $data->kabupaten_id }}').trigger('change');
                    @endif
                } else {
                    $('#kab').html(kab);
                    $('#kab').attr('disabled', 'disabled');
                }
            });
        });
    })
</script>
