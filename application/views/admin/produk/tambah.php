<?php 
// Error upload
if(isset($error)) {
  echo '<p class="alert alert-warning">';
  echo $error;
  echo '</p>';
}

// Notifikasi error
echo validation_errors('<div class="alert alert-warning">', '</div>');

// Form open
echo form_open_multipart(base_url('admin/produk/tambah'), ' class="form-horizontal"');
 ?>

<div class="form-group">
  <label class="col-md-2 control-label">Nama Produk</label>
  <div class="col-md-5">
    <input type="text" name="nama_produk" class="form-control"  placeholder="Nama Produk" value="<?php echo set_value('nama_produk') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Kode Produk</label>
  <div class="col-md-5">
    <input type="text" name="kode_produk" class="form-control"  placeholder="Kode Produk" value="<?php echo set_value('kode_produk') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Kategori Produk</label>
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
  <label class="col-md-2 control-label">Harga Produk</label>
  <div class="col-md-5">
    <input type="number" name="harga" class="form-control"  placeholder="Harga" value="<?php echo set_value('harga') ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Stock Produk</label>
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
  <label class="col-md-2 control-label">Upload Gambar Produk</label>
  <div class="col-md-10">
    <input type="file" name="gambar" class="form-control" required="required">
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Status Produk</label>
  <div class="col-md-10">
    <select name="status_produk" class="form_control">
      <option value="InStock">In Stock</option>
      <option value="OutofStock">Out of Stock</option>
      <option value="StockatPublisherWarehouse">Stock at Publisher Warehouse</option>
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