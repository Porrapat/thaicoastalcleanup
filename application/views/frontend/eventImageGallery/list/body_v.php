<div class="row">
	<div class="row">
		<div class="col-xs-12">

<!-- Search -->
	<?php echo form_open(base_url("iccCard"), array("id" => "formSearch")); ?>
	<div class="panel">
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12 overflow-xy">
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="row">
					<!-- Daterange Section -->
						<div class="col-xs-6 col-md-6 col-lg-6 text-left">
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-primary disabled" type="button">ช่วงเวลา : </button>
								</span>
								<div id="daterange" class="form-control">
									<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
									<span></span> <b class="caret"></b>
								</div>
							</div>
						</div>
					<!-- Province Section -->
						<div class="col-xs-6 col-md-6 col-lg-6">
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-primary disabled" type="button">จังหวัด : </button>
								</span>
								<select class="form-control" id="provinceCode">
									<option value="0" selected>เลือกทั้งหมด...</option>
									<?php
									foreach($dsProvince as $row) {
										echo '<option value='.$row['ProvinceCode'].'>'.$row['ProvinceName'].'</option>';
									}
									?>
								</select>
							</div>
						</div>
					<!-- Department Section -->
						<div class="col-xs-6 col-md-6 col-lg-6">
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-primary disabled" type="button">ชื่อหน่วยงาน : </button>
								</span>
								<select class="form-control" id="orgId">
									<option value="0" selected>เลือกทั้งหมด...</option>
									<?php
									foreach($dsOrg as $row) {
										echo '<option value='.$row['id'].'>'.$row['department'].'</option>';
									}
									?>
								</select>
							</div>
						</div>
					<!-- Project Name Section -->
						<div class="col-xs-6 col-md-6 col-lg-6">
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-primary disabled" type="button">ชื่อโครงการ : </button>
								</span>
								<select class="form-control" id="projectName">
									<option value="0" selected>เลือกทั้งหมด...</option>
									<?php
									foreach($dsProjectName as $row) {
										echo '<option value="'.$row['id'].'">'.$row['Project_Name'].'</option>';
									}
									?>
								</select>
							</div>
						</div>
					<!-- Amphur Section -->
						<div class="col-xs-5 col-md-5 col-lg-5">
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-primary disabled" type="button">อำเภอ : </button>
								</span>
								<select class="form-control" id="amphurCode">
									<option value="0" selected>เลือกทั้งหมด...</option>
									<?php
									foreach($dsAmphur as $row) {
										echo '<option value='.$row['AmphurCode'].'>'.$row['AmphurName'].'</option>';
									}
									?>
								</select>
							</div>
						</div>
					<!-- Button Section -->
						<div class="col-xs-1 col-md-1 col-lg-1 pull-left">
							<button type="button" class="btn btn-primary pull-right" id="search">Go</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<?php echo form_close(); ?><!-- Close form search -->
<!-- End Search -->

<!-- List panel -->
	<section class="panel">
		<header class="panel-heading">
			<div class="panel-actions">
				<a href="#"  class="panel-action panel-action-toggle" data-panel-toggle></a>
			</div>
				<h2 class="panel-title">แบบบันทึกข้อมูลไอซีซี </h2>
		</header>

		<div class="panel-body">
			<?php echo form_open(base_url("iccCard/addNew"), array("id" => "formAddNew")); ?>
			<a class="btn btn-primary " href="#" role="button"
			onclick="javascript:document.getElementById('formAddNew').submit()">
				<i class="fa fa-plus"></i> เพิ่มแบบข้อมูลใหม่
			</a>
			<?php echo form_close(); ?><!-- Close form choose -->
			<br><br>
			<input type="hidden" name="iccCardId" value="0"/>
		<!-- Tabel view display -->
			<table class="table table-striped" id="iccCard">
				<thead>
					<tr>
						<th class="text-center" width="40"></th>
						<th class="text-center">ชื่อโครงการ</th>
						<th class="text-center">วันที่ทำกิจกรรม</th>
						<th class="text-center">อำเภอ</th>
						<th class="text-center">จังหวัด</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		<!-- End Tabel view display -->
			<div class="pagination" id="paginationLinks"> <p><?php echo $paginationLinks; ?></p> </div>
		</div>
	</section>
<!-- List panel -->

		</div>
	</div>
</div>