<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Menu List</title>
	<link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets\bootstrap4\css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets\custom.css')?>">
	<link rel="stylesheet" href="<?= base_url('assets\number.css')?>">
	<style>
		/*  #######  HTML Layout  ##  */

		body, html{
			margin: 0;
			padding: 0;
			width: 100vw;
			max-width: 100vw;
			min-width: 100vw;
			min-height: 200vh;

			font-family: "Trebuchet MS";
		}

		h1,h2,h3,h4,h5,h6,p{
			margin: 0;
			padding: 0;
		}
		a, a:hover{
			text-decoration: none;
			color: #000;
		}
		.bg{
			background-color: rgba(0,0,0,0.2);
		}
		.test{
			width: 100vw;
			height: 200vh;
			background: linear-gradient(#e66465, #9198e5);
		}


		/*	Navbar	#########################################  */

		/*  ###  Navbar Layout  */

		/*  Placeholder  */
		.navbar-placehorder{
			width: 100vw;
			height: 70px;
			z-index: -1000;
		}
		@media screen and (max-width: 768px){
			.navbar-placehorder{
				height: 55px;
			}	
		}

		/* Navbar Container  */
		.navbar-ctn{
			position: fixed;
			z-index: 100;
			height: 70px;
			background-color: #fff;
			display: flex;
			box-shadow: 0 6px 10px rgb(0 0 0 / 10%);
			width: 100vw;
			max-width: 100vw;
			min-width: 100vw;
		}
		@media screen and (max-width: 768px){
			.navbar-ctn{
				height: 55px;
				display: block;
			}
		}

		/*  ###  Navbar Elements  */

		/* Navbar Link Containers  */
		.navbar-links-ctn{
			width: 100vw;
		}
		@media screen and (max-width: 768px){
			.navbar-links-ctn{
				display: none;
			}	
		}

		/* Link Containers  */
		.navlink-ctn{
			height: 100%;
			display: flex;
			align-items: center;
			background-color: #fefefe
		}

		.navlink-ctn-left{
			float: left;
		}
		.navlink-ctn-right{
			float: right;
		}
		.navlink-ctn-right{
			float: right;
		}
		@media screen and (max-width: 768px){
			.navlink-ctn-left, 
			.navlink-ctn-right{
				float: none;
			}
		}

		/* Links  */
		.navlink{
			margin: 12px 20px;
		}

		/*  ###  Navbar Burger  */

		.nav-logo-burger{
			justify-content: space-between;
		}
		.nav-burger{
			margin-right: 14px;
			cursor: pointer;
		}
		@media screen and (min-width: 768px){
			.nav-burger{
				display: none;
			}
		}
		.navbar-mobile-active{
			display: block;
		}

		/*  #########  Navbar Dropdown  ##  */

		/* Dropdown Containers  */
		.ddown-ctn{
			display: block;
		}

		/* Dropdown Button  */
		.ddown-btn{
			height: 100%;

			display: flex;
			justify-content: space-between;
			align-items: center;

			cursor: pointer;
		}
		.ddown-list{
			width: auto;
			display: none;
			background-color: #fefefe;
			box-shadow: 0 6px 10px rgba(0,0,0,0.1) 
		}

		/*  Dropdown elements  */
		.ddown-list .ddown-btn{
			max-height: 40px;
		}

		/*  Parent Dropdown elements  */
		.ddown-parent .ddown-list .navlink-ctn{	
			background-color: #eeeeee;
		}

		/*  Child Dropdown elements  */
		.ddown-child .ddown-list .navlink-ctn{	
			background-color: #ddd;
		}
		.ddown-child .ddown-list .navlink-ctn{
				padding-left: 20px;
		}

		.ddown-btn .navlink{
			margin-right: 5px;
		}

		/* Dropdown icons  */
		.ddown-btn img{
			margin-right: 10px;
		}

		/* Animation / JS */

		.ddown-active{
			display: flex;
			flex-direction: column;
		}

		.appear-anim{
			animation: appear 0.5s;
		}

		@keyframes appear{
			from{
				opacity:0;
			}
			to{
			opacity:1;
			}
		}
		.img-thumbnail {
			padding: 0.25rem;
			background-color: #fff;
			border: 1px solid #dee2e6;
			border-radius: 0.25rem;
			width: 100%;
			height: 30vh;
			/* height: auto; */
		}
	</style>
</head>
<body style="overflow-x: hidden; background-color: #cbd2d9;">

	<!-- navbar baru -->
	<nav class=" navbar-ctn">
		<div class=" navlink-ctn navlink-ctn-left nav-logo-burger">
			<a href="" class="navlink">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fas fa-utensils fa-stack-1x fa-inverse"></i>
				</span>
			</a> <font style="font-weight: bolder; font-family: unset; margin-left: -20px">Restaurant</font>
			<div class="nav-burger">
				<img src="https://drive.google.com/uc?id=1ar5dqwRM_3lUWMJUVOzL4BUEE31kkvH6" height="28" width="28">
			</div>
		</div>
		<div class="navbar-links-ctn">
			<div href="" class=" navlink-ctn navlink-ctn-right">
				<?php
					$cart= $this->cart->contents();

					if(empty($cart)) {
						?>
						<a hidden></a>
						<?php
					}
					else
					{
						$grand_total = 0;
						foreach ($cart as $item):
							$grand_total = $grand_total + $item['subtotal'];
							?>
						<?php endforeach; ?>
							<p class="navlink">Order Total: Rp <?php echo number_format($grand_total, 0,",","."); ?></p>
						<?php	
					}
				?>
			</div>
			<div class="navlink-ctn navlink-ctn-right" onclick="add_person()" style="cursor: pointer;">
				<p class="navlink">Cart</p>
			</div>
			<div class=" navlink-ctn navlink-ctn-right ddown-ctn ddown-parent">
				<div class="ddown-btn">
					<p class="navlink">Kategori</p>
					<img src="https://drive.google.com/uc?id=1OMvDMryIz3gqi_x2s_T4zeJUqCddHgFF" height="22" width="22">
				</div>
				<div class="navbar-links-ctn ddown-list">
					<?php
						foreach ($kategori as $row) 
						{ ?>
							<a href="<?php echo base_url()?>index.php/pelanggan/index/<?php echo $row['id'];?>" class=" navlink-ctn navlink-ctn-left">
								<p class="navlink"><?php echo $row['nama_kategori'];?></p>
							</a>
					<?php
						}
					?>
				</div>
			</div>
		</div>

	</nav>
	<!-- navbar baru -->

	<br>
	<br>
	<br>
	<br>
	<div class="main">
		<div class="col-lg-12">
			<div class="row">
				<!-- MAIN CONTENT -->
				<?php
				foreach ($produk as $row) {
					?>
					<div class="col-lg-3 col-md-5 mb-3">
						<div class="kotak">
							<form method="post" action="<?php echo base_url();?>index.php/pelanggan/tambah" method="post" accept-charset="utf-8">
								<img class="img-thumbnail" src="<?php echo base_url() . 'assets/pelanggan/'.$row['gambar']; ?>"/></img>
								<div class="card-body">
									<h4 class="card-title">
										<?php echo $row['nama_masakan'];?>
									</h4>
									<h5>Rp. <?php echo number_format($row['harga'],0,",",".");?></h5>
									<p class="card-text"><?php echo $row['deskripsi'];?></p>
								</div>
								<div class="card-footer">
									<input type="hidden" name="id" value="<?php echo $row['id_masakan']; ?>" />
									<input type="hidden" name="nama" value="<?php echo $row['nama_masakan']; ?>" />
									<input type="hidden" name="harga" value="<?php echo $row['harga']; ?>" />
									<input type="hidden" name="gambar" value="<?php echo $row['gambar']; ?>" />
									<center><div class="number-input">
										<button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
										<input class="quantity" min="0" value="0" name="qty" type="number">
										<button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
									</div>

								</div>
								<button type="submit" class="btn btn-lg btn-success btn-block"><i class="fas fa-shopping-cart">Add to Cart</i></button>
							</form>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</body>

<!-- Modal -->
<div class="modal fad" id="modal_form" role="dialog">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h2><?php echo $this->session->userdata("user_nama");?></h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form" style="width: 100%; overflow-x:auto">
				<form action="<?php echo base_url('index.php/admin/hakplus')?>" method="post" id="form" class="form-horizontal">
					<h3>Daftar Belanja</h3>
					<form action="<?php echo base_url()?>pelanggan/ubah_cart" method="post" name="frmShopping" id="frmShopping" class="form-horizontal" enctype="multipart/form-data">
						<?php
						if ($cart = $this->cart->contents())
						{
							?>
							<table class="table" >
								<tr id= "main_heading">
									<td width="2%">No</td>
									<td width="10%">Gambar</td>
									<td width="33%">Item</td>
									<td width="15%">Harga</td>
									<td width="10%">Qty</td>
									<td width="20%">Jumlah</td>
									<td width="10%">Hapus</td>
								</tr>
								<?php
								$grand_total = 0;
								$i = 1;

								foreach ($cart as $item):
									$grand_total = $grand_total + $item['subtotal'];
									?>
									<input type="hidden" name="cart[<?php echo $item['id'];?>][id]" value="<?php echo $item['id'];?>" />
									<input type="hidden" name="cart[<?php echo $item['id'];?>][rowid]" value="<?php echo $item['rowid'];?>" />
									<input type="hidden" name="cart[<?php echo $item['id'];?>][name]" value="<?php echo $item['name'];?>" />
									<input type="hidden" name="cart[<?php echo $item['id'];?>][price]" value="<?php echo $item['price'];?>" />
									<input type="hidden" name="cart[<?php echo $item['id'];?>][gambar]" value="<?php echo $item['gambar'];?>" />
									<input type="hidden" name="cart[<?php echo $item['id'];?>][qty]" value="<?php echo $item['qty'];?>" />
									<tr>
										<td><?php echo $i++; ?></td>
										<td><img class="img-responsive" src="<?php echo base_url() . 'assets/pelanggan/'.$item['gambar']; ?>" width="100%"/></td>
										<td><?php echo $item['name']; ?></td>
										<td><?php echo number_format($item['price'], 0,",","."); ?></td>
										<td><input type="text" class="form-control input-sm" name="cart[<?php echo $item['id'];?>][qty]" value="<?php echo $item['qty'];?>" disabled/></td>
										<td><?php echo number_format($item['subtotal'], 0,",",".") ?></td>
										<td><a href="<?php echo base_url()?>index.php/pelanggan/hapus/<?php echo $item['rowid'];?>" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a></td>
									<?php endforeach; ?>
								</tr>
								<tr>
									<td colspan="3"><b>Order Total: Rp <?php echo number_format($grand_total, 0,",","."); ?></b></td>
									<td colspan="4" align="right">
										<a href="<?php echo base_url()?>index.php/pelanggan/hapus/all" class='btn btn-sm btn-danger'>Kosongkan Cart</a>
										<a href="<?php echo base_url()?>index.php/pelanggan/proses_order" class ='btn btn-sm btn-primary'>Proses Order</a>
									</td>
								</tr>
							</table>
							<?php
						}
						else
						{
							echo "<h3>Keranjang Belanja masih kosong</h3>";	
						}	
						?>
					</form>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
	<!-- JAVASCRIPT -->
	<script src="<?= base_url('assets/dashboard/vendor/jquery/jquery.min.js')?>"></script>
	<script src="<?= base_url('assets\bootstrap4\js/bootstrap.min.js')?>"></script>
	<script src="<?= base_url('assets/bootstrap4/js/popper.js')?>"></script>
	
	<?php 
	if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
		echo '<script>alert("Pesanan Berhasil !");</script>';
	}
	$_SESSION['pesan'] = '';
	?>

	<script type="text/javascript">
		function add_person(){
			save_method = 'add';
			$('#form')[0].reset(); // reset form on modals
			$('.form-group').removeClass('has-error'); // clear error class
			$('.help-block').empty(); // clear error string
			$('#modal_form').modal('show'); // show bootstrap modal
			$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
		}

		$('form').on('click', 'button:not([type="submit"])', function(e){
			e.preventDefault();
		})


		//script baru
		//	Navbar burger button

	const burgerBtn = document.querySelector('.nav-burger');
	const ddownCtn = document.querySelector('.navbar-links-ctn');

	burgerBtn.addEventListener('click', function() {
		ddownCtn.classList.toggle("navbar-mobile-active");
	});


//	Navbar Dropdown	

	const ddownCtns = document.querySelectorAll('.ddown-ctn');

	for (var i = 0; i < ddownCtns.length; i++) {

	  function openDdown() {
	    this.children[1].classList.add('ddown-active');
	    this.children[1].classList.add('appear-anim');
	  }
	  function closeDdown() {
	    this.children[1].classList.remove('ddown-active');
	    this.children[1].classList.remove('appear-anim');
	  }
	  function navbarDdown() {
	    this.parentNode.children[1].classList.toggle('ddown-active');
	    this.parentNode.children[1].classList.toggle('appear-anim');
	  }

	  //	Mobile support
	  ddownCtns[i].addEventListener('mouseenter', openDdown);
	  ddownCtns[i].addEventListener('mouseleave', closeDdown);

	  //	Mobile support	
	  var ddownBtn = ddownCtns[i].querySelector('.ddown-btn');
	  ddownBtn.addEventListener('click', navbarDdown);
	}
</script>
</html>