<?php $this->load->view("admin/includes/header") ?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"> Input Laporan Bulanan</h4>
			</div>
			<div class="card-body">
				<?= form_open_multipart('') ?>

				<div class="form-group row">
					<label class="col-md-2 col-form-label">Nama Kios</label>
					<div class="col-md-10">
						<select name="fk_kios" class="form-control" id="kios">
							<option value="">Pilih</option>
							<?php foreach ($kios as $key => $k) : ?>
								<option value="<?= $k['id_kios'] ?>"><?= $k['nama_kios'] ?></option>
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
								<option value="<?= $p['id_pupuk'] ?>"><?= $p['nama_pupuk'] ?></option>
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
								<option value="<?= $j['id_jenis'] ?>" <?= (set_value("jenis") == $j['nama_jenis'] ? "selected" : "") ?> ><?= $j['nama_jenis'] ?></option>
							<?php endforeach ?>
						</select>
						<?= form_error('id_jenis', '', '') ?>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Qty</label>
					<div class="col-md-10">
						<input type="number" name="qty" class="form-control" placeholder="qty" value="">
						<?= form_error('qty', '', '') ?>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-2 col-form-label">Bulan</label>
					<div class="col-md-10">
						<select name="bulan" class="form-control">
							<option <?= (set_value("bulan") == "Januari" ? "selected" : "") ?>>Januari</option>
							<option <?= (set_value("bulan") == "Februari" ? "selected" : "") ?>>Februari</option>
							<option <?= (set_value("bulan") == "Maret" ? "selected" : "") ?>>Maret</option>
							<option <?= (set_value("bulan") == "April" ? "selected" : "") ?>>April</option>
							<option <?= (set_value("bulan") == "Mei" ? "selected" : "") ?>>April</option>
							<option <?= (set_value("bulan") == "Juni" ? "selected" : "") ?>>Mei</option>
							<option <?= (set_value("bulan") == "Juli" ? "selected" : "") ?>>Juni</option>
							<option <?= (set_value("bulan") == "Agustus" ? "selected" : "") ?>>Juli</option>
							<option <?= (set_value("bulan") == "September" ? "selected" : "") ?>>Agustus</option>
							<option <?= (set_value("bulan") == "Oktober" ? "selected" : "") ?>>September</option>
							<option <?= (set_value("bulan") == "November" ? "selected" : "") ?>>November</option>
							<option <?= (set_value("bulan") == "Desember" ? "selected" : "") ?>>Desember</option>
						</select>

					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-2 col-form-label">Tahun</label>
					<div class="col-md-10">
						<input type="number" name="tahun" class="form-control" placeholder="tahun" value=2016 min=2016>
						<?= form_error('tahun', '', '') ?>
					</div>
				</div>

				<div class="row">
					<div class="offset-md-2 col-md-10">
						<input class="btn btn-primary" type="submit" value="Simpan">
						<input class="btn btn-outline-primary" type="reset" value="Reset" />
					</div>
				</div>

				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view("admin/includes/footer") ?>