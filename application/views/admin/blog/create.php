

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

                <h2 class="panel-title">เพิ่มเนื้อหาใหม่</h2>
              </header>
              <div class="panel-body">

              <form action="" id="form" method="post" enctype="multipart/form-data">


                <div class="form-group">
                  <label for="exampleInputEmail1">ชื่อ บทความ</label>
                  <input type="text" id="Title_a" class="form-control" name="Title_a" placeholder="ใส่หัวข้อบทความ"  value="<?php echo !empty($user['Title_a'])?$user['Title_a']:''; ?>" >
                  <?php echo form_error('Title_a','<span class="help-block"><strong>','</strong></span>'); ?>

                </div>


              <div class="form-group">
                  <label for="exampleInputEmail1">วันที่ แสดงบทความ</label>
                  <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" data-plugin-datepicker name="edate" value="<?=date("Y-m-d")?>" data-plugin-options='{"format": "yyyy-mm-dd"}' class="form-control">
                          </div>
                  

                </div>


                <div class="form-group">
                  <label >เลือกประเภท บทความ</label>
                    <select name="blog_type" class="form-control" required>
                      <option>-- เลือกประเภท --</option>
                      <?php foreach($obj as $row) { ?>
                      <option value="<?php echo $row->id; ?>"><?php echo $row->Title; ?></option>
                      <?php } ?> 
                      

                    </select>
                    <?php echo form_error('blog_type','<span class="help-block"><strong>','</strong></span>'); ?>
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
                  <textarea class="form-control" name="detail" id="summernote" rows="4" required><?php echo !empty($user['Content'])?$user['Content']:''; ?></textarea>
                  <?php echo form_error('detail','<span class="help-block"><strong>','</strong></span>'); ?>
                </div>



                <div class="form-group">
                  <label for="exampleInputEmail1">Tag (ใส่เครื่องหมาย , เพื่อแบ่ง Tag ในการแยกข้อมูล)</label>
                  <input type="text" id="tag" class="form-control" name="tag"  
                  value="<?php echo !empty($user['tag'])?$user['tag']:''; ?>" >
                  <?php echo form_error('tag','<span class="help-block"><strong>','</strong></span>'); ?>

                </div>



<style type="text/css">
  .btn-file{
 
  }
</style>





<br><br><br>











            
              <input type="submit" name="regisSubmit" class="btn btn-default pull-right" value="เพิ่ม บทความ"/>
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
<br><br><br><br><br>


