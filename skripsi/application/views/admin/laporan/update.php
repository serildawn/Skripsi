<?php $this->load->view("admin/includes/header") ?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"> Update</h4>
			</div>
			<div class="card-body">
				<?= form_open_multipart('') ?>

				<div class="form-group row">
					<label class="col-md-2 col-form-label">Nama Kios</label>
					<div class="col-md-10">
						<select name="fk_kios" class="form-control" id="kios">
							<option value="">Pilih</option>
							<?php foreach ($kios as $key => $k) : ?>
								<option value="<?= $k['id_kios'] ?>" <?= ($laporan_data->id_kios == $k['id_kios'] ? "selected" : "") ?>><?= $k['nama_kios'] ?></option>
							<?php endforeach ?>
						</select>
						<?= form_error('fk_kios', '', '') ?>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Pupuk</label>
					<div class="col-md-10">
						<select name="fk_pupuk" class="form-control" id="pupuk">
							<option value="">Pilih</option>
							<?php foreach ($pupuk as $key => $p) : ?>
								<option value="<?= $p['id_pupuk'] ?>" <?= ($laporan_data->id_pupuk == $p['id_pupuk'] ? "selected" : "") ?>><?= $p['nama_pupuk'] ?></option>
							<?php endforeach ?>
						</select>
						<?= form_error('fk_pupuk', '', '') ?>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-2 col-form-label">Jenis</label>
					<div class="col-md-10">
						<select name="id_jenis" class="form-control">
							<option value="">Pilih</option>
							<?php foreach ($jenis as $key => $j) : ?>
								<option value="<?= $j['id_jenis'] ?>" <?= ($laporan_data->id_jenis == $j['id_jenis'] ? "selected" : "") ?> ><?= $j['nama_jenis'] ?></option>
							<?php endforeach ?>
						</select>
						<?= form_error('id_jenis', '', '') ?>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Jumlah</label>
					<div class="col-md-10">
						<input type="text" name="qty" class="form-control" placeholder="jumlah" value="<?= $laporan_data->qty ?>">
						<?= form_error('qty', '', '') ?>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Bulan</label>
					<div class="col-md-10">
						<select name="bulan" class="form-control">
							<option <?= ($laporan_data->bulan =="Januari" ? "selected" : "") ?>>Januari</option>
							<option <?= ($laporan_data->bulan =="Februari" ? "selected" : "") ?>>Februari</option>
							<option <?= ($laporan_data->bulan =="Maret" ? "selected" : "") ?>>Maret</option>
							<option <?= ($laporan_data->bulan =="April" ? "selected" : "") ?>>April</option>
							<option <?= ($laporan_data->bulan =="Mei" ? "selected" : "") ?>>April</option>
							<option <?= ($laporan_data->bulan =="Juni" ? "selected" : "") ?>>Mei</option>
							<option <?= ($laporan_data->bulan =="Juli" ? "selected" : "") ?>>Juni</option>
							<option <?= ($laporan_data->bulan =="Agustus" ? "selected" : "") ?>>Juli</option>
							<option <?= ($laporan_data->bulan =="September" ? "selected" : "") ?>>Agustus</option>
							<option <?= ($laporan_data->bulan =="Oktober" ? "selected" : "") ?>>September</option>
							<option <?= ($laporan_data->bulan =="November" ? "selected" : "") ?>>November</option>
							<option <?= ($laporan_data->bulan =="Desember" ? "selected" : "") ?>>Desember</option>
						</select>

					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-2 col-form-label">Tahun</label>
					<div class="col-md-10">
						<input type="number" name="tahun" class="form-control" placeholder="tahun" value="<?= $laporan_data->tahun ?>">
						<?= form_error('tahun', '', '') ?>
					</div>
				</div>


				<div class="row">
					<div class="offset-md-2 col-md-12">
						<button type="submit" class="btn btn-primary">
							Submit
						</button>
					</div>
				</div>

				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view("admin/includes/footer") ?>