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
                            <label >No. SPB</label>
                            {!! Form::select('spb_id', $spb, null, ['class' => 'form-control select', 'placeholder' => '-- Pilih No. SPB --', 'id' => 'spb_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Material SPB Dist.</label>
                            {!! Form::select('distribusi_id', $distribusi, null, ['class' => 'form-control select', 'placeholder' => '-- Pilih Material --', 'id' => 'distribusi_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>



                        <div class="form-group">
                            <label >Pabrikan</label>
                            {!! Form::select('pabrikan_id', $pabrikan, null, ['class' => 'form-control select', 'placeholder' => '-- Pilih Pabrikan --', 'id' => 'pabrikan_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>
                      
                        <div class="form-group">
                            <label >Total</label>
                            <input type="text" class="form-control" id="total_datang_dist" name="total_datang_dist" required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Tanggal</label>
                            <input data-date-format='yyyy-mm-dd' type="date" class="form-control" id="tanggal_datang_dist" name="tanggal_datang_dist"   required>
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
