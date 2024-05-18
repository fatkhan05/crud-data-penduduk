@extends('layouts.master')
@section('title')
    Data Provinsi
@endsection
@section('content')
    <div class="card shadow mb-4 main-page">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Provinsi</h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <button type="button" onclick="addRow()" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#large-Modal"><i class="feather icon-plus"></i>Tambah Baru</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
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
            console.log('datatable');
            var table = $('#dataTables').dataTable({
                processing: true,
                serverSide: true,
                language: {
                    searchPlaceholder: "Ketikkan yang dicari"
                },
                ajax: "{{ route('main-data-provinsi') }}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    render: function(data, type, row) {
                    return '<p style="color:black">' + data + '</p>';
                    }
                },
                {
                    data: 'nopendaftaran_lama',
                    name: 'nopendaftaran_lama',
                    render: function(data, type, row) {
                        if (data) {
                            return '<p style="color:black">' + data + '</p>';
                        } else {
                            return '-'
                        }
                    }
                },
                {
                    data: 'NOPORSI',
                    name: 'NOPORSI',
                    render: function(data, type, row) {
                    if(data) {
                        return '<p style="color:black">'+data+'</p>';
                    } else {
                        return '-'
                    }
                    }
                },
                {
                    data: 'nmLengkap',
                    name: 'nmLengkap',
                    render: function(data, type, row) {
                        if (data) {
                            return '<p style="color:black">' + data + '</p>';
                        } else {
                            return '-'
                        }
                    }
                },
                {
                    data: 'alamat',
                    name: 'alamat',
                    render: function(data, type, row) {
                        if (data) {
                            return '<p style="color:black">' + data + '</p>';
                        } else {
                            return '-'
                        }
                    }
                },
                {
                    data: 'estimasi_keberangkatan',
                    name: 'estimasi_keberangkatan',
                    render: function(data, type, row) {
                        const date = new Date(data);
                        const year = date.getFullYear();
                        return '<p style="color:black">'+year+'</p>';
                    }
                },
                {
                    data: 'notelp',
                    name: 'notelp',
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
        function addRow() {
            $('.main-page').hide();
            $.post("{!! route('form-data-provinsi') !!}", {
                _token: "{{ csrf_token() }}"
            }).done(function(data){
                if(data.status == 'success'){
                    $('.other-page').html(data.content).fadeIn();
                } else {
                    $('.main-page').show();
                }
            });
        }
    </script>
@endpush

{{--  --}}
