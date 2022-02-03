<?php $this->load->view("admin/includes/header") ?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"> Laporan Bulanan</h4>
			</div>
			<div class="card-body">
				<a href="<?= base_url("Laporan/insert") ?>" class="btn btn-primary">Input Laporan Bulanan</a>
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="laporan-tab" data-toggle="tab" href="#laporan" role="tab" aria-controls="laporan" aria-selected="true">Laporan</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active pt-3" id="laporan" role="tabpanel" aria-labelledby="laporan-tab">
						<div class="table-responsive">
							<table class="table table-striped" id="table" style="width: 100%">
								<thead class=" text-primary">
									<tr>
										<th></th>
										<th class="pr-5">
											<select class="form-control form-control-sm" id="filter_kios">
												<option value="">Semua Kios</option>
												<?php foreach ($kios as $k): ?>
													<option value="<?= $k['nama_kios'] ?>"><?= $k['nama_kios'] ?></option>
												<?php endforeach ?>
											</select>
										</th>
										<th class="pr-5">
											<select class="form-control form-control-sm" id="filter_pupuk">
												<option value="">Semua Pupuk</option>
												<?php foreach ($pupuk as $p): ?>
													<option value="<?= $p['nama_pupuk'] ?>"><?= $p['nama_pupuk'] ?></option>
												<?php endforeach ?>
											</select>
										</th>
										<th class="pr-5">
											<select class="form-control form-control-sm" id="filter_jenis">
												<option value="">Semua Jenis</option>
												<?php foreach ($jenis as $j): ?>
													<option value="<?= $j['nama_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
												<?php endforeach ?>
											</select>
										</th>
										<th class="pr-5">
											<select class="form-control form-control-sm" id="filter_tahun">
												<option value="">Semua Tahun</option>
												<?php foreach ($tahun as $t): ?>
													<option value="<?= $t['tahun'] ?>"><?= $t['tahun'] ?></option>
												<?php endforeach ?>
											</select>
										</th>
										<th class="pr-5">
											<select class="form-control form-control-sm" id="filter_bulan">
												<option value="">Semua Bulan</option>
												<?php foreach ($bulan as $b): ?>
													<option value="<?= $b ?>"><?= $b ?></option>
												<?php endforeach ?>
											</select>
										</th>
										<th></th>
									</tr>
									<tr>
										<th>*</th>
										<th data-sortable=false>Nama Kios</th>
										<th data-sortable=false>Pupuk</th>
										<th data-sortable=false>Jenis</th>
										<th data-sortable=false>Tahun</th>
										<th data-sortable=false>Bulan</th>
										<th>Jumlah</th>
										<th data-sortable=false	class="pr-5" class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($laporan_data as $key => $value) : ?>
										<tr>
											<td><?= $key + 1; ?></td>
											<td><?= $value->kios ?></td>
											<td><?= $value->pupuk ?></td>
											<td><?= $value->jenis ?></td>
											<td><?= $value->tahun ?></td>
											<td><?= $value->bulan?></td>
											<td><?= $value->qty ?></td>
											<td class="text-right">
												<a href="<?= base_url("Laporan/update/" . $value->id_laporan) ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
												<a href="<?= base_url("Laporan/delete/" . $value->id_laporan) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash"></i></a>
											</td>

										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>


				</div>
			</div>

		</div>
		<?php $this->load->view("admin/includes/footer") ?>
		<script>
			$(document).ready(function() {

				const dom = 
				"<'row'<'col-12 col-sm-4 pt-3'l><'col-12 col-sm-4 pt-3'f><'col-12 col-sm-4 text-right'B>>" +
				"<'row'<'col-12'tr>>" +
				"<'row'<'col-12 col-sm-5'i><'col-12 col-sm-7'p>>"

				const table = $('#table').DataTable({
					dom: dom,
					buttons: [{
						extend: 'excel',
						text: "Export Excel",
						className: "btn btn-primary btn-sm",
						exportOptions: {
							columns: [0,1,2,3,4,5,6],
						},
					},  {
						extend: 'pdfHtml5',
						text: 'Export PDF',
						className: "btn btn-primary btn-sm",
						exportOptions: {
							columns: [0,1,2,3,4,5,6],
						},
						customize: function(doc) {
							doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('')
						}
					}],
					initComplete: function(settings, json) {
						$(".dt-buttons").removeClass("dt-buttons")
						$(".dt-button").removeClass("dt-button")
					},
				})

				$('#filter_kios').change(function () {
					table.column(1).search(this.value).draw()
				})

				$('#filter_pupuk').change(function () {
					table.column(2).search(this.value).draw()
				})

				$('#filter_jenis').change(function () {
					table.column(3).search(this.value).draw()
				})

				$('#filter_tahun').change(function () {
					table.column(4).search(this.value).draw()
				})

				$('#filter_bulan').change(function () {
					table.column(5).search(this.value).draw()
				})


			})
		</script>