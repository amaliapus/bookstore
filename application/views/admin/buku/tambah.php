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
echo form_open_multipart(base_url('admin/buku/tambah'), ' class="form-horizontal"');
 ?>

<div class="form-group">
  <label class="col-md-2 control-label">Judul Buku</label>
  <div class="col-md-5">
    <input type="text" name="judul_buku" class="form-control"  placeholder="Judul Buku" value="<?php echo set_value('judul_buku') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Penulis</label>
  <div class="col-md-5">
    <input type="text" name="penulis" class="form-control"  placeholder="Penulis" value="<?php echo set_value('penulis') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Penerbit</label>
  <div class="col-md-5">
    <input type="text" name="penerbit" class="form-control"  placeholder="Penerbit" value="<?php echo set_value('penerbit') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Kode Buku</label>
  <div class="col-md-5">
    <input type="text" name="kode_buku" class="form-control"  placeholder="Kode" value="<?php echo set_value('kode_buku') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Kategori Buku</label>
  <div class="col-md-5">
    <select name="id_kategori" class="form-control">
      <?php foreach($kategori as $kategori) { ?>
      <option value="<?php echo $kategori->id_kategori ?>" >
        <?php echo $kategori->nama_kategori ?>
      </option>
    <?php } ?>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Harga Buku</label>
  <div class="col-md-5">
    <input type="number" name="harga" class="form-control"  placeholder="Harga" value="<?php echo set_value('harga') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Stock Buku</label>
  <div class="col-md-5">
    <input type="number" name="stock" class="form-control"  placeholder="Stock" value="<?php echo set_value('stock') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Berat</label>
  <div class="col-md-5">
    <input type="text" name="berat" class="form-control"  placeholder="Berat" value="<?php echo set_value('berat') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Ukuran</label>
  <div class="col-md-5">
    <input type="text" name="ukuran" class="form-control"  placeholder="Ukuran" value="<?php echo set_value('ukuran') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Keterangan</label>
  <div class="col-md-10">
    <textarea name="keterangan" id="editor" class="form-control" placeholder="Keterangan"><?php echo set_value('keterangan') ?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Keywords (untuk SEO Google)</label>
  <div class="col-md-10">
    <textarea name="keywords" class="form-control" placeholder="Keywords"><?php echo set_value('keywords') ?></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Upload Gambar Buku</label>
  <div class="col-md-10">
    <input type="file" name="gambar" class="form-control" required="required">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Status Buku</label>
  <div class="col-md-10">
    <select name="status_buku" class="form_control">
      <option value="In Stock">In Stock</option>
      <option value="Out of Stock">Out of Stock</option>
      <option value="Stock at Publisher Warehouse">Stock at Publisher Warehouse</option>
      option
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Status Buku</label>
  <div class="col-md-10">
    <select name="sb" class="form_control">
      <option value="Publish">Publish</option>
      <option value="UnPublish">UnPublish</option>
      option
    </select>
  </div>
</div>


<div class="form-group">
  <label class="col-md-2 control-label"></label>
  <div class="col-md-5">
   <button class="btn btn-success " name="submit" type="submit">
   		<i class="fa fa-save"></i> Simpan
   </button>
   <button class="btn btn-success " name="reset" type="reset">
   		<i class="fa fa-times"></i> Reset
   </button>
  </div>
</div>

 <?php echo form_close(); ?>