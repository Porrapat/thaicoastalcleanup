
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

<?php echo form_open(base_url("masterdata/save"), array("id" => "formInputData")); ?>
<input type='hidden' id='dataType' name='dataType' value=<?php echo($dataType); ?>></input>
<input type='hidden' id='rowID' name='rowID' value=<?php echo($dsInput['id']); ?>></input>
<input type='hidden' id='baseUrl' value="<?php echo(base_url()); ?>"></input>

<!-- Garbage Type Order -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">ลำดับที่ : </button>
		</span>
		<input type="number" class="form-control input-require" 
		autocomplete="off" placeholder="ลำดับที่..."
		id="OrderType" name="Priority" value="<?php echo($dsInput['Priority']); ?>">
	</div>
</div>

<!-- Garbage Type Name -->
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-primary disabled" type="button">ชื่อประเภทขยะ : </button>
		</span>
		<input type="text" class="form-control input-require" 
		autocomplete="off" placeholder="Garbage Name..."
		id="Name" name="Name" value="<?php echo($dsInput['Name']); ?>">
	</div>
</div>
<br><br>
<div class="col-xs-12 col-md-12 col-lg-12 margin-input">
					<div class="col-xs-10 col-md-10 col-lg-10">
					</div>
					<div class="col-xs-2 col-md-2 col-lg-2 pull-right">
						<button type="submit" class="btn btn-primary btn-submit pull-right">Save</button>
					</div>
    </div>
<?php echo form_close(); ?>

              </div>
            </section>

              </div>
              <div class="col-xs-1">
              </div>
            </div>
        </div>