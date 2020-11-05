<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  id="form-item" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>


                <div class="modal-body">
                    <input type="hidden" id="id" name="id">


                    <div class="box-body">
                    <div class="form-group">
                            <label >Kategori Laporan</label>
                            {!! Form::select('category_id', $category, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Category --', 'id' => 'category_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                    </div>
                        <div class="form-group">
                            <label >Nama Material</label>
                            <input type="text" class="form-control" id="name" name="name"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label>Satuan</label>
                            <select class="form-control" id="satuan" name="satuan" required="">
                                <option value=""></option>
                                <option value="meter">meter</option>
                                <option value="unit">unit</option>
                                <option value="buah">buah</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-body">
                    <div class="form-group">
                        <label> Jenis Material</label>
                        <select class="form-control" name="jenis_material" required="">
                                <option value=""></option>
                                <option value="app">App</option>
                                <option value="kabel">Kabel</option>
                                <option value="trafo">Trafo</option>
                                <option value="tiang_beton">Tiang Beton</option>
                                <option value="material_pendukung">Material Pendukung</option>
                            </select>
                    </div>
                    </div>
                    <!-- /.box-body -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
