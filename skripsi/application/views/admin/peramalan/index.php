<?php $this->load->view("admin/includes/header") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Peramalan Arima</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <?php echo form_open("", ['id' => "form-arima"]) ?>
                        <div class="form-group row">
                            <label for="" class="col-form-label col-md-3">Kios</label>
                            <div class="col-md-9">
                                <select name="fk_kios" id="" class="form-control">
                                <option value="" >Kios</option>
                                    <?php $fkKiosR = 0; ?>
                                    <?php foreach ($this->db->get('kios')->result() as $key => $value) : ?>
                                        <?php if(sizeof($id_kios)) {
                                            $fkKiosR = $id_kios;    
                                        }?>
                                        <option value="<?php echo $value->id_kios ?>" <?= $fkKiosR == $value->id_kios ? 'selected' : "nama_kios" ?>><?php echo $value->nama_kios ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-form-label col-md-3">Periode</label>
                            <div class="col-md-9">
                                <input type="number" name="period" class="form-control" value="<?php echo (set_value('period') == "" ? date("M") : set_value("period")) ?>">

                            </div>
                        </div>
                        <h6>Arima</h6>
                        <div class="form-group row">
                            <label for="" class="col-form-label col-md-3">Beta 1</label>
                            <div class="col-md-9">
                                <input type="text" name="beta1" class="form-control" value="<?php echo (set_value('beta1') == "" ? $config['beta1'] : set_value("beta1")) ?>">
                                <?php echo form_error("beta1") ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-form-label col-md-3">Beta 2</label>
                            <div class="col-md-9">
                                <input type="text" name="beta2" class="form-control" value="<?php echo (set_value('beta2') == "" ? $config['beta2'] : set_value("beta2")) ?>">
                                <?php echo form_error("beta2") ?>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class=" col-md-9">
                                <input type="checkbox" name="cfg_update"> Update Config<br>
                                <button type="submit" class="btn btn-primary">Hitung</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="col-md-4 bg-success text-white pt-3" style="border-radius: 10px;">
                        <h5>Rumus Arima</h5>
                        <div class="form-group">
                            <p>AR = Zt-1 * beta1 + MA-1 * beta2</p>
                            <p>MA = Z - AR
                            <p>PE = MA / jumlah</p>

                           
                        </div>
                    </div>
                </div>

                <?php if(isset($data_avg_error)): ?>
                    <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Arima</a>
                       
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="accordion" id="accordionExample">

                            <?php foreach ($data_peramalan as $id_pupuk => $peramalan) : ?>
                                <div class="card mb-0">
                                    <div class="card-body" id="headingOne">
                                        <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#pupuk-<?php echo $id_pupuk ?>" aria-expanded="true" aria-controls="collapseOne">
                                            <?php echo $peramalan[0]->nama_pupuk ?>
                                        </button>
                                    </div>

                                    <div id="pupuk-<?php echo $id_pupuk ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">

                                            <legend><?php echo $peramalan[0]->nama_pupuk ?></legend>
                                            <table class="table table-hover table-stripped aso-datatable-clean" cellpadding="20px">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Periode</th>
                                                        <th>Jumlah</th>
                                                        <th>Ar</th>
                                                        <th>Ma</th>
                                                        <th>ABS</th>
                                                        <th>Pe</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($peramalan as $key => $value) : ?>
                                                        <tr>
                                                            <td><?php echo $key + 1 ?></td>
                                                            <td><?php echo $value->bulan . "-" . $value->tahun ?></td>
                                                            <td><?php echo number_format($value->jumlah, 0) ?></td>
                                                            <td><?php echo number_format($value->ar, 3) ?></td>
                                                            <td><?php echo number_format($value->ma, 3) ?></td>
                                                            <td><?php echo number_format($value->error, 3) ?></td>
                                                            <td><?php echo number_format($value->pe, 3) ?></td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="accordion" id="accordionExample2">

                                                  </div>
                    </div>
                </div>


                <br>
                <p>MAPE : <?php echo $data_avg_error['arima']."%" ?></p>
              

                </br>

                <legend>Hasil</legend>
                <table class="table table-hover table-stripped aso-datatable-clean" cellpadding="20px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>pupuk</th>
                            <th>ARIMA</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_hasil as $key => $value) : ?>
                            <tr>
                                <td><?php echo $key  ?></td>
                                <td><?php echo $value->nama_pupuk  ?></td>
                                <td><?php echo number_format($value->ar, 3) ?></td>
                             
                            <?php endforeach ?>
                    </tbody>
                </table>

                <div class="accordion" id="accordionExample3">

                   
                </div>
                <?php endif ?>



            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>
<script>
    var gradientChartOptionsConfigurationWithNumbersAndGrid = {
        bezierCurve: false,
        // maintainAspectRatio: false,
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
</script>

