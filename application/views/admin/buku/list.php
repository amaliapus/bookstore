<p>
	<a href="<?php echo base_url('admin/buku/tambah') ?>" class="btn btn-success ">
		<i class="fa fa-plus"></i> Tambah Baru
	</a>
</p>

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
			<th>PENULIS</th>
			<th>PENERBIT</th>
			<th>KATEGORI</th>
			<th>HARGA</th>
			<th>STOCK</th>
			<th>STATUS</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; foreach($buku as $buku){ ?>
	<tr>
		<td><?php echo $no ?></td>
		<td>
			<img src="<?php echo base_url('assets/upload/image/' .$buku->gambar) ?>" class="img img-responsive img-thumbnail" width="60">
		</td>
		<td><?php echo $buku->judul_buku ?></td>
		<td><?php echo $buku->penulis ?></td>
		<td><?php echo $buku->penerbit ?></td>
		<td><?php echo $buku->nama_kategori ?></td>
		<td><?php echo number_format($buku->harga, '0',',','.') ?></td>
		<td><?php echo $buku->stock ?></td>
		<td><?php echo $buku->status_buku ?></td>
		<td>
			<a href="<?php echo base_url('admin/buku/gambar/'.$buku->id_buku) ?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i>Gambar</a>

			<a href="<?php echo base_url('admin/buku/edit/'.$buku->id_buku) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i>Edit</a>

			<?php include('delete.php') ?>
		</td>
	</tr>
		<?php $no++; } ?>
	</tbody>
</table>