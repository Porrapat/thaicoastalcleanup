<?php
class IccCard2 extends MY_Controller {
// Property.
	private $dataTypeName = "ICC Card";
	private $inputModeName = [1 => 'เพิ่มข้อมูล', 2 => 'แก้ไข'];
// End Property.


// Constructor.
    public function __construct() {
        parent::__construct();

		$this->is_logged();
    }
// End Constructor.


// Method start.
    public function index() {
		if(!($this->is_logged())) {exit(0);}

		$this->View();
	}
// End Method start.


// Public function.
    // ------------------------------------------------- For display -----------------------------------
	public function view() {
		if(!($this->is_logged())) {exit(0);}

		// Prepare data of view.
		$this->data = $this->GetDataForViewDisplay();
		// Caption.
		$this->data['dataTypeName'] = $this->dataTypeName;
		
		// Prepare Template.
		//$this->extendedCss = 'backend/iccCard/list/extendedCss_v';
		//$this->body = 'backend/iccCard/list/body_v';
		//$this->extendedJs = 'backend/iccCard/list/extendedJs_v';
		$this->body = 'admin/iccCard/index';
		$this->renderWithTemplate3();
	}
	public function addNew() {
		if(!($this->is_logged())) {exit(0);}

		/*if ($this->input->server('REQUEST_METHOD') === 'POST'){
			$inputMode = 1;
			$rowID = null;

			$this->SetInputDisplay($inputMode, $rowID);
		} */
		$inputMode = 1;
	    $rowID = null;


		$this->data = $this->GetDataForInputDisplay($rowID);
		// Caption.
		$this->data['dataTypeName'] = $this->dataTypeName;
		$this->data['inputModeName'] = $this->inputModeName[$inputMode];
		// Input Mode.
		$this->data['inputMode'] = $inputMode;

		// Prepare Template.
		$this->extendedCss = 'backend/iccCard/input/extendedCss_v';
		$this->header = 'backend/iccCard/input/header_v';
		$this->body = 'admin/iccCard/create';
		$this->footer = 'backend/iccCard/input/footer_v';
		$this->extendedJs = 'backend/iccCard/input/extendedJs_v';
		$this->renderWithTemplate3();




	}
	public function edit($id) {
		if(!($this->is_logged())) {exit(0);}

	/*	if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$rowID = $this->input->post('rowID');
			$inputMode = 2;

			$this->SetInputDisplay($inputMode, $rowID);
		}  */


		$inputMode = 2;
	    $rowID = $id;//$this->input->post('rowID');


		$this->data = $this->GetDataForInputDisplay($rowID);
		// Caption.
		$this->data['dataTypeName'] = $this->dataTypeName;
		$this->data['inputModeName'] = $this->inputModeName[$inputMode];
		// Input Mode.
		$this->data['inputMode'] = $inputMode;

		// Prepare Template.
		$this->extendedCss = 'backend/iccCard/input/extendedCss_v';
		$this->header = 'backend/iccCard/input/header_v';
		$this->body = 'admin/iccCard/edit';
		$this->footer = 'backend/iccCard/input/footer_v';
		$this->extendedJs = 'backend/iccCard/input/extendedJs_v';
		$this->renderWithTemplate3();


	}
// End Public function.


// AJAX function.
    // ---------------------------------------------- Save data to DB ----------------------------------
	public function ajaxSaveInputData() {
		if(!($this->is_logged())) {exit(0);}

		$result = 1;
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->load->model('helper_m');
			$dsIccCardMasterSerializeArray = $this->input->post('dsIccCardMasterSerializeArray');
			$dsData['dsIccCardMaster'] = $this->helper_m->myJsonDecode($dsIccCardMasterSerializeArray);

			$dsData['dsContactInfo'] = $this->input->post('dsContactInfo');
			$dsData['dsEntangledAnimal'] = $this->input->post('dsEntangledAnimal');
			$dsData['dsGarbageTransaction'] = $this->input->post('dsGarbageTransaction');

			$result = $this->SaveDataToDB($dsData);
		}

		$result = (($result) ? 0 : 1);
		echo $result;
	}

    // -------------------------------------------- Get data to ComboBox -------------------------------
	public function ajaxGetAmphurCodeAndName() {
		if(!($this->is_logged())) {exit(0);}

    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    		$provinceCode = $this->input->post('provinceCode');
			
			$this->load->model("iccCard_m2");
			$dsData = $this->iccCard_m2->GetDsAmphur($provinceCode);

			echo json_encode($dsData);
    	}
	}
// End AJAX function.



// Private function.
    // ---------------------------------------------- Initial view mode --------------------------------
	private function GetDataForViewDisplay() {
		$this->load->model("iccCard_m2");
		$data['dsView'] = $this->iccCard_m2->GetDataForViewDisplay();

		return $data;
	}

    // -------------------------------------------- Set input display mode -----------------------------
	private function SetInputDisplay($inputMode=1, $rowID=null) {
		// Prepare data of view.
		$this->data = $this->GetDataForInputDisplay($rowID);
		// Caption.
		$this->data['dataTypeName'] = $this->dataTypeName;
		$this->data['inputModeName'] = $this->inputModeName[$inputMode];
		// Input Mode.
		$this->data['inputMode'] = $inputMode;

		// Prepare Template.
		$this->extendedCss = 'backend/iccCard/input/extendedCss_v';
		$this->header = 'backend/iccCard/input/header_v';
		$this->body = 'admin/iccCard/index';
		$this->footer = 'backend/iccCard/input/footer_v';
		$this->extendedJs = 'backend/iccCard/input/extendedJs_v';
		$this->renderWithTemplate3();
	}
    // ---------------------------------------------- Initial input mode -------------------------------
	private function GetDataForInputDisplay($rowID=null) {
		$this->load->model('iccCard_m2');

		// Set array data for View part.
		if(($rowID == null) || ($rowID == 0)) {
			$result['dsInput'] = $this->iccCard_m2->GetTemplateForInputDisplay();
		} else {
			$dataSet = $this->iccCard_m2->GetDataForInputDisplay($rowID);
			$result['dsInput'] = ((count($dataSet) > 0) ? $dataSet 
								: $this->iccCard_m2->GetTemplateForInputDisplay());
		}

		// Get DataSet to combobox.
		$this->load->model('dataclass/iccCard_d');
		$dsComboBox = $this->iccCard_m2->GetDataForComboBox(
					$result['dsInput']['dsIccCardMaster'][0][$this->iccCard_d->colFkProvinceCode]);
		if($dsComboBox != null) {
			foreach($dsComboBox as $key => $value) {
				$result[$key] = $value;
			}
		}

    	return $result;
	}

    // -------------------------------------------------- Save input mode ------------------------------
	private function SaveDataToDB($dsData) {
    	$result = false;

    	$masterId = $dsData['dsIccCardMaster']['masterId'];
    	unset($dsData['dsIccCardMaster']['masterId']);

		// Selection for masterdata object.
		$this->load->model('iccCard_m2');

		// Save data to DB.
		$result = $this->iccCard_m2->Save($masterId, $dsData);
    	
    	return $result;
	}
// End Private function.
}