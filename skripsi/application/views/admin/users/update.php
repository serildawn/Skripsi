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
                    <label class="col-md-2 col-form-label">
                        Gambar
                    </label>
                    <div class="col-md-10">

                        <img src="<?php echo base_url('storage/users/' . $users_data->gambar) ?>" width="100px" alt="" class="img-preview">
                        <input type="file" name="gambar" class="btn btn-primary" id="input-file">
                        <?php echo (isset($error_gambar) ? $error_gambar : "") ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Nama</label>
                    <div class="col-md-10">
                        <input type="text" name="nama" class="form-control" placeholder="nama" value="<?php echo $users_data->nama ?>">
                        <?php echo form_error('nama', '', '') ?>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Username</label>
                    <div class="col-md-10">
                        <input type="text" name="username" class="form-control" placeholder="username" value="<?php echo $users_data->username ?>">
                        <?php echo form_error('username', '', '') ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Password</label>
                    <div class="col-md-5">
                        <input type="text" name="password" class="form-control" placeholder="password">
                        <?php echo form_error('password', '', '') ?>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="repassword" class="form-control" placeholder="repassword">
                        <?php echo form_error('repassword', '', '') ?>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Level</label>
                    <div class="col-md-10">
                        <select name="level" id="" class="form-control">

                            <option value="1" <?php echo ($users_data->level == 1 ? "selected" : "") ?>>Admin</option>
                            <option value="2" <?php echo ($users_data->level == 2 ? "selected" : "") ?>>Karyawan</option>
                      
                        </select>
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
<script>
    $(document).ready(function() {
        $('#input-file').change(function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.img-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        })
    });
</script>