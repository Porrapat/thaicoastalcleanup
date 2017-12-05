<?php
function DateThai($strDate)
{
$strYear = date("Y",strtotime($strDate))+543;
$strMonth= date("n",strtotime($strDate));
$strDay= date("j",strtotime($strDate));
$strHour= date("H",strtotime($strDate));
$strMinute= date("i",strtotime($strDate));
$strSeconds= date("s",strtotime($strDate));
$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
$strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai $strYear";
}
 ?>



        <section role="main" class="content-body">

        

          <!-- start: page -->



<div class="row">
              <div class="row">
              <div class="col-xs-12">

            <section class="panel">
              <header class="panel-heading">
                <div class="panel-actions">
                  <a href="#"  class="panel-action panel-action-toggle" data-panel-toggle></a>

                </div>

                <h2 class="panel-title"><?php echo($dataTypeCaption); ?></h2>
              </header>
              <div class="panel-body">

                
                    
                    
                    <?php echo form_open(base_url("masterdata/addNew/".$dataType), array("id" => "formAddNew")); ?>
                  <button type="submit" id="dataType" 
							name="dataType" value=<?php echo($dataType); ?>
							class="btn btn-warning pull-right startFocus
							<?php echo(($dataType == '10') ? ' hide' : ''); ?>">
								<i class="fa fa-plus"></i> Add a new
							</button>
                  <?php echo form_close(); ?>
                    <br><br>
                    
                     <?php 
                    echo form_open(base_url("masterdata/edit/".$dataType), array("id" => "formChoose"));
                    ?>
                    
                    
                    <input type='hidden' id='dataType' name='dataType' value=<?php echo($dataType); ?> />
                    
                <table class="table table-striped" >
                  <thead>
                    <tr>

                     <th class="text-center" width="40">No.</th>
						<?php 
							if(count($dsView) > 0) {
								$i=0;
								foreach($dsView[0] as $col => $value) {
									if($i++ > 0) {
										echo ('<th class="text-center">'. $col .'</th>');
									}
								}
							}
						?>
						<th class="text-center" width="40">#</th>
                    </tr>
                  </thead>
                  <tbody>
             
                    <?php if(isset($dsView)){ ?>
                    <?php foreach($dsView as $row) { ?>
                    <tr>
<?php if(0){?>
                      <td><i class="fa fa-caret-right "></i> <?php echo $row->Title_a; ?></td>
                      <td><?php echo $row->Name; ?></td>
                      <td><?php echo DateThai($row->Publish_Date); ?></td>

                      <td>
                        <a style="float:left; margin-right:8px;" title="แก้ไขบทความ" class="btn btn-primary btn-xs" href="<?php echo base_url('blog/edit/'.$row->id_b); ?>" role="button"><i class="fa fa-cog "></i> </a>
                          <form  action="<?php echo base_url('blog/del/'.$row->id_b); ?>" method="post" onsubmit="return(confirm('Do you want Delete'))">
              
                            <button type="submit" title="ลบบทความ" class="btn btn-danger btn-xs"><i class="fa fa-times "></i></button>
                          </form>
                      </td>
<?php }?>
<?php  foreach($row as $value) {?>    
                      <?php 
                      
                    //  if($j++ > 0) {
			echo('<td class="text-left">' . $value . '</td>');
									//}
                      ?>
<?php } ?>          
                      
                      <?php 
                      echo('<td class="text-center">
										<button type="submit" class="btn btn-success'.(($dataType == '10') ? ' hide' : '').'"
											id="rowID" name="rowID" value='.$row['id'].'>
											edit
										</button>
                                                                                
			</td>');
                      
                      
                      ?>
                    </tr>
                    <?php } ?> 
                    <?php } ?> 
                       

                  </tbody>
                </table>
                    
                    <?php 
echo form_close();
?>
                <div class="pagination"> <p><?php echo $links; ?></p> </div>
              </div>
            </section>

              </div>
            </div>
        </div>
</section>






