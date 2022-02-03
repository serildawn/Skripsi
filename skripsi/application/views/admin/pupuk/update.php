<?php $this->load->view("admin/includes/header") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Update</h4>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart('') ?>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Nama Pupuk</label>
                    <div class="col-md-10">
                        <input type="text" name="nama_pupuk" class="form-control" placeholder="nama pupuk" value="<?php echo $pupuk_data->nama_pupuk ?>">
                        <?php echo form_error('nama_pupuk', '', '') ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Warna</label>
                    <div class="col-md-10">
                        <input type="color" name="warna" placeholder="warna pupuk" value="<?php echo $pupuk_data->warna ?>">
                        <?php echo form_error('warna', '', '') ?>
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