@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">SPB MATERIAL DISTRIBUSI</h3>


        </div>

        <div class="box-header">
            <a onclick="addForm()" class="btn btn-primary" >Tambah SPB Dist.</a>
            <a href="{{ route('exportPDF.spbDistribusiAll') }}" class="btn btn-danger">Export PDF</a>
            <a href="{{ route('exportExcel.spbDistribusiAll') }}" class="btn btn-success">Export Excel</a>
        </div>




        <!-- /.box-header -->
        <div class="box-body">
            <table id="spbdists-in-table" class="table table-striped">
                <thead>
                <tr>
                    
                    <th>Tanggal</th>
                    <th>No. PRK</th>
                    <th>No. SPB</th>
                    <th>Nama Material</th>
                    <th>Satuan</th>
                    <th>Jenis Material</th>
                    <th>Pabrikan</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>



    @include('spb_distribusi.form')

@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>
    <!-- InputMask -->
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('assets/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
       
    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    <script type="text/javascript">
        var table = $('#spbdists-in-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.spbDist') }}",
            columns: [
               
                {data: 'tanggal_spb_dist', name: 'tanggal_spb_dist'},
                {data: 'no_prk', name: 'no_prk'},
                {data: 'no_spb', name: 'no_spb'},
                {data: 'material', name: 'material'},
                {data: 'satuan', name: 'satuan'},
                {data: 'jenis_material', name: 'jenis_material'},
                {data: 'pabrikan', name: 'pabrikan'},
                {data: 'total_spb_dist', name: 'total_spb_dist'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Tambah SPB Material Distribusi ');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('spbDist') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit SPB Distribusi');

                    $('#id').val(data.id);
                    $('#prk_id').val(data.prk_id);
                    $('#distribusi_id').val(data.distribusi_id);
                    $('#spb_id').val(data.spb_id);
                    $('#pabrikan_id').val(data.pabrikan_id);
                    $('#total_spb_dist').val(data.total_spb_dist);
                    $('#tanggal_spb_dist').val(data.tanggal_spb_dist)
                   
                },
                error : function() {
                    alert("Nothing Data");
                }
            });
        }


        function deleteData(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax({
                    url : "{{ url('spbDist') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    },
                    error : function () {
                        swal({
                            title: 'Oops...',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            });
        }

        $(function(){
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('spbDist') }}";
                    else url = "{{ url('spbDist') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
                        //hanya untuk input data tanpa dokumen
                        //data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error : function(data){
                            swal({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
        });

    </script>

@endsection
