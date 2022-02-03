<?php $this->load->view("admin/includes/header") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title"> Simple Table</h4>

                <a href="<?php echo base_url('storage/format/import_persediaan.xls') ?>" class="btn btn-primary">Download Format</a>
            </div>
            <div class="card-body">

                <?php echo form_open_multipart('', ['id' => 'form-import']) ?>
                <input type="file" name="excel" id="input-file">
                <input type="submit">
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view("admin/includes/footer") ?>
<script>
    $(document).ready(function() {
        $("form#form-import").submit(function(e) {
            e.preventDefault();

            let elementForm = $(this);
            let formData = new FormData(this);

            $.ajax({
                url: elementForm.attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'JSON',
                success: function(data) {

                    Swal.fire({
                        title: data.title,
                        text: data.text,
                        icon: data.type,
                    })

                    $("#input-file").val(null);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    });
</script>