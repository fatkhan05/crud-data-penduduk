@extends('layouts.master')
@section('title')
    Data Kabupaten
@endsection
@section('content')
    <div class="card shadow mb-4 main-page">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kabupaten</h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <button type="button" onclick="addRow()" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#large-Modal"><i class="feather icon-plus"></i>Tambah Baru</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kabupaten</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="other-page"></div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#dataTable').dataTable({
              processing: true,
              serverSide: true,
              language: {
                  searchPlaceholder: "Ketikkan yang dicari"
              },
              ajax: "{{ route('main-data-kabupaten') }}",
              columns: [{
                  data: 'DT_RowIndex',
                  name: 'DT_RowIndex',
                  render: function(data, type, row) {
                  return '<p style="color:black">' + data + '</p>';
                  }
              },
              {
                  data: 'nama',
                  name: 'nama',
                  render: function(data, type, row) {
                      if (data) {
                          return '<p style="color:black">' + data + '</p>';
                      } else {
                          return '-'
                      }
                  }
              },
              {
                  data: 'action',
                  name: 'action',

              }]
          });
        })
        function addRow(id) {
            $('.main-page').hide();
            $.post("{!! route('form-data-kabupaten') !!}", {
                _token: "{{ csrf_token() }}",
                id: id
            }).done(function(data){
                if(data.status == 'success'){
                    $('.other-page').html(data.content).fadeIn();
                } else {
                    $('.main-page').show();
                }
            });
        }

        function editForm(id) {
            $('.main-page').hide();
            $.ajax({
                url: "{!! route('form-data-kabupaten') !!}",
                type: "POST",
                data: { id: id },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.status == 'success') {
                        $('.other-page').html(data.content).fadeIn();
                    } else {
                        $('.main-page').show();
                    }
                },
                error: function() {
                    $('.main-page').show();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                        confirmButtonColor: '#1A4237',
                    });
                }
            });
        }


        function deleteRow() {
          Swal.fire({
            title: 'Apakah Anda Yakin Akan Menghapus Data Ini?',
            text: 'Data akan Dihapus, dan Tidak dapat diperbaharui kembali !!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A4237',
            confirmButtonText: 'Ya, Hapus Data',
            cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                      url: '{{ route("destroy-data-kabupaten") }}',
                      method: 'POST',
                      data: {
                          _method: 'POST',
                          _token: '{{ csrf_token() }}',
                          id: id
                      },
                      success: function(response) {
                          if (response.success) {
                              Swal.fire({
                                  icon: 'success',
                                  title: 'Deleted!',
                                  text: response.success
                              });
                              // location.reload();
                              $('#dataTable').DataTable().ajax.reload();
                          } else {
                              Swal.fire({
                                  icon: 'error',
                                  title: 'Error',
                                  text: 'Failed to delete data'
                              });
                          }
                      },
                      error: function() {
                          Swal.fire({
                              icon: 'error',
                              title: 'Error',
                              text: 'Data Gagal Dihapus!!.'
                          });
                      }
                  });
              }
          });
        }
    </script>
@endpush
