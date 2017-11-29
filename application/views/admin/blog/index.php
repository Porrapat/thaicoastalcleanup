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

                <h2 class="panel-title">บทความ / ข่าวสาร </h2>
              </header>
              <div class="panel-body">

                <a class="btn btn-primary " href="<?php echo base_url('blog/create'); ?>" role="button">
                    <i class="fa fa-plus"></i> เพิ่มเนื้อหาใหม่</a>
                    <br><br>
                <table class="table table-striped" >
                  <thead>
                    <tr>

                      <th>หัวข้อเรื่อง</th>
                      <th>หมวดหมู่</th>
                      <th>วันที่เผยแพร่</th>


                      <th>จัดการ</th>
                    </tr>
                  </thead>
                  <tbody>
             
                    <?php if(isset($obj)){ ?>
                    <?php foreach($obj as $row) { ?>
                    <tr>

                      <td><i class="fa fa-caret-right "></i> <?php echo $row->Title_a; ?></td>
                      <td><?php echo $row->Name; ?></td>
                      <td><?php echo DateThai($row->Publish_Date); ?></td>

                      <td>
                        <a style="float:left; margin-right:8px;" title="แก้ไขบทความ" class="btn btn-primary btn-xs" href="<?php echo base_url('blog/edit/'.$row->id_b); ?>" role="button"><i class="fa fa-cog "></i> </a>
                          <form  action="<?php echo base_url('blog/del/'.$row->id_b); ?>" method="post" onsubmit="return(confirm('Do you want Delete'))">
              
                            <button type="submit" title="ลบบทความ" class="btn btn-danger btn-xs"><i class="fa fa-times "></i></button>
                          </form>
                      </td>

                    </tr>
                    <?php } ?> 
                    <?php } ?> 
                       

                  </tbody>
                </table>
                <div class="pagination"> <p><?php echo $links; ?></p> </div>
              </div>
            </section>

              </div>
            </div>
        </div>
</section>






