

				<section role="main" class="content-body">



					<!-- start: page -->


							<div class="row">
							<div class="col-md-1 col-lg-1">


							</div>


              <div class="col-md-10 col-lg-10">

							<div class="tabs">

								<div class="tab-content">

									<div id="edit" class="tab-pane active">

										<form class="form-horizontal" action="<?php echo base_url('/slideshow/edit/'.$rs['id']); ?>" method="post" enctype="multipart/form-data">
                   

											<h4 class="mb-xlg">แก้ไข slideshows</h4>

											<fieldset>

                        <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">ชื่อ slideshow*</label>
													<div class="col-md-8">
														<input type="text" class="form-control" name="name" value="<?php echo $rs['name'] ?>" >
														</div>
												</div>


                        <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">ข้อความ 1*</label>
													<div class="col-md-8">
														<input type="text" class="form-control" name="first_text" value="<?php echo $rs['title'] ?>" >
														</div>
												</div>

                        <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">ข้อความ 2*</label>
													<div class="col-md-8">
														<input type="text" class="form-control" name="secend_text" value="<?php echo $rs['sub_title'] ?>" >
														</div>
												</div>


												<div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">url ปลายทาง*</label>
													<div class="col-md-8">
														<input type="text" class="form-control" name="url_web" value="<?php echo $rs['url_web'] ?>" >
														</div>
												</div>



                     


                                    <div class="form-group">
            								                        <label for="name" class="col-sm-3 control-label">รูปภาพ</label>
            								                        <div class="col-sm-8">
            								                            <img src="<?php echo base_url('/assets/admin/slide/'.$rs['image']); ?>" class="img-responsive" height="250">
            								                        </div>
            								                    </div>


                                    <div class="form-group">
              												<label class="col-md-3 control-label">BG Image Upload</label>
              												<div class="col-md-9">
              													<div class="fileupload fileupload-new" data-provides="fileupload">
              														<div class="input-append">
              															<div class="uneditable-input">
              																<i class="fa fa-file fileupload-exists"></i>
              																<span class="fileupload-preview"></span>
              															</div>
              															<span class="btn btn-default btn-file">
              																<span class="fileupload-exists">Change</span>
              																<span class="fileupload-new">Select file</span>
              																<input type="file" name="file_name">
              															</span>
              															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
              														</div>
              													</div>
              												</div>
              											</div>



											</fieldset>



											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
                            <input type="submit" name="slideSubmit" class="btn btn-primary" value="แก้ไขข้อมูล"/>
														<button type="reset" class="btn btn-default">ยกเลิก</button>
													</div>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
						</div>











						</div>

</section>

