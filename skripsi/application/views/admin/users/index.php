<?php $this->load->view("admin/includes/header") ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Tabel User</h4>

        <a href="<?php echo base_url("Users/insert") ?>" class="btn btn-primary">Tambah</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table aso-datatable-clean">
            <thead class=" text-primary">
              <th> # </th>
              <th> Nama </th>
              <th> Username </th>
              <th> Level </th>
              <th> Gambar </th>
              <th class="text-right"> Action </th>
            </thead>
            <tbody>
              <?php foreach ($users_data as $key => $value) : ?>
                <tr>
                  <td>
                    <?php echo $key + 1; ?>
                  </td>
                  <td>
                    <?php echo $value->nama ?>
                  </td>
                  <td>
                    <?php echo $value->username ?>
                  </td>
                  <td>
                    <?php switch ($value->level) {
                      case 1:
                        echo "<span class='badge badge-primary'>admin</span>";
                        break;
                      case 2:
                        echo "<span class='badge badge-warning'>karyawan</span>";
                        break;
                     
                    } ?>
                  </td>
                  <td>
                    <img src="<?php echo base_url("storage/users/" . $value->gambar) ?>" alt="" width="50px">
                  </td>
                  <td class="text-right">
                    <a href="<?php echo base_url("Users/update/" . $value->id_user) ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                    <a href="<?php echo base_url("Users/delete/" . $value->id_user) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
