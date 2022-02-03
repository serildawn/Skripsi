<?php $this->load->view("admin/includes/header") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Data Laporan Bulanan</h4>


                <a href="<?php echo base_url("Laporan/insert") ?>" class="btn btn-primary">Insert</a>
                <!-- <a href="<?php echo base_url("Laporan/import") ?>" class="btn btn-primary">import</a> -->
            </div>
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Data</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Draft</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Process</a>
                        <a class="nav-item nav-link" id="nav-done-tab" data-toggle="tab" href="#nav-done" role="tab" aria-controls="nav-done" aria-selected="false">Done</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active pt-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <table class="table table-hover table-striped aso-datatable-scroll" cellpadding="20px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kios</th>
                                    <th>Pupuk</th>
                                    <th>Jenis</th>
                                    <th>Qty</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th class="text-right">Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($laporan_data as $key => $value) : ?>
                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td>
                                            <?php echo $value->kios ?>
                                        </td>
                                        <td>
                                            <?php echo $value->pupuk ?>
                                        </td>
                                        <td>
                                            <?php echo $value->jenis ?>
                                        </td>
                                        <td>
                                            <?php echo $value->qty ?>
                                        </td>
                                        <td>
                                            <?php echo $value->bulan?>
                                        </td>
                                        <td>
                                            <?php echo $value->tahun ?>
                                        </td>
                                        <td>
                                            <?php switch ($value->jenis) {
                                                case 1:
                                                    echo '<span class="badge badge-info">Stock Awal</a>';
                                                    break;
                                                case 2:
                                                    echo '<span class="badge badge-primary">Penebusan</a>';
                                                    break;
                                                case 3:
                                                    echo '<span class="badge badge-success">Pendistribusian</a>';
                                                    break;
                                                case 4:
                                                    echo '<span class="badge badge-success">Stock Akhir</a>';
                                                    break;
                                            } ?>
                                        </td>
                                       
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade pt-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <table class="table table-hover table-striped aso-datatable-clean" cellpadding="20px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kios</th>
                                    <th>Pupuk</th>
                                    <th>Jenis</th>
                                    <th>Qty</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomer = 1; ?>
                                <?php foreach ($laporan_data as $key => $value) : ?
                                >
                                    <?php if ($value->status != 1) continue; ?>
                                    <tr>
                                        <td><?php echo $nomer++; ?></td>
                                        <td>
                                        <?php echo $value->kios ?>
                                    </td>
                                        <td>
                                            <?php echo $value->pupuk ?>
                                        </td>
                                     
                                       
                                        <td>
                                            <?php switch ($value->jenis) {
                                                case 1:
                                                    echo '<span class="badge badge-info">Stock Awal</a>';
                                                    break;
                                                case 2:
                                                    echo '<span class="badge badge-primary">Penebusan</a>';
                                                    break;
                                                case 3:
                                                    echo '<span class="badge badge-success">Pendistribusian</a>';
                                                    break;
                                                case 4:
                                                    echo '<span class="badge badge-success">Stock Akhir</a>';
                                                    break;
                                            } ?>
                                        </td>
                                        <td>
                                        <?php echo $value->qty ?>
                                    </td>
                                    <td>
                                        <?php echo $value->bulan?>
                                    </td>
                                    <td>
                                        <?php echo $value->tahun ?>
                                    </td>
                                        <td>
                                            <?php foreach ($this->db->select('*,(select nama_kios from kios where id=produksi_detail.fk_bahan) as nama_bahan')->where('fk_produksi', $value->id)->get('produksi_detail')->result() as $k => $v) : ?>
                                                <small class="text-info font-weight-bold" style="color:#4682B4 !important;"><?php echo $v->nama_bahan . ", : " . $v->jumlah  ?></small><br>
                                            <?php endforeach ?>
                                        </td>
                                        <td>
                                            <?php if ($value->status == 1) : ?>

                                                <a href="<?php echo base_url("Produksi/set_process/" . $value->id) ?>" class="btn btn-primary btn-sm">Process</a>
                                                <a href="<?php echo base_url("Produksi/set_delete/" . $value->id) ?>" class="btn btn-primary btn-sm">Remove</a>
                                            <?php endif ?>
                                            <?php if ($value->status == 2) : ?>

                                                <a href="<?php echo base_url("Produksi/set_done/" . $value->id) ?>" class="btn btn-primary btn-sm">Done</a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade pt-3" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <table class="table table-hover table-striped aso-datatable-clean" cellpadding="20px">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Nama Kios</th>
                                <th>Pupuk</th>
                                <th>Jenis</th>
                                <th>Qty</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomer = 1; ?>
                                <?php foreach ($laporan_data as $key => $value) : ?>
                                    <?php if ($value->status != 2) continue; ?>
                                    <tr>
                                        <td><?php echo $nomer++; ?></td>
                                        <td><?php echo $value->tanggal ?></td>
                                        <td><?php echo $value->nama_produk ?></td>
                                        <td><?php echo $value->jumlah ?></td>
                                        <td><?php echo $value->nama_karyawan ?></td>
                                        <td>
                                            <?php echo $value->qty ?>
                                        </td>
                                        <td>
                                            <?php echo $value->bulan?>
                                        </td>
                                        <td>
                                            <?php echo $value->tahun ?>
                                        </td>
                                        <td>
                                            <?php if ($value->status == 1) : ?>

                                                <a href="<?php echo base_url("Laporan/set_stockawal/" . $value->id) ?>" class="btn btn-primary btn-sm">Stock Awal</a>
                                                <a href="<?php echo base_url("Laporan/set_penebusan/" . $value->id) ?>" class="btn btn-primary btn-sm">Penebusan</a>
                                                <a href="<?php echo base_url("Laporan/set_pendistribusian/" . $value->id) ?>" class="btn btn-primary btn-sm">Pendistribusian</a>
                                            <?php endif ?>
                                            <?php if ($value->status == 2) : ?>

                                                <a href="<?php echo base_url("Laporan/set_stockakhir/" . $value->id) ?>" class="btn btn-primary btn-sm">Stock Akhir</a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade pt-3" id="nav-done" role="tabpanel" aria-labelledby="nav-done-tab">
                        <table class="table table-hover table-striped aso-datatable-clean" cellpadding="20px">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Nama Kios</th>
                                <th>Pupuk</th>
                                <th>Jenis</th>
                                <th>Qty</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomer = 1; ?>
                                <?php foreach ($laporan_data as $key => $value) : ?>
                                    <?php if ($value->jenis != 3) continue; ?>
                                    <tr>
                                        <td><?php echo $nomer++; ?></td>
                                        <td><?php echo $value->tanggal ?></td>
                                        <td><?php echo $value->nama_produk ?></td>
                                        <td><?php echo $value->jumlah ?></td>
                                        <td><?php echo $value->nama_karyawan ?></td>

                                        <td>
                                        <?php echo $value->qty ?>
                                    </td>
                                    <td>
                                        <?php echo $value->bulan?>
                                    </td>
                                    <td>
                                        <?php echo $value->tahun ?>
                                    </td>
                                        
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>