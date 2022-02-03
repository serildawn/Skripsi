<?php $this->load->view("admin/includes/header") ?>
<div class="row">

  <div class="col-md-12">

    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Pupuk</h4>
      </div>
      <div class="card-body">
      <?php if (user_allow([1],false)): ?>
					<a href="<?php echo base_url("Pupuk/insert") ?>" class="btn btn-primary">Tambah Pupuk</a>
				<?php endif ?>
        <div class="table-responsive">
          <table class="table table-sm aso-datatable-clean">
            <thead class=" text-primary">
              <th>
                #
              </th>
              <th>
                Nama Pupuk
              </th>
              <?php if (user_allow([1],false)): ?>
              <th class="text-right">
                Action
              </th>
              <?php endif ?>
            </thead>
            <tbody>
              <?php foreach ($pupuk_data as $key => $value) : ?>
                <tr>
                  <td>
                    <?php echo $key + 1; ?>
                  </td>
                  <td>
                    <?php echo $value->nama_pupuk ?>
                  </td>

                  <?php if (user_allow([1],false)): ?>
                  <td class="text-right">
                    <a href="<?php echo base_url("Pupuk/update/" . $value->id_pupuk) ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                    <a href="<?php echo base_url("Pupuk/delete/" . $value->id_pupuk) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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