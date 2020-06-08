<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<!-- Notifications Dropdown Menu -->
		<li class="nav-item dropdown">
			<a class="btn btn-primary" href="#">Profile</a>
			<a class="btn btn-danger" href="<?= URL ?>logout.php" onclick="return confirm('คุณต้องการออกจากระบบใช่หรือไม่ ?');">Logout</a>
		</li>
		<!-- <li class="nav-item">
			<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
				<i class="fas fa-th-large"></i>
			</a>
		</li> -->
	</ul>
</nav>