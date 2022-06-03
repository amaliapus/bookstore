<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?php echo base_url() ?>assets/upload/image/home/imageee.jpg);">
<h2 class="l-text2 t-center">
	Book
</h2>
<p class="m-text13 t-center">
	New Arrivals Summer Collection 2022
</p>
</section>


<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
			<div class="leftbar p-r-20 p-r-0-sm">
				<!--  -->
				<h4 class="m-text14 p-b-7">
					Categories
				</h4>

				<ul class="p-b-54">
					<?php foreach($listing_kategori as $listing_kategori) { ?>
					<li class="p-t-4">
						<a href="<?php echo base_url('buku/kategori/'.$listing_kategori->slug_kategori) ?>" class="s-text13 active1">
							<?php echo $listing_kategori->nama_kategori; ?>
						</a>
					</li>
				<?php } ?>
					
				</ul>
			</div>
		</div>

		<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
			<!--  -->
			<div class="flex-sb-m flex-w p-b-35">
				<div class="flex-w">
					<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
						<select class="selection-2" name="sorting">
							<option>Default Sorting</option>
							<option>Popularity</option>
							<option>Price: low to high</option>
							<option>Price: high to low</option>
						</select>
					</div>
				</div>

				<span class="s-text8 p-t-5 p-b-5">
					Showing 1–12 of 16 results
				</span>
			</div>

			<!-- Product -->
			<div class="row">
				<?php foreach($buku as $buku) { ?>
				<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
							<img src="<?php echo base_url('assets/upload/image/'.$buku->gambar) ?>" alt="<?php echo $buku->judul_buku ?>">

							<div class="block2-overlay trans-0-4">
								<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
									<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
									<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
								</a>

								<div class="block2-btn-addcart w-size1 trans-0-4">
									<!-- Button -->
									<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
										Add to Cart
									</button>
								</div>
							</div>
						</div>

						<div class="block2-txt p-t-20">
							<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
								<?php echo $buku->judul_buku ?>
							</a>

							<span class="block2-price m-text6 p-r-5">
								IDR <?php echo number_format($buku->harga,'0',',','.') ?>
							</span>
						</div>
					</div>
				</div>
			<?php } ?>

		</div>


			<!-- Pagination -->
			<div class="pagination flex-m flex-w p-t-26">
				<?php echo $pagin; ?>
			</div>
		</div>
	</div>
</div>
</section>