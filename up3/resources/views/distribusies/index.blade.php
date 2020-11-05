@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

@endsection

@section('content')
    <div class="box" col-md-6>

        <div class="box-header">
            <h3 class="box-title">Material Distribusi</h3>
        </div>

        <div class="box-header">
            <a onclick="addForm()" class="btn btn-primary" >Tambah Material Distribusi</a>
            <a href="{{ route('exportPDF.distribusiesAll') }}" class="btn btn-danger">Export PDF</a>
            <a href="{{ route('exportExcel.distribusiesAll') }}" class="btn btn-success">Export Excel</a>
        </div>


        <!-- /.box-header -->
        <div class="box-body">
            <table id="distribusi-table" class="table table-striped">
                <thead>
                <tr>
                    <th>Nama Material</th>
                    <th>Satuan</th>
                    <th>Jenis Material</th>
                    <th>Harga Satuan</th>
                    <th>Transportasi Dan Asuransi</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>     
    </div>
@include('distribusies.form')

    

@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>


    <script type="text/javascript">
        var table = $('#distribusi-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.distribusies') }}",
            columns: [
                
                {data: 'nama_material_distribusi', name: 'nama_material_distribusi'},
                {data: 'satuan_distribusi', name: 'satuan_distribusi'},
                {data: 'jenis_material_distribusi', name: 'jenis_material_distribusi'},
                {data: 'harga_satuan_dist', name: 'harga_satuan_dist'},
                {data: 'asuransi_dan_transportasi_dist', name: 'asuransi_dan_transportasi_dist'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Tambah Material Distribusi');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('distribusies') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Material Distribusi');

                    $('#id').val(data.id);
                    $('#nama_material_distribusi').val(data.nama_material_distribusi);
                    $('#satuan_distribusi').val(data.satuan_distribusi);
                    $('#jenis_material_distribusi').val(data.jenis_material_distribusi);
                    $('#harga_satuan_dist').val(data.harga_satuan_dist);
                    $('#asuransi_dan_transportasi_dist').val(data.asuransi_dan_transportasi_dist)
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
                    url : "{{ url('distribusies') }}" + '/' + id,
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
                    if (save_method == 'add') url = "{{ url('distribusies') }}";
                    else url = "{{ url('distribusies') . '/' }}" + id;

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