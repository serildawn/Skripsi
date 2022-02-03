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
                    <label class="col-md-2 col-form-label">Nama Kios</label>
                    <div class="col-md-10">
                        <input type="text" name="nama_kios" class="form-control" placeholder="nama kios" value="<?php echo $kios_data->nama_kios ?>">
                        <?php echo form_error('nama_kios', '', '') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Nama Pemilik</label>
                    <div class="col-md-10">
                        <input type="text" name="nama_pemilik" class="form-control" placeholder="nama pemilik" value="<?php echo $kios_data->nama_pemilik ?>">
                        <?php echo form_error('nama_pemilik', '', '') ?>
                    </div>
                </div>
               

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Alamat Kios</label>
                    <div class="col-md-10">
                        <input type="text" name="alamat" class="form-control" placeholder="alamat" value="<?php echo $kios_data->alamat ?>">
                        <?php echo form_error('alamat', '', '') ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">No Telp</label>
                    <div class="col-md-10">
                        <input type="text" name="no_telp" class="form-control" placeholder="no_telp" value="<?php echo $kios_data->no_telp ?>">
                        <?php echo form_error('stok', '', '') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-10">
                    <select name="status" class="form-control">
                            <option <?php echo ($kios_data->status == "Aktif" ? "selected" : "") ?>>Aktif</option>
                            <option <?php echo ($kios_data->status == "Tidak Aktif" ? "selected" : "") ?>>Tidak Aktif</option>
                        </select>
                        <?php echo form_error('status', '', '') ?>
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