<?php $this->load->view("admin/includes/header") ?>
<div class="row">

  <div class="col-md-12">

    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Kios </h4>
      </div>
      <div class="card-body">
      <?php if (user_allow([1],false)): ?>
					<a href="<?= base_url("kios/insert") ?>" class="btn btn-primary">Tambah Kios</a>
				<?php endif ?>
        
        <div class="table-responsive">
          <table class="table table-sm aso-datatable-clean">
            <thead class=" text-primary">
              <th>
                #
              </th>
              <th>
                Nama Kios
              </th>
              <th>
                Nama Pemilik
              </th>
              <th>
                Alamat Kios
              </th>
              <th>
                No Telp
              </th>
              <th>
                Status
              </th>
              <?php if (user_allow([1],false)): ?>
              <th class="text-right">
                Action
              </th>
              <?php endif ?>
            </thead>
            <tbody>
              <?php foreach ($kios_data as $key => $value) : ?>
                <tr>
                  <td>
                    <?php echo $key + 1; ?>
                  </td>
                  <td>
                    <?php echo $value->nama_kios ?>
                  </td>
                  <td>
                    <?php echo $value->nama_pemilik ?>
                  </td>
                  <td>
                    <?php echo $value->alamat ?>
                  </td>
                  <td>
                    <?php echo $value->no_telp ?>
                  </td>
                  <td>
                    <?php echo $value->status ?>
                  </td>

                  <?php if (user_allow([1],false)): ?>
                  <td class="text-right">
                    <a href="<?php echo base_url("kios/update/" . $value->id_kios) ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                    <a href="<?php echo base_url("kios/delete/" . $value->id_kios) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                  </td>
                  <?php endif ?>
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