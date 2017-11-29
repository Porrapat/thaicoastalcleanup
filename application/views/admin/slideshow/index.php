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

                <h2 class="panel-title">จัดการ slideshows</h2>
              </header>
              <div class="panel-body">
<style>
.ap-questions-featured {
    margin-left: 3px;
    border: medium none;
    color: #ff951e;
    display: inline;
    font-size: 16px;
    height: auto;
    margin-right: 5px;

    position: static;
    vertical-align: baseline;
    width: auto;
}
.ap-questions-featured2 {
    margin-left: 3px;
    border: medium none;
    color: #666;
    display: inline;
    font-size: 16px;
    height: auto;
    margin-right: 5px;

    position: static;
    vertical-align: baseline;
    width: auto;
}
</style>


<a class="btn btn-primary btn-sm" href="<?php echo base_url('slideshow/create'); ?>" role="button">
    <i class="fa fa-plus"></i> เพิ่ม slideshows</a>
    <br><br>
                <table class="table table-striped" >
                  <thead>
                    <tr>

                      <th>ชื่อรูป</th>
                      <th>หัวข้อเรื่อง</th>


                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php if(count($rs) != 0){ ?>
                    <?php foreach($rs as $row) { ?>
                    <tr>

                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['title']; ?></td>
                      <td><?php echo DateThai($row['create_at']); ?></td>



                      <td>
                        <a style="float:left; margin-right:8px;" title="แก้ไขบทความ" class="btn btn-primary btn-xs" href="<?php echo base_url('slideshow/edit/'.$row['id']); ?>" role="button"><i class="fa fa-cog "></i> </a>

                          <form  action="<?php echo base_url('slideshow/del/'.$row['id']); ?>" method="post" onsubmit="return(confirm('Do you want Delete'))">
              
                            <button type="submit" title="ลบบทความ" class="btn btn-danger btn-xs"><i class="fa fa-times "></i></button>
                          </form>

                      </td>


                      </tr>
                      <?php } ?> 
                    <?php } ?>

                  </tbody>
                </table>
                <div class="pagination"> </div>
              </div>
            </section>

              </div>
            </div>
        </div>
</section>
