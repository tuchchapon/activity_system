<?php
// HEADER
include("../layouts/header.php");

if (!empty($_GET["id"])) {
	$sql->field = "n.*, nt.news_type_name";
	$sql->table = "news n LEFT JOIN news_type nt ON n.news_type_id=nt.news_type_id";
	$sql->field = "*";
	$sql->condition = "WHERE news_id={$_GET["id"]}";
	$news = mysqli_fetch_assoc($sql->select());
} else {
	header("location:" . URL . "news/newsmanage.php");
}

//NAVBAR
include("../layouts/navbar.php");

//MENU
include("../layouts/menu.php");
// SET TABLE //
?>
<!-- Content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="clearfix">
						<h4 class="m-0 text-dark float-left">จัดการรูปภาพของกิจกรรม </h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<?php

			$sql->table = "news_pic";
			$sql->condition = "WHERE news_id={$_GET["id"]}";
			$query = $sql->select();
			?>
			<div class="card">
				<label class="ml-3 mt-3"><i class="fas fa-snowboarding"></i> ข้อมูลกิจกรรม</label>
				<ul>
					<li><span style="font-weight: bold;">หัวข้อกิจกรรม :</span> <?= $news["news_title"] ?></li>
					<li><span style="font-weight: bold;">ประเภท :</span> <?= $news["news_type_name"] ?></li>
				</ul>
			</div>

			<div class="card">
				<div class="card-body">

					<form action="upload_n_pic.php" method="post" enctype="multipart/form-data">
						Select image to upload:
						<input type="file" name="image[]" id="image" multiple accept="image/*">
						<!-- เลือกรูปภาพเพิ่มเติม -->
						<!-- <input id="activitiespic" type="file" name="fileToUpload" multiple  accept="image/*">   -->
						<button type="submit" class="btn btn-success float-right">Upload</button>
						<input type="hidden" name="news_id" value="<?= $_GET["id"] ?>">
					</form>
					ทั้งหมด <?= $num = mysqli_num_rows($query); ?> ภาพ <small>เลือกและกดปุ่มลบ เพื่อลบรายการที่ต้องการ</small>
				</div>
			</div>
			<?php if ($num > 0) { ?>
				<div class="card">
					<form action="<?= URL ?>news/del_n_pic.php" method="POST">
						<div class="card-body">
							<div class="row">
								<?php
								while ($row = mysqli_fetch_assoc($query)) {

								?>
									<div class="col-md-3">
										<div class="card m-1 p-2">
											<div class="input-group">
												<span class="input-group-addon">
													<input type="checkbox" name="pic_id[]" value="<?= $row["pic_id"] ?>" class="filled-in" id="ig_checkbox<?= $row["pic_id"] ?>">
													<label for="ig_checkbox<?= $row["pic_id"] ?>">
														<img src="../img/<?= $row["news_pic_file"]; ?>" class="galleryImg" style="width:100%;">
													</label>

												</span>
											</div>
											<a class="zoomit" href="../img/<?= $row["news_pic_file"]; ?>"><i class="material-icons"></i></a>
										</div>
									</div>
								<?php
								}
								?>
							</div>
							<input type="hidden" name="id" value="<?= $news["news_id"]; ?>">
							<button type="submit" class="btn btn-danger float-right"><i class="fa fa-trash">ลบรายการที่เลือก</i></button>
						</div>
					</form>
				</div>
			<?php } ?>

		</div>
	</section>
</div>
<!-- End Content -->
<?php
//FOOTER
include("../layouts/footer.php");
?>