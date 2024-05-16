@extends('layouts.master')
@section('content')
    {{-- <h1>data penduduk</h1> --}}
    <div class="card shadow mb-4 main-page">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Penduduk</h6>
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
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="other-page"></div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#dataTables').dataTable( {
            } );
        })
        function addRow() {
            $('.main-page').hide();
            $.post("{!! route('form-data-penduduk') !!}", {
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
