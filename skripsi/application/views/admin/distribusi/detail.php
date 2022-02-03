<?php $this->load->view("admin/includes/header") ?>

<div class="row">
    <div class="col-md-12">
        <div class="card strpied-tabled-with-hover">
            <div class="card-header ">
                
                <h4 class="card-title">Detail Surat Jalan</h4>
              
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <td>Tanggal</td>
                        <td> : </td>
                        <td><?php echo $distribusi_data->tanggal ?></td>
                    </tr>
                    <tr>
                        <td>Nama Supir </td>
                        <td> : </td>
                        <td><?php echo $distribusi_data->supir ?></td>
                    </tr>
                    <tr>
                        <td>Nomer Kendaraan</td>
                        <td> : </td>
                        <td><?php echo $distribusi_data->nopol ?></td>
                    </tr>

                    <tr>
                        <td>Kios</td>
                        <td> : </td>
                        <td><?php echo $distribusi_data->kios ?></td>
                    </tr>
                    <tr>
                        <td>Pupuk</td>
                        <td> : </td>
                        <td><?php echo $distribusi_data->pupuk ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td> : </td>
                        <td><?php echo $distribusi_data->jumlah ?></td>
                    </tr>
                   
                </table>
            </div>
           
        </div>
    </div>
</div>
<?php $this->load->view("admin/includes/footer") ?>
