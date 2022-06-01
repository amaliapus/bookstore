<?php 
// AMBIL DATA MENU DARI KONFIGURASI
$nav_buku			= $this->konfigurasi_model->nav_buku();
$nav_buku_mobile	= $this->konfigurasi_model->nav_buku();
?>

<div class="wrap_header">
	<!-- Logo -->
	<a href="index.html" class="logo">
		<img src="<?php echo base_url('assets/upload/image/'. $site->logo) ?>" alt="<?php echo $site->namaweb ?> | <?php echo $site->tagline ?>">
	</a>

	<!-- Menu -->
	<div class="wrap_menu">
		<nav class="menu">
			<ul class="main_menu">
				<!-- HOME -->
				<li>
					<a href="<?php echo base_url() ?>">Home</a>
				</li>

				<!-- MENU BUKU DAN KATEGORI -->
				<li>
					<a href="<?php echo base_url('buku') ?>">Books </a>
					<ul class="sub_menu">
						<?php foreach($nav_buku as $nav_buku) { ?>
						<li><a href="<?php echo base_url('buku/kategori/' .$nav_buku->slug_kategori) ?>">
							<?php echo $nav_buku->nama_kategori ?>
						</a></li>
					<?php } ?>
					</ul>
				</li>

				<li>
					<a href="product.html">Shop</a>
				</li>

				<li>
					<a href="<?php echo base_url('kontak') ?>">Contact</a>
				</li>
			</ul>
		</nav>
	</div>

	<!-- Header Icon -->
	<div class="header-icons">
		<a href="#" class="header-wrapicon1 dis-block">
			<img src="<?php echo base_url() ?>assets/template/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
		</a>

		<span class="linedivide1"></span>

		<div class="header-wrapicon2">
			<?php
			// Check data belanja ada atau tidak
			$keranjang = $this->cart->contents();

			?>
			<img src="<?php echo base_url() ?>assets/template/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
			<span class="header-icons-noti"><?php echo count($keranjang) ?></span>

			<!-- Header cart noti -->
			<div class="header-cart header-dropdown">
				<ul class="header-cart-wrapitem">

					<?php  
					// Kalau tidak ada data belanja
					if(empty($keranjang)) { 
					?>

					<li class="header-cart-item">
						<p class="alert alert-success">Shopping Cart is Empty</p>
					</li>

					<?php
					 // Kalau ada
					}else{ 
					// Total belanja
						$total_belanja = 'Rp '.number_format($this->cart->total(),'0',',','.');
					// Tampilkan data belanja
						foreach($keranjang as $keranjang) {

					?>

					<li class="header-cart-item">
						<div class="header-cart-item-img">
							<img src="<?php echo base_url() ?>assets/template/images/item-cart-01.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt">
							<a href="#" class="header-cart-item-name">
								<?php echo $keranjang['name'] ?>
							</a>

							<span class="header-cart-item-info">
								<?php echo $keranjang['qty'] ?> x  <?php echo number_format($keranjang['price'],'0',',','.') ?> = Rp <?php echo number_format($keranjang['subtotal'],'0',',','.')
								?>
							</span>
						</div>
					</li>
					<?php  
						} // Tutup foreach keranjang
					} // Tutup if
					?>

				</ul>

				<div class="header-cart-total">
					Total: <?php echo $total_belanja ?>
				</div>

				<div class="header-cart-buttons">
					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?php echo base_url('belanja/keranjang') ?>l" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
							View Cart
						</a>
					</div>

					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?php echo base_url('belanja/checkout') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<!-- Header Mobile -->
<div class="wrap_header_mobile">
<!-- Logo moblie -->
<a href="index.html" class="logo-mobile">
	<img src="<?php echo base_url() ?>assets/template/images/icons/logo.png" alt="IMG-LOGO">
</a>

<!-- Button show menu -->
<div class="btn-show-menu">
	<!-- Header Icon mobile -->
	<div class="header-icons-mobile">
		<a href="#" class="header-wrapicon1 dis-block">
			<img src="<?php echo base_url() ?>assets/template/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
		</a>

		<span class="linedivide2"></span>

		<div class="header-wrapicon2">
			<?php
			// Check data belanja ada atau tidak
			$keranjang = $this->cart->contents();
			?>
			
			<img src="<?php echo base_url() ?>assets/template/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
			<span class="header-icons-noti"><?php echo count($keranjang) ?></span>

			<!-- Header cart noti -->
			<div class="header-cart header-dropdown">
				<ul class="header-cart-wrapitem">

					<?php  
					// Kalau tidak ada data belanja
					if(empty($keranjang)) { 
					?>

					<li class="header-cart-item">
						<p class="alert alert-success">Shopping Cart is Empty</p>
					</li>

					<?php
					 // Kalau ada
					}else{ 
					// Total belanja
						$total_belanja = 'Rp '.number_format($this->cart->total(),'0',',','.');
					// Tampilkan data belanja
						foreach($keranjang as $keranjang) {

					?>

					<li class="header-cart-item">
						<div class="header-cart-item-img">
							<img src="<?php echo base_url() ?>assets/template/images/item-cart-01.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt">
							<a href="#" class="header-cart-item-name">
								<?php echo $keranjang['name'] ?>
							</a>

							<span class="header-cart-item-info">
								<?php echo $keranjang['qty'] ?> x  <?php echo number_format($keranjang['price'],'0',',','.') ?> = Rp <?php echo number_format($keranjang['subtotal'],'0',',','.')
								?>

							</span>
						</div>
					</li>
					<?php  
						} // Tutup foreach keranjang
					} // Tutup if
					?>

				</ul>

				<div class="header-cart-total">
					Total: <?php echo $total_belanja ?>
				</div>

				<div class="header-cart-buttons">
					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?php echo base_url('belanja/keranjang') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
							View Cart
						</a>
					</div>

					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?php echo base_url('belanja/checkout') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
		<span class="hamburger-box">
			<span class="hamburger-inner"></span>
		</span>
	</div>
</div>
</div>

<!-- Menu Mobile -->
<div class="wrap-side-menu" >
<nav class="side-menu">
	<ul class="main-menu">
		<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
			<span class="topbar-child1">
				<?php echo $site->alamat ?>
			</span>
		</li>

		<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
			<div class="topbar-child2-mobile">
				<span class="topbar-email">
					<?php echo $site->email ?>
				</span>

				<div class="topbar-language rs1-select2">
					<select class="selection-1" name="time">
						<option><?php echo $site->telepon ?></option>
						<option><?php echo $site->email ?></option>
					</select>
				</div>
			</div>
		</li>

		<li class="item-topbar-mobile p-l-10">
			<div class="topbar-social-mobile">
				<a href="<?php echo $site->facebook ?>" class="topbar-social-item fa fa-facebook"></a>
				<a href="<?php echo $site->instagram ?>" class="topbar-social-item fa fa-instagram"></a>
			</div>
		</li>

		<!-- MENU MOBILE HOMEPAGE -->
		<li class="item-menu-mobile">
			<a href="<?php echo base_url() ?>">Home</a>
		</li>

		<!-- MENU MOBILE PRODUCT -->
		<li class="item-menu-mobile">
			<a href="<?php echo base_url('buku') ?>">Books </a>
			<ul class="sub-menu">
				<?php foreach($nav_buku_mobile as $nav_buku_mobile) { ?>
					<li><a href="<?php echo base_url('buku/kategori/' .$nav_buku_mobile->slug_kategori) ?>">
						<?php echo $nav_buku_mobile->nama_kategori ?>
					</a></li>
				<?php } ?>
			</ul>
			<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
		</li>

		<li class="item-menu-mobile">
			<a href="product.html">Sale</a>
		</li>

		<li class="item-menu-mobile">
			<a href="about.html">About</a>
		</li>

		<li class="item-menu-mobile">
			<a href="<?php echo base_url('kontak') ?>">Contact</a>
		</li>
	</ul>
</nav>
</div>
</header>