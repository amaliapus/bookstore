<?php
// Notifikasi eror
echo validation_errors('<div class="alert alert-warning">','</div>');

// Form open
echo form_open(base_url('admin/buku/edit/' .$buku->id_buku),' class="form-horizontal"');
?>

<div class="form-group">
   <label class="col-md-2 control-label">Judul Buku</label>
         <div class="col-md-5">
         <input type="text" name="judul_buku" class="form-control" placeholder="Judul Buku" value="<?php echo $buku->judul_buku ?>" required>
      </div>
 </div>

 <div class="form-group">
   <label class="col-md-2 control-label">Penulis</label>
         <div class="col-md-5">
         <input type="text" name="penulis" class="form-control" placeholder="Penulis" value="<?php echo $buku->penulis ?>" required>
      </div>
 </div>

 <div class="form-group">
   <label class="col-md-2 control-label">Penerbit</label>
         <div class="col-md-5">
         <input type="text" name="penerbit" class="form-control" placeholder="Penerbit" value="<?php echo $buku->penerbit ?>" required>
      </div>
 </div>

<div class="form-group">
   <label class="col-md-2 control-label">Stock</label>
         <div class="col-md-5">
         <input type="number" name="stock" class="form-control" placeholder="Stock" value="<?php echo $buku->stock ?>" required>
      </div>
 </div>

 <div class="form-group">
   <label class="col-md-2 control-label">Status (UnStock, OutofStock, StockatPublisherWarehouse)</label>
         <div class="col-md-5">
         <input type="text" name="status_buku" class="form-control" placeholder="Status" value="<?php echo $buku->status_buku ?>" required>
      </div>
 </div>

<!--   <div class="form-group">
   <label class="col-md-2 control-label">Kategori</label>
         <div class="col-md-5">
         <select name="akses_level" class="form-control">
            <option values="Admin">Admin</option>
            <option values="Buku">Buku <?php if($buku->akses_level=="Buku") { echo "selected"; } ?>>Buku</option>
         </select>
      </div>
 </div> -->

<div class="form-group">
   <label class="col-md-2 control-label">Kategori</label>
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
  <label class="col-md-2 control-label"></label>
      <div class="col-md-5">
         <button class="btn btn-success " name="submit" type="submit">
            <i class="fa fa-save"></i>  Simpan
         </button>
         <button class="btn btn-info " name="reset" type="reset">
            <i class="fa fa-times"></i> Reset
         </button>
      </div>
 </div>


 <?php echo form_close(); ?>