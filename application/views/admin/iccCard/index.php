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

                <h2 class="panel-title">จัดการ iccCard</h2>
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


<a class="btn btn-primary btn-sm" href="<?php echo base_url('iccCard/addNew'); ?>" role="button">
    <i class="fa fa-plus"></i> เพิ่ม iccCard</a>
    <br><br>
	
	
	

                <table class="table table-striped" >
                  <thead>
                    <tr>
                        <th class="text-center" width="40">#</th>
                            <?php 
                                if(count($dsView) > 0) {
                                    $i=0;
                                    foreach($dsView[0] as $col => $value) {
                                        if($i++ > 0) {
                                            echo ('<th>'. $col .'</th>');
                                        }
                                    }
                                }
                            ?>
                            <th>จัดการ</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php 
                            $i = 1;
                            foreach($dsView as $row) {
                                echo ('<tr>');
                                    echo('<td class="text-center">' . $i++ . '</td>');
                                    $lastColumn = count($row) - 1;
                                    $j = 0;
                                    foreach($row as $value) {
                                        if ($j == $lastColumn) {
                                            echo('<td class="text-center">');
                                                echo( ($value == 3) ? 'เสร็จสิ้น' : ( ($value == 2) 
                                                    ? 'กำลังดำเนินการ' : 'รอการอนุมัติ') );
                                            echo('</td>');
                                        } else if ($j > 0) {
                                            echo('<td class="text-left">' . $value . '</td>');
                                        }
                                        $j++;
                                    }
?>
     <td width="75"> <a style="float:left; margin-right:8px;" title="แก้ไขบทความ" class="btn btn-primary btn-xs" 
                        href="<?php echo base_url('iccCard/edit/'.$row['id']); ?>" role="button"><i class="fa fa-cog "></i> </a>
                     <form  action="<?php echo base_url('iccCard/del/'.$row['id']); ?>" method="post" onsubmit="return(confirm('Do you want Delete'))">
                            <button type="submit" style="float:left;" title="ลบบทความ" class="btn btn-danger btn-xs"><i class="fa fa-times "></i></button>
                          </form>     
                          </td>                         

                                  

<?php
                                echo ('</tr>');
                            }
                        ?>
                    </tbody>
                </table>
                <div class="pagination"> </div>
              </div>
            </section>

              </div>
            </div>
        </div>
</section>
