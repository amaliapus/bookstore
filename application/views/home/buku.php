<!-- New Product -->
<section class="newproduct bgwhite p-t-45 p-b-105">
<div class="container">
<div class="sec-title p-b-60">
<h3 class="m-text5 t-center">
	Newest Books
</h3>
</div>

<!-- Slide2 -->
<div class="wrap-slick2">
<div class="slick2">
	<?php foreach($buku as $buku){ ?>
	<div class="item-slick2 p-l-25 p-r-25">
		<!-- Block2 -->
		<div class="block2">
			<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
				<img src="<?php echo base_url('assets/upload/image/' .$buku->gambar) ?>" alt="<?php echo $buku->judul_buku ?>" >

				<div class="block2-overlay trans-0-4">
					<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
						<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
						<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
					</a>
					
					<div class="block2-btn-addcart w-size1 trans-0-4">
						<!-- Button Belanja/Shopping Cart-->
						<a href="<?php echo base_url('buku/add/' .$buku->id_buku) ?>" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
							Add to Cart
						</a>
					</div>
				</div>
			</div>

			<div class="block2-txt p-t-20">
				<a href="<?php echo base_url('buku/detail/' .$buku->slug_buku) ?>" class="block2-name dis-block s-text3 p-b-5">
					<?php echo $buku->judul_buku ?>
				</a>

				<span class="block2-price m-text6 p-r-5">
					IDR <?php echo number_format($buku->harga,'0',',','.') ?>
				</span>
			</div>
		</div>
	</div>
<?php }?>
	
</div>
</div>

</div>
</section>
