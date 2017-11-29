<div class="container">
    <div class="row">

        <!-- ************************************************ Div Overview Report -->
        <?php echo form_open(base_url("report/detailReport"), array("id" => "formOverviewReport")); ?>
            <input type='hidden' id='strDateStart' name='strDateStart' value="0"></input>
            <input type='hidden' id='strDateEnd' name='strDateEnd' value="0"></input>
            <input type='hidden' id='provinceCode' name='provinceCode' value="0"></input>
        <div class="col-xs-12 col-md-12 col-lg-12 panel-group" id="collapseOverviewReportParent">
        <!-- ************************************** Panel Overview Report -->
            <div class="panel panel-primary">
            <!-- ************************* Panel Overview Report - Heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#collapseOverviewReportParent" href="#collapseOverviewReport">
                            <div id="panelHeaderCaption">
                                รายงานชนิดของข้อมูลขยะทะเล 10 อันดับแรกในประเทศไทย
                            </div>
                        </a>
                    </h4>
                </div>
            <!-- ************************* End Panel Overview Report - Heading -->
                <div class="panel-collapse collapse in" id="collapseOverviewReport">
            <!-- ************************* Panel Overview Report - Body -->
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
                                    <div class="col-xs-3 col-md-3 col-lg-3 margin-input">
                                        <select class="form-control input-require" 
                                        id="provinceCode">
                                            <option value="0" selected>ทุกจังหวัด...</option>
                                            <?php 
                                                foreach($dsProvince as $row) {
                                                    echo '<option value=' . $row['ProvinceCode'] .'>'
                                                    . $row['ProvinceName'] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                <!-- End Province Sub Section -->
                                <!-- Amphur Sub Section -->
                                    <!--
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
                                    -->
                                <!-- End Amphur Sub Section -->
                                <!-- Button Section -->
                                    <!--
                                    <div class="col-xs-1 col-md-1 col-lg-1 margin-input">
                                        <button id="genReport" class="bg-success">Show Report</button>
                                    </div>
                                    -->
                                <!-- End Button Section -->
                                </div>
                            </div>
                        <!-- End Filter Section -->
                            <hr>
                        <!-- Body Content -->
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="row">
                                <!-- Marine Debris 3Pie Chart Sub Section -->
                                    <div class="col-xs-12 col-md-12 col-lg-12 text-left margin-input">
                                        <div id="marineDebrisMainPieChart"></div>
                                    </div>
                                <!-- End Marine Debris 3Pie Chart Sub Section -->

                                <!-- Marine Debris Column Chart Sub Section -->
                                    <div class="col-xs-12 col-md-12 col-lg-12 text-left margin-input">
                                        <div id="marineDebrisMainColumnChart"></div>
                                    </div>
                                <!-- End Marine Debris Column Chart Sub Section -->

                                <!-- Marine Debris Table Sub Section -->
                                    <div class="col-xs-12 col-md-12 col-lg-12">
                                        <table class="table table-bordered table-components table-condensed table-hover table-striped table-responsive" 
                                            id="marineDebrisTable" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center header-border-report"><h4><strong></strong></h4></th>
                                                    <th class="text-center header-border-report"><h4><strong>จังหวัด</strong></h4></th>
                                                    <th class="text-center header-border-report" width="60"><h4><strong>อันดับที่</strong></h4></th>
                                                    <th class="text-center header-border-report"><h4><strong>ประเภทขยะ</strong></h4></th>
                                                    <th class="text-center header-border-report"><h4><strong>จำนวน (ชิ้น)</strong></h4></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                <!-- End Marine Debris Table Sub Section -->
                                </div>
                            </div>
                        <!-- End Body Content -->
                        </div>
                    </div>
                </div>
            <!-- ************************* End Panel Overview Report - Body -->
            </div>
        <!-- ************************************** Panel Overview Report -->
        </div>
        <?php echo form_close(); ?><!-- Close formOverviewReport -->
        <!-- ************************************************ End Div Overview Report -->

    </div>
</div>
