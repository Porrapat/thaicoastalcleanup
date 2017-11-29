<div class="container">
    <div class="row">

        <!-- ************************************************ Panel of Public Relations List -->
        <?php echo form_open(base_url("report/choose"), array("id" => "formReport")); ?>
        <div class="col-xs-12 col-md-12 col-lg-12 panel-group" id="collapseReportParent">
        <!-- ************************************** Panel Public Relations List -->
            <div class="panel">
                <div class="panel-collapse collapse in" id="collapseReport">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                            <!-- Body Content -->
                                <div id="chartContainer">FusionCharts XT will load here!</div>

                                <div id="chartContainer3DPie">FusionCharts XT will load here!</div>

                                <div class='border-bottom' id='content'>
                                    <div class='border-bottom'>
                                        <div class='chartCont border-right' id='sales-chart-container'>FusionCharts will load here.</div>
                                        <div class='chartCont' id='trans-chart-container'>FusionCharts will load here.</div>
                                    </div>
                                    <div>
                                        <div class='chartCont border-right' id='footfall-chart-container'>FusionCharts will load here.</div>
                                        <div class='chartCont' id='cs-chart-container'>FusionCharts will load here.</div>
                                    </div>
                                </div>

                            <!-- End Body Content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- ************************************** Panel Public Relations List -->
        </div>
        <?php echo form_close(); ?><!-- Close formReport -->

    </div>
</div>
