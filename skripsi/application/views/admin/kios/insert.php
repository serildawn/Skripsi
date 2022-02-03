<?php $this->load->view("admin/includes/header") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Insert Data Kios</h4>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart('') ?>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Nama Kios</label>
                    <div class="col-md-10">
                        <input type="text" name="nama_kios" class="form-control" placeholder="nama kios" value="<?php echo set_value('nama_kios') ?>">
                        <?php echo form_error('nama_kios', '', '') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Nama Pemilik</label>
                    <div class="col-md-10">
                        <input type="text" name="nama_pemilik" class="form-control" placeholder="nama pemilik" value="<?php echo set_value('nama_pemilik') ?>">
                        <?php echo form_error('nama_pemilik', '', '') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Alamat Kios</label>
                    <div class="col-md-10">
                        <input type="text" name="alamat" class="form-control" placeholder="alamat kios" value="<?php echo set_value('alamat') ?>">
                        <?php echo form_error('alamat', '', '') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">No Telpon</label>
                    <div class="col-md-10">
                        <input type="text" name="no_telp" class="form-control" placeholder="no telpon" value="<?php echo set_value('no_telp') ?>">
                        <?php echo form_error('no_telp', '', '') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-10">
                    <select name="status" class="form-control">
                            <option <?php echo (set_value("status") == "Aktif" ? "selected" : "") ?>>Aktif</option>
                            <option <?php echo (set_value("status") == "Tidak Aktif" ? "selected" : "") ?>>Tidak Aktif</option>
                           
                        </select>
                  
                       
                    </div>
                </div>

              
                <div class="row">
					<div class="offset-md-2 col-md-10">
						<input class="btn btn-primary" type="submit" value="Simpan">
						<input class="btn btn-outline-primary" type="reset" value="Reset" />
					</div>
				</div>


                <!-- <div class="row">
                    <div class="offset-md-2 col-md-12">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div> -->

                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>