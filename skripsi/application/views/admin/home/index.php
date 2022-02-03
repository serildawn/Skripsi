<!DOCTYPE html>
<html lang="en">
<script src="<?php echo base_url('assets/js/chart.min.js') ?>"></script>
<?php $this->load->view('admin/includes/header') ?>

<div class="row">

	<div class="col-md-12">

		<div class="card">
			<div class="card-header">
				<h4 class="card-title"> Data Pendistribusian </h4>
			</div>
			<div class="card-body">
				<div class="form-group row">
					<label class="col-md-2 col-form-label text-right">Pilih Kios</label>
					<div class="col-md-3">
						<select class="form-control" onchange="pilihKios(this)">
							<option value="">Semua</option>
							<?php foreach ($kios as $key => $value) : ?>
								<option value="<?= $value['id_kios'] ?>"><?= $value['nama_kios'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<canvas id="myChart" height="100"></canvas>
			</div>
		</div>
	</div>
</div>

<script>
	var ctx = document.getElementById("myChart")
	var newDataset = {
		label: "Vendas",
		backgroundColor: 'rgba(99, 255, 132, 0.2)',
		borderColor: 'rgba(99, 255, 132, 1)',
		borderWidth: 1,
		data: [10, 20, 30, 40, 50, 60, 70],
	}
	var Chart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: <?= $tahun ?>,
			datasets: <?= $chart ?>
		},
		options: {
			plugins: {
				title: {
					display: true,
					text: '',
					padding: {
						top: 10,
						bottom: 20
					},
					font: {
						size: 24
					}
				},
				tooltip: {
					borderWidth: 0,
					backgroundColor: 'rgba(0, 0, 0, 0.8)'
				}
			},
			responsive: true,
		}
	})

	function pilihKios(el){
		window.location = '<?= base_url('home?kios=') ?>'+el.value
	}

	$('select').val('<?= $id_kios ?>')

</script>
<?php $this->load->view('admin/includes/footer') ?>
