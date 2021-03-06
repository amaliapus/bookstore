<?php 
// Error upload
if(isset($error)) {
  echo '<p class="alert alert-warning">';
  echo $error;
  echo '</p>';
}

// Notifikasi error
echo validation_errors('<div class="alert alert-warning">', '</div>');

// Form open pakai MULTIPART untuk form yang ada upload GAMBAR
echo form_open_multipart(base_url('admin/buku/gambar/' .$buku->id_buku), ' class="form-horizontal"');
 ?>

<div class="form-group">
  <label class="col-md-2 control-label">Judul Gambar</label>
  <div class="col-md-8">
    <input type="text" name="judul_gambar" class="form-control"  placeholder="Judul Gambar" value="<?php echo set_value('judul_gambar') ?>" required>
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label">Unggah Gambar</label>
  <div class="col-md-3">
    <input type="file" name="gambar" class="form-control"  placeholder="Unggah Gambar" value="<?php echo set_value('gambar') ?>" required>
  </div>
  <div class="col-md-5">
    <button class="btn btn-success " name="submit" type="submit">
      <i class="fa fa-save"></i> Simpan dan Unggah Gambar
    </button>
    <button class="btn btn-success " name="reset" type="reset">
        <i class="fa fa-times"></i> Reset
   </button>
  </div>
</div>



<?php echo form_close(); ?>

<?php 
// Notifikasi
if($this->session->flashdata('sukses')) {
  echo '<p class="alert alert-success">';
  echo $this->session->flashdata('sukses');
  echo '</div>';
}
?>

<table class="table table-boardered" id="example1">
  <caption>table title and/or explanatory text</caption>
  <thead>
    <tr>
      <th>NO</th>
      <th>GAMBAR</th>
      <th>JUDUL</th>
      <th>ACTION</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>
        <img src="<?php echo base_url('assets/upload/image/' .$buku->gambar) ?>" class="img img-responsive img-thumbnail" width="60">
      </td>
      <td><?php echo $buku->judul_buku ?></td>
      <td>
      </td>
  </tr>
    <?php $no=2; foreach($gambar as $gambar){ ?>
  <tr>
    <td><?php echo $no ?></td>
    <td>
      <img src="<?php echo base_url('assets/upload/image/' .$gambar->gambar) ?>" class="img img-responsive img-thumbnail" width="60">
    </td>
    <td><?php echo $gambar->judul_gambar ?></td>
    <td>

      <a href="<?php echo base_url('admin/buku/delete_gambar/'.$buku->id_buku.'/'.$gambar->id_gambar) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus gambar ini?')"><i class="fa fa-trash-o"></i>Hapus</a>

    </td>
  </tr>
    <?php $no++; } ?>
  </tbody>
</table>