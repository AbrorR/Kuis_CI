<?php $this->load->view('layouts/base_start') ?>

<div class="container">
  <legend>Tambah Data Jurusan</legend>
  <div class="col-xs-12 col-sm-12 col-md-12">
  <?php echo form_open_multipart('jurusan/store'); ?>

	<div class="form-group">
      <label for="Jurusan">Jurusan</label>
      <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukkan Jurusan"
		value="<?php echo set_value('jurusan'); ?>">  
    </div>

	<?php echo $error; ?>    

	<a class="btn btn-info" href="<?php echo site_url('jurusan/') ?>">Kembali</a>
    <button type="submit" class="btn btn-primary">OK</button>
  <?php echo form_close() ?>
  </div>
</div>

<?php $this->load->view('layouts/base_end') ?>