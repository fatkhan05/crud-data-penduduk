<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $data ? 'Edit' : 'Tambah' }} Data Provinsi</h6>
    </div>
    <div class="card-body">
        <form class="form-save">
            <input type="hidden" name="id" value="@if (!empty($data)) {{$data->id}} @endif">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="tmpLahir">Nama Provinsi <font color="red">*</font></label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nama Provinsi" name="nama_provinsi" value="{{ (!empty($data)) ? $data->nama : '' }}" id="nama_provinsi">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <button type="button" class="btn btn-primary waves-effect btn-cancel">Kembali</button>
    <button type="button" id="button-submit" class="btn btn-primary waves-effect float-right">Simpan</button>
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

    $('#button-submit').click(function () {
        console.log('form save');
        var data = new FormData($('.form-save')[0]);
        $.ajax({
            data: data,
            url: "{{ route('store-data-provinsi') }}",
            type: "post",
            processData: false,
            contentType: false,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            },
        }).done(function(result) {
            if (result.code == 200) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: result.message,
                    timer: 1000,
                    confirmButtonColor: '#1A4237',
                });
                $('.other-page').fadeOut(function() {
                    $('.other-page').html('');
                    $('.main-page').fadeIn();
                    $('#dataTable').DataTable().ajax.reload();
                });
            } else if (result.status === 'warning' || result.status === 'error') {
                Swal.fire({
                    icon: result.status === 'warning' ? 'warning' : 'error',
                    title: result.status === 'warning' ? 'Whoops!' : 'Error!',
                    text: result.message,
                    confirmButtonColor: '#1A4237',
                });
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Something went wrong! Please try again later.',
                confirmButtonColor: '#1A4237',
            });
        });
    });
</script>
