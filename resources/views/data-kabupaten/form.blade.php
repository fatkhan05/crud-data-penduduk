<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $data ? 'Edit' : 'Tambah' }} Data Kabupaten</h6>
    </div>
    <div class="card-body">
        <form class="form-save">
            <input type="hidden" name="id" value="@if (!empty($data)) {{$data->id}} @endif">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_provinsi">Nama Provinsi <font color="red">*</font></label>
                        <select name="nama_provinsi" id="nama_provinsi" class="form-control select2">
                            <option value="" selected disabled>.:: Pilih Provinsi ::.</option>
                            @foreach ($provinsi as $prov)
                                <option value="{{ $prov->id }}" {{ (!empty($data->provinsi_id) && $data->provinsi_id == $prov->id) ? 'selected' : '' }}>{{ $prov->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_kabupaten">Nama Kabupaten <font color="red">*</font></label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nama Kabupaten" {{ (!empty($data)) ? '' : 'disabled' }}  name="nama_kabupaten" value="{{ (!empty($data)) ? $data->nama : '' }}" id="nama_kabupaten">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <button type="button" class="btn btn-primary waves-effect btn-cancel">Kembali</button>
    <button type="button" id="button-submit" class="btn btn-primary waves-effect float-right">Simpan</button>
</div>
</div>

<script>
    $('.select2').select2({
        placeholder: '.:: Pilih Provinsi ::.',
        width: '100%',
    });
    $('.btn-cancel').click(function(e){
        e.preventDefault();
        $('.other-page').fadeOut(function(){
            $('.other-page').empty();
            $('.main-page').fadeIn();
            // $('#datagrid').DataTable().ajax.reload();
        });
    });
    $(document).ready(function() {
        $('#nama_provinsi').change(function() {
            var selectedValue = $(this).val();
            if (selectedValue) {
                $('#nama_kabupaten').removeAttr('disabled');
            } else {
                $('#nama_kabupaten').attr('disabled', 'disabled');
            }
        });
    });

</script>
