<?php $this->load->view("admin/includes/header") ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <?php if (user_allow([1],false)): ?>
                <a href="<?php echo base_url("distribusi/insert") ?>" class="btn btn-primary">Tambah Surat Jalan</a>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card strpied-tabled-with-hover">
            <div class="card-header ">
                <h4 class="card-title">Surat Jalan</h4>
                <p class="card-category">Daftar Surat Jalan</p>
            </div>
            <div class="card-body table-full-width table-responsive">
                <table class="table table-hover table-striped aso-datatable-clean">
                    <thead>
                        <th>ID</th>
                         <th>Karyawan</th>
                        <th>Kios</th>
                        <th>Pupuk</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th class="text-right">Action</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php foreach ($distribusi_data as $key => $value) : ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $value->nama_karyawan ?></td>
                                <td><?php echo $value->kios ?></td>
                                <td><?php echo $value->pupuk ?></td>
                                <td><?php echo $value->jumlah ?></td>
                                <td><?php echo $value->tanggal ?></td>
                                <td>
                                    <a href="<?php echo base_url("Distribusi/detail/" . $value->id_distribusi) ?>" class="btn btn-sm btn-primary">Detail</a>
                                    <?php if (user_allow([1],false)): ?>
                                    <a href="<?php echo base_url("Distribusi/set_delete/" . $value->id_distribusi) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    <?php endif ?>
                                </td>
                                <td class="text-right">
                   
                   
                  </td>
                            </tr>
                        <?php endforeach ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>
