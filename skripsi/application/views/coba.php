<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COBA</title>
</head>

<body>
    <?php

        //echo $tabel [0]->nama;

        //lek dalam bentuk array
        foreach ($tabel as $key=>$value){
            echo $value->nama;
        }
    ?>
</body>

</html> -->

<?php $this->load->view("admin/includes/header") ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Tabel User</h4>

        <a href="<?php echo base_url("Coba/insert") ?>" class="btn btn-primary">Tambah</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table aso-datatable-clean">
            <thead class=" text-primary">
              <th> # </th>
              <th> Nama </th>
              <th> Alamat </th>
              <th> Tanggal </th>
              
              <th class="text-right"> Action </th>
            </thead>
            <tbody>
              <?php foreach ($tabel as $key => $value) : ?>
                <tr>
                  <td>
                    <?php echo $key + 1; ?>
                  </td>
                  <td>
                    <?php echo $value->nama ?>
                  </td>
                  <td>
                    <?php echo $value->alamat ?>
                  </td>
                  <td>
                    <?php echo $value->tgl_lahir ?>
                  </td>
                  <td class="text-right">
                    <a href="<?php echo base_url("Users/update/" . $value->id) ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                    <a href="<?php echo base_url("Users/delete/" . $value->id) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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