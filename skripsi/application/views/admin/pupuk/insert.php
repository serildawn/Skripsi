<?php $this->load->view("admin/includes/header") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Insert Data Pupuk</h4>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart('') ?>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Nama</label>
                    <div class="col-md-10">
                        <input type="text" name="nama_pupuk" class="form-control" placeholder="nama pupuk" value="<?php echo set_value('nama_pupuk') ?>">
                        <?php echo form_error('nama_pupuk', '', '') ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Warna</label>
                    <div class="col-md-10">
                        <input type="color" name="warna" placeholder="warna pupuk">
                        <?php echo form_error('warna', '', '') ?>
                    </div>
                </div>


                <hr>



                <div class="row">
					<div class="offset-md-2 col-md-10">
						<input class="btn btn-primary" type="submit" value="Simpan">
						<input class="btn btn-outline-primary" type="reset" value="Reset" />
					</div>
				</div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>