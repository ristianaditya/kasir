<div id="sidebar-nav" class="sidebar ">
	<div class="sidebar-sticky">
		<nav class="sidebar">
			<ul class="nav">
				<li><a href="<?= base_url('index.php/owner');?>" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="<?= base_url('index.php/owner/laporan')?>" class=""><i class="fas fa-book"></i> <span>Laporan</span></a></li>
			</ul>
		</nav>
	</div>
</div>
<!-- MAIN -->
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<!----------INDEX---------->
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3">
								<div class="metric">
									<span class="icon"><i class="fa fa-download"></i></span>
									<p>
										<span class="number"><?= $user ?></span>
										<span class="title">Total User</span>
									</p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="metric">
									<span class="icon"><i class="fa fa-shopping-bag"></i></span>
									<p>
										<span class="number"><?= $masakan ?></span>
										<span class="title">Total Menu</span>
									</p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="metric">
									<span class="icon"><i class="fa fa-eye"></i></span>
									<p>
										<span class="number"><?= $transaksi ?></span>
										<span class="title">Total Transaksi</span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix">
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2019. MNAC Copyright.</p>
			</div>
		</footer>
	</div>
</div>


