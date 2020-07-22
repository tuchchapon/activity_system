<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="../index.php" class="brand-link">
		<img src="<?= IMAGES ?>/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">ระบบจัดการกิจกรรม</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= IMAGES ?>/avatar.png" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="" class="d-block"><?php echo $_SESSION["admin_id"]?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
          	with font-awesome or any other icon font library -->
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-calendar-week"></i>
						<p>
							การจัดการกิจกรรม
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= URL ?>activity/activitymanage.php" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>จัดการกิจกรรม</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= URL ?>activity/at_manage.php" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>จัดการประเภทกิจกรรม</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-newspaper"></i>
						<p>
							การจัดการข่าวสาร
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= URL ?>news/newsmanage.php" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>จัดการข่าวสาร</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= URL ?>news/nt_manage.php" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>จัดการประเภทข่าวสาร</p>
							</a>
						</li>
					</ul>
				</li>

				<?php 
				if($_SESSION["Status"] == 'admin'){
				?>
				<li class="nav-header">ข้อมูลสาขา</li>
				<li class="nav-item">
					<a href="<?= URL ?>webinfo/info.php" class="nav-link">
						<i class="nav-icon fas fa-print"></i>
						<p>จัดการข้อมูลสาขาวิชา</p>
					</a>
				</li>
				<?php } ?>

				<li class="nav-header">การจัดการผู้ใช้งาน</li>
				<li class="nav-item">
					<a href="<?= URL ?>users/stu_manage.php" class="nav-link">
						<i class="nav-icon fas fa-users-cog"></i>
						<p>จัดการนักศึกษา

						</p>
					</a>
				</li>
		<?php	if($_SESSION["Status"] == 'admin'){
			?>
				<li class="nav-item">
					<a href="<?= URL ?>users/admin_manage.php" class="nav-link">
						<i class="nav-icon fas fa-users-cog"></i>
						<p>จัดการผู้ดูแลระบบ
						</p>
					</a>
				</li><?php
			}
			?>
				<li class="nav-header">รายงาน</li>
				<li class="nav-item">
					<a href="<?= URL ?>activity/activity_report.php" class="nav-link">
						<i class="nav-icon fas fa-print"></i>
						<p>รายงานการเข้าร่วมกิจกรรม

						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
<!-- <span class="right badge badge-danger">New</span> -->