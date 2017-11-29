<?php
class Report2 extends MY_Controller {
// Property.
	private $captionPage = [1 => "รายงานข้อมูลขยะทะเลในประเทศไทย"];
// End Property.


// Constructor.
    public function __construct() {
        parent::__construct();
    }
// End Constructor.




// Method start.
    public function index() {
		$this->overviewReport();
	}
// End Method start.



// Public function.
    // ------------------------------------- For display list view article -----------------------------
	public function overviewReport() {
		// Prepare data of view.
		$this->data = $this->GetInitialOverviewReportData();

		// Prepare Template.
		$this->extendedCss = 'frontend/report2/overview/extendedCss_v';
		$this->body = 'frontend/report2/overview/body_v';
		$this->extendedJs = 'frontend/report2/overview/extendedJs_v';
		$this->footer = 'frontend/report2/overview/footer_v';
		$this->renderWithTemplate2();
	}

	public function detailReport() {
		// Prepare data of view.
		$this->data["strDateStart"] = $this->input->post('strDateStart');
		$this->data["strDateEnd"] = $this->input->post('strDateEnd');
		$this->data["provinceCode"] = $this->input->post('provinceCode');
		// Breadcrumb.
		$this->lastBreadcrumbCaption = "รายงานกิจกรรม";
		
		// Prepare Template.
		$this->extendedCss = 'frontend/report2/detail/extendedCss_v';
		$this->body = 'frontend/report2/detail/body_v';
		$this->extendedJs = 'frontend/report2/detail/extendedJs_v';
		$this->footer = 'frontend/report2/detail/footer_v';
		$this->renderWithTemplate2();
	}
// End Public function.


///////////////////////////////////////////////// AJAX function.
// Overview Report.
	public function ajaxGetOverviewReportData() {
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {
    		$strDateStart = $this->input->post('strDateStart');
    		$strDateEnd = $this->input->post('strDateEnd');
			$provinceCode = $this->input->post('provinceCode');
			$provinceCode = ( ($provinceCode > 0 ) ? $provinceCode : null);

			$amphurCode = $this->input->post('amphurCode');
			$amphurCode = ( ($amphurCode > 0 ) ? $amphurCode : null);

			$this->load->model("report_m");
			$result = $this->report_m->GetOverviewReportData($strDateStart, $strDateEnd, $provinceCode, $amphurCode);

    		echo json_encode($result);
    	}
	}

    // -------------------------------------------- Get data to ComboBox -------------------------------
	public function ajaxGetAmphurCodeAndName() {
		if(!($this->is_logged())) {exit(0);}

    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{var_dump("php test");exit(0);
    		$provinceCode = $this->input->post('provinceCode');
			
			$this->load->model("report_m");
			$dsData = $this->report_m->GetDsAmphur($provinceCode);

			echo json_encode($dsData);
    	}
	}
// End Overview Report.

// Detail Report.
	public function ajaxGetDetailReportData() {
    	if ($this->input->server('REQUEST_METHOD') === 'POST') {
    		$strDateStart = $this->input->post('strDateStart');
    		$strDateEnd = $this->input->post('strDateEnd');
			$provinceCode = $this->input->post('provinceCode');
			$provinceCode = ( ($provinceCode > 0 ) ? $provinceCode : null);

			$this->load->model("report_m");
			$result = $this->report_m->GetDetailReportData($strDateStart, $strDateEnd, $provinceCode);

    		echo json_encode($result);
    	}
	}
// End Detail Report.
///////////////////////////////////////////////// End AJAX function.


// Private function.
    // ---------------------------------------------- Overview Report ----------------------------------
	private function GetInitialOverviewReportData() {
		$this->load->model("report_m");
		$data = $this->report_m->GetDataForComboBox();

		return $data;
	}
// End Private function.
}