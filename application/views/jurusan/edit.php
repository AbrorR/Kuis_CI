<?php $this->load->view('layouts/base_start') ?>

<div class="container">
  <legend>Edit Data Jurusan</legend>
  <div class="col-xs-12 col-sm-12 col-md-12">
  <?php echo form_open_multipart('jurusan/update/'.$data->id_jurusan); ?>

    <?php echo form_hidden('id_jurusan', $data->id_jurusan) ?>
    
  	<div class="form-group">
      <label for="Jurusan">Jurusan</label>
      <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukkan Jurusan"
        value="<?php echo $data->nama_jurusan ?>">
    </div>

    <?php echo $error;?>

    <a class="btn btn-info" href="<?php echo site_url('jurusan/') ?>">Kembali</a>
    <button type="submit" class="btn btn-primary">OK</button>

  <?php echo form_close(); ?>
  </div>
</div>

<?php $this->load->view('layouts/base_end') ?>