<?php $this->load->view("admin/includes/header") ?>
<div class="row">

	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<?php echo form_open('', ['id' => 'form-distribusi']); ?>

				<div class="form-group row">
					<label class="col-form-label col-md-2 text-right">Nama Karyawan</label>
					<div class="col-md-10">
						<input type="text" class="form-control" value="<?php echo $this->session->userdata('userlogin')['nama'] ?>" disabled>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-2 text-right">Tanggal</label>
					<div class="col-md-10">
						<input type="date" name="tanggal" class="form-control form-tanggal" value="<?php echo date('Y-m-d') ?>">
					</div>
				</div>

			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="card">
			<div class="card-body">


				<div class="form-group row">
					<label class="col-form-label col-md-2 text-right">Nama Kios</label>
					<div class="col-md-10">
						<select class="form-control form-kios" name="id_kios">
							<option value="">Choose</option>
							<?php $kios = $this->db->get('kios')->result(); ?>
							<?php foreach ($kios as $key => $value) : ?>
								<option value="<?php echo $value->id_kios ?>"><?php echo $value->nama_kios ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-2 text-right">Pupuk</label>
					<div class="col-md-10">
						<select name="fk_pupuk" class="form-control" id="pupuk">
							<option value="-1">Choose</option>
							<?php $pupuk = $this->db->get('pupuk')->result();  ?>
							<?php foreach ($pupuk as $key => $value) : ?>
								<option value="<?php echo $value->id_pupuk ?>"><?php echo $value->nama_pupuk ?></option>
							<?php endforeach ?>
						</select>
						<?php echo form_error('fk_pupuk', '', '') ?>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-2 text-right">Jumlah</label>
					<div class="col-md-10">
						<input type="number" name="jumlah" class="form-control" placeholder="jumlah" value=1 min=1>
						<?php echo form_error('jumlah', '', '') ?>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-2 text-right">Nama Supir</label>
					<div class="col-md-10">
						<input type="text" name="supir" class="form-control" placeholder="nama supir" value="">
						<?php echo form_error('supir', '', '') ?>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-2 text-right">Nomor Polisi</label>
					<div class="col-md-10">
						<input type="text" name="nopol" class="form-control" placeholder="nomor polisi" value="">
						<?php echo form_error('nopol', '', '') ?>
					</div>
				</div>

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
<!-- <script>
var cname_url = "<?php echo base_url('Distribusi') ?>";
var index = 0;

$(document).ready(function() {


$('#form-distribusi').submit(function(e) {
e.preventDefault();


let fk_kios = $(".form-kios").val();

if (fk_kios == "") {
Swal.fire({
icon: 'error',
title: 'Error',
text: 'Please fill kios',
})
return;
}

let elementForm = $(this);
let submitForm = elementForm.find('button[type="submit"]');

let formData = new FormData(this);

$.ajax({
url: cname_url + "/add_distribusi",
type: 'POST',
data: formData,
dataType: 'JSON',
cache: false,
contentType: false,
processData: false,
beforeSend: () => {
submitForm.addClass('disabled');
}
})
.done((data) => {
$('.container-distribusi').html("");
$('.form-kios').val("");

Swal.fire({
icon: data.type,
title: data.title,
text: data.text,
})

let alert_html = "";
alert_html += '<a href="' + data.detail_url + '">';
alert_html += '<div class="alert alert-primary">';
alert_html += 'Berhasil melakukan tambah surat jalan';
alert_html += '</div>';
alert_html += '</a>';

$('#alert-container').append(alert_html);

submitForm.removeClass('disabled');
});

});

$('.form-kios').change(function() {
let fk_kios = $(this).val();
$('#fk_kios').val(fk_kios);
})
});


</script> -->