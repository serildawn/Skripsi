<?php $this->load->view("admin/includes/header") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Peramalan Arima</h4>
            </div>
            <div class="card-body">
                <div class="row mr-3">
                    <div class="col-md-8">
                        <h5>Hitung Arima</h5>
                        <?php echo form_open("") ?>
                        <div class="form-group row">
                            <label for="" class="col-form-label col-md-3">Beta 1</label>
                            <div class="col-md-9">
                                <input type="text" name="beta_1" class="form-control" value="<?php echo web_config("beta1") ?>">
                                <?php echo form_error("beta_1") ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-form-label col-md-3">Beta 2</label>
                            <div class="col-md-9">
                                <input type="text" name="beta_2" class="form-control" value="<?php echo web_config("beta2") ?>">
                                <?php echo form_error("beta_2") ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-form-label col-md-3"></label>
                            <div class="col-md-9">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="update_config" class="custom-control-input" id="customCheck1" value="1">
                                    <label class="custom-control-label pt-1" for="customCheck1">Update Config</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-form-label col-md-3">Periode</label>
                            <div class="col-md-9">
                                <input type="number" name="periode" class="form-control" min=0 value=1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-md-3 col-md-9">
                                <button type="submit" class="btn btn-primary">Hitung</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>

                    </div>
                    <div class="col-md-4 bg-primary text-white" style="border-radius: 10px;">
                        <h5>Rumus Arima</h5>
                        <div class="form-group">
                            <input type="text" class="form-control-plaintext text-white" value="MA = jumlah awal produk">
                            <input type="text" class="form-control-plaintext text-white" value="AR1 = jumlah * beta1 + MA * beta2">
                            <input type="text" class="form-control-plaintext text-white" value="Error = jumlah - AR1">
                            <input type="text" class="form-control-plaintext text-white" value="PE = MA / jumlah">
                            <input type="text" class="form-control-plaintext text-white" value="HASIL = adalah hasil peramalan yang digunakan">
                        </div>
                    </div>
                </div>
                <?php if (isset($peramalan_data)) : ?>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Chart</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Table</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="chart-area" style="padding: 0 100px;">
                                <canvas id="lineChartExampleWithNumbersAndGrid" width="354" height="600" style="display: block; width: 354px; height: 600px;"></canvas>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                            <table class="table table-hover table-stripped" cellpadding="20px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tahun</th>
                                        <th>Bulan</th>
                                        <th>Jumlah</th>
                                        <?php if (isset($chart_peramalan['data_predik'])) : ?>

                                            <th>AR1</th>
                                            <th>ERROR</th>
                                            <th>MA1</th>
                                            <th>PE</th>
                                            <th>Hasil</th>
                                        <?php endif ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $list_bulan = [
                                        '1' => 'januari',
                                        '2' => 'februari',
                                        '3' => 'maret',
                                        '4' => 'april',
                                        '5' => 'mei',
                                        '6' => 'juni',
                                        '7' => 'juli',
                                        '8' => 'agustus',
                                        '9' => 'september',
                                        '10' => 'oktober',
                                        '11' => 'november',
                                        '12' => 'desember',
                                    ]; ?>
                                    <?php foreach ($peramalan_data as $key => $value) : ?>
                                        <tr>
                                            <td><?php echo $key + 1 ?></td>
                                            <td><?php echo $value['tahun'] ?></td>
                                            <td><?php echo $list_bulan[$value['bulan']] ?></td>
                                            <td><?php echo $value['jumlah'] ?></td>
                                            <?php if (isset($chart_peramalan['data_predik'])) : ?>
                                                <td><?php echo number_format($value['AR1'], 2, ",", ".") ?></td>
                                                <td><?php echo number_format($value['ERROR'], 2, ",", ".") ?></td>
                                                <td><?php echo number_format($value['MA1'], 2, ",", ".") ?></td>
                                                <td><?php echo number_format($value['PE'], 2, ",", ".") ?></td>
                                                <td><?php echo number_format($value['AR1'], 2, ",", ".") ?><br></td>
                                            <?php endif ?>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <?php if($chart_peramalan['data_predik']): ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>MAPE :</td>
                                        <td><?php echo $mape."%" ?></td>
                                        <td></td>
                                    </tr>
                                <?php endif ?>
                            </table>
                        </div>

                    </div>

                <?php endif ?>
            </div>
        </div>
    </div>

</div>
<?php $this->load->view("admin/includes/footer") ?>
<script>
    <?php if (isset($peramalan_data)) : ?>
        var gradientChartOptionsConfigurationWithNumbersAndGrid = {
            bezierCurve: false,
            maintainAspectRatio: false,
            legend: {
                display: true,
            },
            tooltips: {
                bodySpacing: 4,
                mode: "nearest",
                intersect: 0,
                position: "nearest",
                xPadding: 10,
                yPadding: 10,
                caretPadding: 10
            },
            responsive: true,
            scales: {
                yAxes: [{
                    gridLines: 0,
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawBorder: false
                    }
                }],
                xAxes: []
            },
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 15,
                    bottom: 15
                }
            }
        };
        ctx = document.getElementById('lineChartExampleWithNumbersAndGrid').getContext("2d");
        chartColor = "#FFFFFF";
        gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#18ce0f');
        gradientStroke.addColorStop(1, chartColor);

        gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
        gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
        gradientFill.addColorStop(1, hexToRGB('#18ce0f', 0.4));


        gradientFill2 = ctx.createLinearGradient(0, 170, 0, 50);
        gradientFill2.addColorStop(0, "rgba(128, 182, 244, 0)");
        gradientFill2.addColorStop(1, hexToRGB('#2a5788', 0.4));

        myChart = new Chart(ctx, {
            type: 'line',
            responsive: true,
            data: {
                labels: <?php echo $chart_peramalan['label'] ?>,
                datasets: [{
                        label: "Aktual",
                        borderColor: "#18ce0f",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#18ce0f",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        fill: true,
                        backgroundColor: gradientFill,
                        borderWidth: 2,
                        lineTension: 0,
                        data: <?php echo $chart_peramalan['data_aktual'] ?>
                    },
                    <?php if (isset($chart_peramalan['data_predik'])) : ?> {
                            label: "Predik",
                            borderColor: "#2a5788",
                            pointBorderColor: "#FFF",
                            pointBackgroundColor: "#2a5788",
                            pointBorderWidth: 2,
                            pointHoverRadius: 4,
                            pointHoverBorderWidth: 1,
                            pointRadius: 4,
                            fill: true,
                            backgroundColor: gradientFill2,
                            borderWidth: 2,
                            lineTension: 0,
                            data: <?php echo $chart_peramalan['data_predik'] ?>
                        }
                    <?php endif ?>
                ]
            },
            options: gradientChartOptionsConfigurationWithNumbersAndGrid
        });
    <?php endif ?>
</script>