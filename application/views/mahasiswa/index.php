<?php $this->load->view('layouts/base_start') ?>

<div class="container">
  <legend>Data Mahasiswa</legend>
  <div class="col-xs-12 col-sm-12 col-md-12">

    <form class="form-inline" action="<?php echo site_url('mahasiswa/index/') ?>" method="post">
      <select class="form-control" id="jurusan" name="jurusan">
        <option selected="selected" disabled="disabled" value="">Filter By</option>
        <option value="nama">Nama</option>
        <option value="alamat">Alamat</option>
        <option value="nama_jurusan">Jurusan</option>
      </select>
      <input class="form-control" type="text" name="search" value="" placeholder="Search...">
      <input class="btn btn-basic" type="submit" name="filter" value="Cari">
    </form>

    <table class="table table-striped">
      <thead>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Jurusan</th>
        <th>
          <a class="btn btn-primary" href="<?php echo site_url('mahasiswa/create/') ?>">
            Tambah
          </a>
        </th>
      </thead>
      <?php if(isset($mahasiswa)) { ?>
      <tbody>
        <?php $number = 1; foreach ($mahasiswa as $row) { ?>
        <tr>
          <td>
            <a href="<?php echo site_url('mahasiswa/show/'.$row->nim) ?>">
              <?php echo $number++ ?>
            </a>
          </td>
          <td>
            <a href="<?php echo site_url('mahasiswa/show/'.$row->nim) ?>">
              <?php echo $row->nama ?>
            </a>
          </td>
          <td>
            <a href="<?php echo site_url('mahasiswa/show/'.$row->nim) ?>">
              <?php echo $row->alamat ?>
            </a>
          </td>
          <td>
            <a href="<?php echo site_url('mahasiswa/show/'.$row->nim) ?>">
              <?php echo $row->nama_jurusan ?>
            </a>
          </td>
          <td>
            <?php echo form_open('mahasiswa/destroy/'.$row->nim); ?>
            <a class="btn btn-info" href="<?php echo site_url('mahasiswa/edit/'.$row->nim) ?>">
              Ubah
            </a>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
            <?php echo form_close() ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php echo $links ?>
  <?php } else { ?>
  <div>Tidak ada data</div>
  <?php } ?>
  </div>
</div>

<?php $this->load->view('layouts/base_end') ?>