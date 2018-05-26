<?php $this->load->view('layouts/base_start') ?>

<div class="container">
  <legend>Daftar jurusan</legend>
  <div class="col-xs-12 col-sm-12 col-md-12">
    <table class="table table-striped">
      <thead>
        <th>No</th>
        <th>Jurusan</th>
        <th>
          <a class="btn btn-primary" href="<?php echo site_url('jurusan/create') ?>">
            Tambah
          </a>
        </th>
      </thead>
      <tbody>
        <?php $number = 1; foreach($jurusan as $row) { ?>
        <tr>
          <td>
              <?php echo $number++ ?>
          </td>
          <td>
              <?php echo $row->nama_jurusan ?>
          </td>
          <td>
            <?php echo form_open('jurusan/destroy/'.$row->id_jurusan); ?>
            <a class="btn btn-info" href="<?php echo site_url('jurusan/edit/'.$row->id_jurusan) ?>">
              Ubah
            </a>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
            <?php echo form_close() ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php $this->load->view('layouts/base_end') ?>