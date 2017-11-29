

<style>
.note-editor.note-frame .note-editing-area .note-editable {
    padding-left: 50px;
    padding-right: 50px;
}
</style>

        <section role="main" class="content-body">

          <!-- start: page -->

<style>
.fileupload .uneditable-input .fa {
    position: absolute;
    margin-top: 4px;
    /* top: 12px; */
}
.help-block {
    font-size: 12px;
    color: #ef0808;
}
.file-input  {

}
.btn-file{

}
</style>

           <div class="row">
              <div class="row">
                <div class="col-xs-1">
                </div>
              <div class="col-xs-10">

            <section class="panel">
              <header class="panel-heading">
                <div class="panel-actions">
                  <a href="#"  class="panel-action panel-action-toggle" data-panel-toggle></a>

                </div>

                <h2 class="panel-title">แก้ไขเนื้อหาใหม่</h2>
              </header>
              <div class="panel-body">

              <form action="<?php echo base_url('/blog/edit/'.$rs['id']); ?>" id="form" method="post" enctype="multipart/form-data">


                <div class="form-group">
                  <label for="exampleInputEmail1">ชื่อ บทความ</label>
                  <input type="text" id="Title_a" class="form-control" name="Title_a" placeholder="ใส่หัวข้อบทความ"  value="<?php echo $rs['Title_a'] ?>" >
                  <?php echo form_error('Title_a','<span class="help-block"><strong>','</strong></span>'); ?>

                </div>


                <div class="form-group">
                  <label for="exampleInputEmail1">วันที่ แสดงบทความ</label>
                  <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" data-plugin-datepicker name="edate" value="<?php echo $rs['edate'] ?>" data-plugin-options='{"format": "yyyy-mm-dd"}' class="form-control">
                          </div>
                  

                </div>


          


                <div class="form-group">
                  <label >เลือกประเภท บทความ</label>
                    <select name="blog_type" class="form-control" required>
                      <option>-- เลือกประเภท --</option>
                      <?php foreach($obj as $row) { ?>
                      <option value="<?php echo $row->id; ?>" <?php if($rs['FK_Article_Category'] == $row->id){?> selected="selected" <?php } ?>><?php echo $row->Title; ?></option>
                      <?php } ?> 
                      

                    </select>
                    <?php echo form_error('blog_type','<span class="help-block"><strong>','</strong></span>'); ?>
                </div>


                <div class="form-group">
					             
												<div class="col-md-6">
													<label class="col-md-3 control-label">รูปภาพเนื้อหา</label>
													<img src="<?php echo base_url('/assets/admin/blog/'.$rs['Thumbnail_Url']); ?>" class="img-responsive img-thumbnail">
												</div>
											</div>


                <div class="form-group">
                  <label for="exampleInputEmail1">รูป บทความ</label>
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
                          <?php echo form_error('userfile','<span class="help-block"><strong>','</strong></span>'); ?>

                </div>


                 
             <div class="form-group" style="">
                
               <label class=" control-label">รูปลายประกอบ <span class="text-danger">*</span></label>
                  <input id="file-0a" class="file" type="file" name="userFiles[]" accept="image/*" multiple >
             
                
                </div> 



                <div class="form-group">
                  <label for="exampleInputEmail1">รายละเอียด</label>
                  <textarea class="form-control" name="detail" id="summernote" rows="4" required><?php echo $rs['Content'] ?></textarea>
                  <?php echo form_error('detail','<span class="help-block"><strong>','</strong></span>'); ?>
                </div>



                <div class="form-group">
                  <label for="exampleInputEmail1">Tag (ใส่เครื่องหมาย , เพื่อแบ่ง Tag ในการแยกข้อมูล)</label>
                  <input type="text" id="tag" class="form-control" name="tag"  
                  value="<?php echo $rs['tag'] ?>" >
                  <?php echo form_error('tag','<span class="help-block"><strong>','</strong></span>'); ?>

                </div>

<style type="text/css">
  .btn-file{
 
  }
</style>





<br>











            
              <input type="submit" name="regisSubmit" class="btn btn-default pull-right" value="อัพเดท บทความ"/>
              <br><br>
            </form>

              </div>
            </section>

              </div>
              <div class="col-xs-1">
              </div>
            </div>
        </div>
</section>
<br><br>


<section class="content-body">
<!-- start: page -->
<section class=" content-with-menu-has-toolbar media-gallery">
<div class="content-with-menu-container">

  <form  action="<?php echo base_url('del_img'); ?>" method="post" onsubmit="return(confirm('Do you want Delete'))">

<input type="hidden" name="property_id" value="<?=$rs['id']?>">
<div class="row mg-files" data-sort-destination data-sort-id="media-gallery">

<?php if(isset($img)){ ?>
                    <?php foreach($img as $rows) { ?>
  <div class="isotope-item  col-sm-6 col-md-4 col-lg-3">
    <div class="thumbnail">
      <div class="">
        <a class="thumb-image" >
          <img src="<?php echo base_url('/assets/admin/blog/'.$rows['file_name']); ?>" class="img-responsive" >
        </a>
        <br>
        <div class="mg-thumb-options">
          <div class="checkbox-custom checkbox-default">
            <input type="checkbox" name="product_image[]" value="<?=$rows['id']?>"  >
            <label>เลือกรูปภาพประกอบ</label>
          </div>
        </div>
      </div>

      <div class="mg-description">

        <small class="pull-right text-muted"></small>
      </div>
    </div>
  </div>
<?php } ?> 
                    <?php } ?> 




</div>

<input type="submit" name="delimage" class="btn btn-danger pull-right" value="ลบรูปภาพที่เลือกไว้"/>
</form>



</div>
</section>
<!-- end: page -->
</section>

<br><br><br><br><br><br><br><br><br><br>