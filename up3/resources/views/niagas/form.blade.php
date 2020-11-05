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
                            <label >Nama Material Niaga</label>
                            <input type="text" class="form-control" id="nama_material_niaga" name="nama_material_niaga" required="" >
                            <span class="help-block with-errors"></span>
                        </div>


                        <div class="form-group">
                            <label>Satuan</label>
                            <select class="form-control" id="satuan_niaga" name="satuan_niaga">
                                <option value="">--satuan--</option>
                                <option value="meter">meter</option>
                                <option value="unit">unit</option>
                                <option value="buah">buah</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Jenis Material</label>
                            <select class="form-control" id="jenis_material_niaga" name="jenis_material_niaga" >
                                <option value="">--jenis material--</option>
                                <option value="app">App</option>
                                <option value="kabel">Kabel</option>
                                <option value="trafo">Trafo</option>
                                <option value="tiang_beton">Tiang Beton</option>
                                <option value="material_pendukung">Material Pendukung</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Harga Satuan</label>
                            <input type="number" class="form-control" id="harga_satuan_niaga" name="harga_satuan_niaga" required="" >
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label >Transportasi dan Asuransi</label>
                            <input type="number" class="form-control" id="transportasi_dan_asuransi_niaga" name="transportasi_dan_asuransi_niaga" required="" >
                            <span class="help-block with-errors"></span>
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
