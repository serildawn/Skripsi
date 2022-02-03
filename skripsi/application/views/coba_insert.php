<?php $this->load->view("admin/includes/header") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Insert Data</h4>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart('') ?>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Nama</label>
                    <div class="col-md-10">
                        <input type="text" name="nama" class="form-control" placeholder="nama" value="<?php echo set_value('nama') ?>">
                        <?php echo form_error('nama', '', '') ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Alamat</label>
                    <div class="col-md-10">
                    <input type="text" name="alamat" class="form-control" placeholder="alamat" value="<?php echo set_value('alamat') ?>">
                        <?php echo form_error('alamat', '', '') ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">tgl_lahir</label>
                    <div class="col-md-10">
                        <input type="date" name="tgl_lahir" class="form-control" placeholder="tgl_lahir" value="<?php echo set_value('tgl_lahir') ?>">
                        <?php echo form_error('tgl_lahir', '', '') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="offset-md-2 col-md-12">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>