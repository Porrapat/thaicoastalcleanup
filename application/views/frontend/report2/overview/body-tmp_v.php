<div class="container">
    <div class="row">

        <!-- ************************************************ Panel of Report Overview -->
        <?php //echo form_open(base_url("report/choose"), array("id" => "formReportOverview")); ?>
        <div class="col-xs-12 col-md-12 col-lg-12 panel-group" id="collapseReportOverviewParent">
        <!-- ************************************** Panel Report Overview -->
            <div class="panel panel-primary">
            <!-- ************************* Panel Report Overview - Heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#collapseReportOverviewParent" href="#collapseReportOverview">
                            รายงานข้อมูลขยะในประเทศไทย ตามช่วงเวลาและสถานที่
                        </a>
                    </h4>
                </div>
            <!-- ************************* End Panel Report Overview - Heading -->
                <div class="panel-collapse collapse in" id="collapseReportOverview">
                <!-- ************************* Panel Report Overview - Body -->
                    <div class="panel-body">
                        <div class="row">
                        <!-- Filter Section -->
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="row">
                                <!-- Daterange Sub Section -->
                                    <div class="col-xs-1 col-md-1 col-lg-1 text-left margin-input">
                                        <div>ช่วงเวลา : </div>
                                    </div>
                                    <div class="col-xs-4 col-md-4 col-lg-4 text-left margin-input">
                                        <div id="daterange">
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                            <span></span> <b class="caret"></b>
                                        </div>
                                    </div>
                                <!-- End Daterange Sub Section -->
                                <!-- Province Sub Section -->
                                    <div class="col-xs-1 col-md-1 col-lg-1 text-left margin-input">
                                        <div>จังหวัด : </div>
                                    </div>
                                    <div class="col-xs-2 col-md-2 col-lg-2 margin-input">
                                        <select class="form-control input-require" 
                                        id="provinceCode" name="FK_Province_Code">
                                            <option value="0" selected>เลือกจังหวัด...</option>
                                            <?php 
                                                foreach($dsProvince as $row) {
                                    //                $selected = (($dsInput['dsIccCardMaster'][0]['FK_Province_Code']
                                    //                            == $row['ProvinceCode'])
                                    //                            ? ' selected' : '');
                                    //                echo '<option value=' . $row['ProvinceCode'] . $selected.'>'
                                                    echo '<option value=' . $row['ProvinceCode'] .'>'
                                                    . $row['ProvinceName'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                <!-- End Province Sub Section -->
                                <!-- Amphur Sub Section -->
                                    <div class="col-xs-1 col-md-1 col-lg-1 text-left margin-input">
                                        <div>อำเภอ : </div>
                                    </div>
                                    <div class="col-xs-2 col-md-2 col-lg-2 margin-input">
                                        <select class="form-control" 
                                        id="amphurCode" name="FK_Amphur_Code">
                                            <option value="0" selected>เลือกอำเภอ...</option>
                                            <?php 
                                                foreach($dsAmphur as $row) {
                                                    echo '<option value=' . $row['AmphurCode'] .'>'
                                                        . $row['AmphurName'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                <!-- End Amphur Sub Section -->
                                <!-- Button Section -->
                                    <div class="col-xs-1 col-md-1 col-lg-1 margin-input">
                                        <button id="genReport" class="bg-success">Show Report</button>
                                    </div>
                                <!-- End Button Section -->
                                </div>
                            </div>
                        <!-- End Filter Section -->
                            <hr>
                        <!-- Body Content -->
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="row">
                                <!-- Debris 3Pie Chart Sub Section -->
                                    <div class="col-xs-12 col-md-12 col-lg-12 text-left margin-input">
                                        <div id="marineDebrisTypeChart"></div>
                                    </div>
                                <!-- End Debris 3Pie Chart Sub Section -->
                                <!-- Icc overview column Chart Sub Section -->
                                    <div class="col-xs-12 col-md-12 col-lg-12 text-left margin-input">
                                        <div id="iccOverviewChart"></div>
                                    </div>
                                <!-- End Icc overview column Chart Sub Section -->
                                </div>
                            </div>
                        <!-- End Body Content -->
                        </div>
                    </div>
                </div>
                <!-- ************************* End Panel Report Overview - Body -->
            </div>
        <!-- ************************************** Panel Report Overview -->
        </div>
        <?php //echo form_close(); ?><!-- Close formReportOverview -->

    </div>
</div>
