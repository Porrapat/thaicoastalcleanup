<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IccCard_m2 extends CI_Model {
// Constructor.
	public function __construct() {
        parent::__construct();
    }
// End Constructor.




// Public function.
    // ------------------------------------------------------------ Get ------------------------------------------
	// +++ To view +++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function GetDataForViewDisplay($arrId=null, $sqlWhere=null) {
		$this->load->model('dataclass/iccCard_d');
		$this->load->model('dataclass/cleanupType_d');
		$this->load->model('dataclass/province_d');
		$this->load->model('dataclass/amphur_d');

    	$criteria ='';
    	// Prepare Criteria.
		$this->load->model('helper_m');
		if($arrId != null){
			$criteria = $this->helper_m->CreateCriteriaIn('b.'.$this->iccCard_d->colId, $arrId, $criteria, ' WHERE ');
		}
		// Prepare Where.
		$criteria = $this->helper_m->CreateSqlWhere($criteria, $sqlWhere);

		// Create sql string.
		$sqlStr = "SELECT c." . $this->iccCard_d->colId
				. ", ct." . $this->cleanupType_d->colName . " พื้นที่เก็บขยะ"
				. ", c." . $this->iccCard_d->colProjectName . " ชื่อโครงการ"
				. ", c." . $this->iccCard_d->colEventPlaceName . " ชื่อสถานที่ทำกิจกรรม"
				. ", a." . $this->amphur_d->colAmphurName . " อำเภอ"
				. ", p." . $this->province_d->colProvinceName . " จังหวัด"
				. ", DATE_FORMAT(c." . $this->iccCard_d->colEventDate . ",'%Y-%b-%d') วันที่ทำกิจกรรม"
				. ", c." . $this->iccCard_d->colStatus . " สถานะของโครงการ"

				. " FROM " . $this->iccCard_d->tableName . " AS c"

				. " LEFT JOIN " . $this->cleanupType_d->tableName . " AS ct"
				. " ON c." . $this->iccCard_d->colFkCleanupType
				. "=ct." . $this->cleanupType_d->colId

				. " LEFT JOIN " . $this->province_d->tableName . " AS p"
				. " ON c." . $this->iccCard_d->colFkProvinceCode
				. "=p." . $this->province_d->colProvinceCode

				. " LEFT JOIN " . $this->amphur_d->tableName . " AS a"
				. " ON c." . $this->iccCard_d->colFkAmphurCode
				. "=a." . $this->amphur_d->colAmphurCode
				
				. $criteria
				
				. " ORDER BY p." . $this->province_d->colProvinceName
				. ", a." . $this->amphur_d->colAmphurName
				. ", c." . $this->iccCard_d->colEventDate
				. ", ct." . $this->cleanupType_d->colName
				. ", c." . $this->iccCard_d->colProjectName;

		// Execute sql.
		$this->load->model('db_m');
		$result = $this->db_m->GetRow($sqlStr);

    	return $result;
    }

	// +++ To input ++++++++++++++++++++++++++++++++++++++++++++++++++++++
	// ///////////////// From Database ///////////////////////////////////
    public function GetDataForInputDisplay($id=null) {
		$result['dsIccCardMaster'] = $this->GetIccCardMasterForInputDisplay($id);
		$result['dsContactInfo'] = $this->GetIccCardContactInfoForInputDisplay($id);
		$result['dsEntangeledAnimal'] = $this->GetEntangeledAnimalForInputDisplay($id);
		$result['dsGarbageTransaction'] = $this->GetGarbageTransactionForInputDisplay($id);

		$result['dsGeoLocation'] = $this->GetIccCardGeoLocationForInputDisplay($id);

		return $result;
	}
	private function GetIccCardMasterForInputDisplay($id=null) {
		$this->load->model('dataclass/iccCard_d');
		$this->load->model('helper_m');

		// Create sql string.
		$sqlStr = "SELECT c." . $this->iccCard_d->colId
					. ", c." . $this->iccCard_d->colProjectName
					. ", c." . $this->iccCard_d->colFkCleanupType
					. ", c." . $this->iccCard_d->colEventPlaceName
					. ", c." . $this->iccCard_d->colFkAmphurCode
					. ", c." . $this->iccCard_d->colFkProvinceCode
					. ", c." . $this->iccCard_d->colEventDate
					. ", c." . $this->iccCard_d->colCoordinatorName
					. ", c." . $this->iccCard_d->colVolunteerQty

					. ", c." . $this->iccCard_d->colEventTime
					. ", c." . $this->iccCard_d->colEventDistance
					. ", c." . $this->iccCard_d->colFkDistanceUnit
					. ", c." . $this->iccCard_d->colGarbageBagQty
					. ", c." . $this->iccCard_d->colGarbageWeight
					. ", c." . $this->iccCard_d->colFkWeightUnit
					. ", c." . $this->iccCard_d->colStatus

					. " FROM " . $this->iccCard_d->tableName . " AS c"

					. " WHERE c." . $this->iccCard_d->colActive . "=1"
					. " AND c." . $this->iccCard_d->colId . "=" . $id;

		// Execute sql.
		$this->load->model('db_m');
		$result = $this->db_m->GetRow($sqlStr);

    	return $result;
	}
	private function GetIccCardContactInfoForInputDisplay($fkIccCardId=null) {
		$this->load->model('dataclass/contactInfo_d');
		$this->load->model('helper_m');

		// Create sql string.
		$sqlStr = "SELECT ci." . $this->contactInfo_d->colId
					. ", ci." . $this->contactInfo_d->colName
					. ", ci." . $this->contactInfo_d->colEmail
					. ", ci." . $this->contactInfo_d->colFkIccCard

					. " FROM " . $this->contactInfo_d->tableName . " AS ci"

					. " WHERE ci." . $this->contactInfo_d->colActive . "=1"
					. " AND ci." . $this->contactInfo_d->colFkIccCard . "=" . $fkIccCardId;

		// Execute sql.
		$this->load->model('db_m');
		$result = $this->db_m->GetRow($sqlStr);
		$result = ( (count($result) < 1) ? Array($this->GetTemplateContactInfoForInputDisplay()) : $result );

    	return $result;
	}
	private function GetEntangeledAnimalForInputDisplay($fkIccCardId=null) {
		$this->load->model('dataclass/entangledAnimal_d');
		$this->load->model('helper_m');

		// Create sql string.
		$sqlStr = "SELECT ea." . $this->entangledAnimal_d->colId
					. ", ea." . $this->entangledAnimal_d->colName
					. ", ea." . $this->entangledAnimal_d->colFkAnimalStatus
					. ", ea." . $this->entangledAnimal_d->colEntangledFlag
					. ", ea." . $this->entangledAnimal_d->colEntangledDebris
					. ", ea." . $this->entangledAnimal_d->colFkIccCard

					. " FROM " . $this->entangledAnimal_d->tableName . " AS ea"

					. " WHERE ea." . $this->entangledAnimal_d->colActive . "=1"
					. " AND ea." . $this->entangledAnimal_d->colFkIccCard . "=" . $fkIccCardId;

		// Execute sql.
		$this->load->model('db_m');
		$result = $this->db_m->GetRow($sqlStr);
		$result = ( (count($result) < 1) ? Array($this->GetTemplateEntangledAnimalForInputDisplay()) : $result );

    	return $result;
	}
	private function GetGarbageTransactionForInputDisplay($fkIccCardId=null) {
		$result = $this->GetDsGarbageIncludeTransactionAndTypeGrouping($fkIccCardId);

		return $result;
	}
	private function GetIccCardGeoLocationForInputDisplay($fkIccCardId=null) {
		$this->load->model('dataclass/geoLocation_d');
		$this->load->model('helper_m');

		// Create sql string.
		$sqlStr = "SELECT m." . $this->geoLocation_d->colId
					. ", m." . $this->geoLocation_d->colLatitude
					. ", m." . $this->geoLocation_d->colLongitude
					. ", m." . $this->geoLocation_d->colFkIccCard

					. " FROM " . $this->geoLocation_d->tableName . " AS m"

					. " WHERE m." . $this->geoLocation_d->colActive . "=1"
					. " AND m." . $this->geoLocation_d->colFkIccCard . "=" . $fkIccCardId;

		// Execute sql.
		$this->load->model('db_m');
		$result = $this->db_m->GetRow($sqlStr);
		$result = ( (count($result) < 1) ? Array($this->GetTemplateGeoLocationForInputDisplay()) : $result );

    	return $result;
	}



	// ///////////////// From Template ///////////////////////////////////
    public function GetTemplateForInputDisplay() {
		// ICC Card - Master.
		$this->load->model('dataclass/iccCard_d');
		$result['dsIccCardMaster'][0] = [
				$this->iccCard_d->colId						=> 0,
				$this->iccCard_d->colProjectName			=> '',
				$this->iccCard_d->colFkCleanupType			=> 1,
				$this->iccCard_d->colEventPlaceName			=> '',
				$this->iccCard_d->colFkAmphurCode			=> 0,
				$this->iccCard_d->colFkProvinceCode			=> 0,
				$this->iccCard_d->colEventDate				=> 0,
				$this->iccCard_d->colCoordinatorName		=> '',
				$this->iccCard_d->colVolunteerQty			=> 0,

				$this->iccCard_d->colEventTime				=> '',
				$this->iccCard_d->colEventDistance			=> 0.25,		// Minimum.
				$this->iccCard_d->colFkDistanceUnit			=> '',
				$this->iccCard_d->colGarbageBagQty			=> 0,
				$this->iccCard_d->colGarbageWeight			=> 0,
				$this->iccCard_d->colFkWeightUnit			=> '',
				$this->iccCard_d->colStatus					=> 0,
    	];
		// ICC Card - Contact Info.
		$result['dsContactInfo'][0] = $this->GetTemplateContactInfoForInputDisplay();
		// ICC Card - Entangled Animal.
		$result['dsEntangeledAnimal'][0] = $this->GetTemplateEntangledAnimalForInputDisplay();
		// ICC Card - Garbage Qty.
		$result['dsGarbageTransaction'] = $this->GetDsGarbageIncludeTransactionAndTypeGrouping(0);

		// ICC Card - Geo-Location.
		$result['dsGeoLocation'][0] = $this->GetTemplateGeoLocationForInputDisplay();

    	return $result;
	}
	private function GetTemplateContactInfoForInputDisplay() {
		// ICC Card - Contact Info
		$this->load->model('dataclass/contactInfo_d');
		$result = [
			$this->contactInfo_d->colId			=> 0,
			$this->contactInfo_d->colName		=> '',
			$this->contactInfo_d->colEmail		=> '',
			$this->contactInfo_d->colFkIccCard	=> 0,
		];

		return $result;
	}
	private function GetTemplateEntangledAnimalForInputDisplay() {
		$this->load->model('dataclass/entangledAnimal_d');
		$result = [
			$this->entangledAnimal_d->colId					=> 0,
			$this->entangledAnimal_d->colName				=> '',
			$this->entangledAnimal_d->colFkAnimalStatus		=> 0,
			$this->entangledAnimal_d->colEntangledFlag		=> 0,
			$this->entangledAnimal_d->colEntangledDebris	=> '',
			$this->entangledAnimal_d->colFkIccCard			=> 0,
		];

		return $result;
	}
	private function GetTemplateGeoLocationForInputDisplay() {
		// ICC Card - Contact Info
		$this->load->model('dataclass/geoLocation_d');
		$result = [
			$this->geoLocation_d->colId			=> 0,
			$this->geoLocation_d->colLatitude	=> '',
			$this->geoLocation_d->colLongitude	=> '',
			$this->geoLocation_d->colFkIccCard	=> 0,
		];

		return $result;
	}


    // ----------------------------------------------------- Get For Combobox ------------------------------------
	public function GetDataForComboBox($fkProvinceCode=null) {
		$result['dsCleanupType'] = $this->GetDsCleanupType();
		$result['dsDistanceUnit'] = $this->GetDsDistanceUnit();
		$result['dsWeightUnit'] = $this->GetDsWeightUnit();
		$result['dsAnimalStatus'] = $this->GetDsAnimalStatus();

		$result['dsProvince'] = $this->GetDsProvince();
		$result['dsAmphur'] = $this->GetDsAmphur($fkProvinceCode);
		
		return $result;
	}



	

    // ----------------------------------------------------------- Save ------------------------------------------
    // ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ Prepare Data ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	private function PrepareDataMasterTable($dsData) {
		$this->load->model('dataclass/iccCard_d');

		$dsResult['data'] = $dsData;
		unset($dsResult['data']['geoLocationId']);
		unset($dsResult['data']['Lat']);
		unset($dsResult['data']['Lon']);
		$dsResult['data']['Event_Date'] = date('Y-m-d H:i:s', strtotime($dsResult['data']['Event_Date'])); ;
		$dsResult['data'][$this->iccCard_d->colUpdateBy] = $this->session->userdata['id'];


		$dsResult['tableName'] = $this->iccCard_d->tableName;
		$dsResult['objCreateBy'] = [$this->iccCard_d->colCreateBy => $this->session->userdata['id']];

		return $dsResult;
	}
	private function PrepareDataContactInfoDetailTable($dsData) {
		$this->load->model('dataclass/contactInfo_d');
		$dsResult['data'] = $dsData;
		$dsResult['tableName'] = $this->contactInfo_d->tableName;

		return $dsResult;
	}
	private function PrepareDataEntangledAnimalDetailTable($dsData) {
		$this->load->model('dataclass/entangledAnimal_d');
		$dsResult['data'] = $dsData;
		$dsResult['tableName'] = $this->entangledAnimal_d->tableName;

		return $dsResult;
	}
	private function PrepareDataGarbageTransactionDetailTable($dsData, $idMaster) {
		$this->load->model('dataclass/garbageTransaction_d');
		$dsResult['data'] = $dsData;
		$dsResult['tableName'] = $this->garbageTransaction_d->tableName;
		$dsResult['arrWhereForFind'] = [
			$this->garbageTransaction_d->colFkGarbage	=>	0,
			$this->garbageTransaction_d->colFkIccCard	=>	$idMaster
		];
		
		return $dsResult;
	}
	private function PrepareDataGeoLocationDetailTable($dsData) {
		$this->load->model('dataclass/geoLocation_d');
		$dsResult['data'][0] = [
			$this->geoLocation_d->colId => $dsData['geoLocationId'],
			$this->geoLocation_d->colLatitude 		=> $dsData[$this->geoLocation_d->colLatitude],
			$this->geoLocation_d->colLongitude 		=> $dsData[$this->geoLocation_d->colLongitude],
		];
		$dsResult['tableName'] = $this->geoLocation_d->tableName;
		$dsResult['sqlUpdateGeolocationPoint'] = "UPDATE "
											. $this->geoLocation_d->tableName . " SET " 
											. $this->geoLocation_d->colGeolocation . " = point("
											. $this->geoLocation_d->colLongitude . ", "
											. $this->geoLocation_d->colLatitude . ") WHERE "
											. $this->geoLocation_d->colFkIccCard . "=";

		return $dsResult;
	}

    // ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ Process Save ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    public function Save($idMaster, $dsData) {
		$dsMaster = $this->PrepareDataMasterTable($dsData['dsIccCardMaster']);

		$dsDetail[0] = $this->PrepareDataContactInfoDetailTable($dsData['dsContactInfo']);
		$dsDetail[1] = $this->PrepareDataEntangledAnimalDetailTable($dsData['dsEntangledAnimal']);
		$dsDetail[2] = $this->PrepareDataGarbageTransactionDetailTable($dsData['dsGarbageTransaction'], $idMaster);
		$dsDetail[3] = $this->PrepareDataGeoLocationDetailTable($dsData['dsIccCardMaster']);

		$this->load->model('db_m');
		$result = $this->SaveMasterDetail($idMaster, $dsMaster, $dsDetail, $this->contactInfo_d->colFkIccCard);

		return $result;
	}

	public function SaveMasterDetail($idMaster, $dsMaster, $dsDetail, $colFkId) {
		$result = false;
		$resultMaster = false;
		$this->load->model('db_m');
		// Start transcation.
		$this->db_m->TransStart();

		if( (count($dsMaster) > 0) && (count($dsDetail) > 0) ) {			// validate have data to save.

		// Master table.
			$dsDataMaster = $dsMaster['data'];
			$this->db_m->tableName = $dsMaster['tableName'];
			$resultMaster = $this->db_m->Save($idMaster, $dsDataMaster, $dsMaster['objCreateBy']);
		// End Master table

			if($resultMaster) {
				if($idMaster <= 0) {
					$idMaster = $this->db_m->insertId;
				}

			// Detail table.
				$r = 0;
				foreach($dsDetail as $dsOneTableDetail) {
				// One by One Detail Table.
					$tableNameDetail = $dsOneTableDetail['tableName'];
					$this->db_m->tableName = $tableNameDetail;

					if( !empty($dsOneTableDetail['data']) ) {
						$dsDataDetail = $dsOneTableDetail['data'];
						$arrIdDetailExist = Array();
						foreach($dsDataDetail as $rowDataDetail) {
						// One by One Record Detail Table.
							$rowIdDetail = $rowDataDetail['id'];
							unset($rowDataDetail['id']);
							$rowDataDetail[$colFkId] = $idMaster;

						// Find record in Database.
							if( isset($dsOneTableDetail['arrWhereForFind']) ) {
								$dsOneTableDetail['arrWhereForFind'][$this->garbageTransaction_d->colFkGarbage]
															= $rowDataDetail[$this->garbageTransaction_d->colFkGarbage];
								$dsOneTableDetail['arrWhereForFind'][$this->garbageTransaction_d->colFkIccCard] = $idMaster;

								$exist = $this->db_m->Find( $dsOneTableDetail['arrWhereForFind'] );
								if($exist && isset($this->db_m->dataSet)) {
									$rowIdDetail = $this->db_m->dataSet[0]['id'];
								}
							} else {
								$exist = $this->db_m->Find( ['id' => $rowIdDetail] );
							}
						// Manipulate Record.
							if($exist) {
								if( $this->db_m->UpdateRow($rowIdDetail, $rowDataDetail) ) {
									$arrResultDetail[$r++] = true;
								} else {
									$arrResultDetail[$r++] = false;
									break 2;
								}
							} else {
								if( $this->db_m->CreateRow($rowDataDetail) ) {
									$arrResultDetail[$r++] = true;
									$rowIdDetail = $this->db_m->insertId;
								} else {
									$arrResultDetail[$r++] = false;
									break 2;
								}
							}

						// Special update column point.
							if( isset($dsOneTableDetail['sqlUpdateGeolocationPoint']) ) {
								if( $this->db_m->UpdateRowPointColumn($idMaster
								, $dsOneTableDetail['sqlUpdateGeolocationPoint'])) {
									$arrResultDetail[$r++] = true;
								} else {
									$arrResultDetail[$r++] = false;
									break 2;
								}
							}
							array_push($arrIdDetailExist, $rowIdDetail);
						}
					}
				
				// Inactive transaction at row not used of table.
					$arrIdDetailExist = ( isset($arrIdDetailExist) ? $arrIdDetailExist : Array(-1) );
					if( $this->db_m->InactiveTransactionRow($idMaster, $arrIdDetailExist) ) {
						$arrResultDetail[$r++] = true;
					} else {
						$arrResultDetail[$r++] = false;
						break 1;
					}
				}
			}

		// Check all result status
			if (isset($arrResultDetail)) {
				$resultDetail = true;
				foreach($arrResultDetail as $rowResultDetail) {
					if(!$rowResultDetail) {
						$resultDetail = false;
						break 1;
					}
					$result = $resultMaster && $resultDetail;
				}
			}
		}

		// Last Transaction For Check commit or rollback.
		if ($this->db_m->TransStatus() && $result) {
			$this->db_m->TransComplete();
		} else {
			$this->db_m->TransRollback();
		}
		// End Transaction.

		return $result;
	}
// End Public function.





// Private function.
	// ------------------------------------------------------ Load model file ------------------------------------
	private function LoadModelGarbageForSetInputDisplay() {
		$this->load->model('dataclass/garbageTransaction_d');
		$this->load->model('dataclass/garbage_d');
		$this->load->model('dataclass/garbageType_d');
	}
	
    // ---------------------------------------------------- Get DB to combobox -----------------------------------
    // ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ Cleanup_Type table ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    private function GetDsCleanupType($id=null) {
		$this->load->model("dataclass/cleanupType_d");
		$this->load->model("db_m");

		$this->db_m->tableName = $this->cleanupType_d->tableName;
		$this->db_m->sequenceColumn = $this->cleanupType_d->colName;
		$dataSet = $this->db_m->GetRowById($id, null);
    
    	return $dataSet;
    }
    // ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ Distance Unit table ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    private function GetDsDistanceUnit($id=null) {
		$this->load->model("dataclass/distanceUnit_d");
		$this->load->model("db_m");

		$this->db_m->tableName = $this->distanceUnit_d->tableName;
		$this->db_m->sequenceColumn = $this->distanceUnit_d->colName;
		$dataSet = $this->db_m->GetRowById($id, null);
    
    	return $dataSet;
    }
    // ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ Weight Unit table ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    private function GetDsWeightUnit($id=null) {
		$this->load->model("dataclass/weightUnit_d");
		$this->load->model("db_m");

		$this->db_m->tableName = $this->weightUnit_d->tableName;
		$this->db_m->sequenceColumn = $this->weightUnit_d->colName;
		$dataSet = $this->db_m->GetRowById($id, null);
    
    	return $dataSet;
	}
	
    // ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ Animal Status table ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    private function GetDsAnimalStatus($id=null) {
		$this->load->model("dataclass/animalStatus_d");
		$this->load->model("db_m");

		$this->db_m->tableName = $this->animalStatus_d->tableName;
		$this->db_m->sequenceColumn = $this->animalStatus_d->colName;
		$dataSet = $this->db_m->GetRowById($id, null);
    
    	return $dataSet;
    }


	// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ Amphur Table ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	// This public method.
    public function GetDsAmphur($fkProvinceCode=null) {
		$this->load->model("dataclass/amphur_d");
		$this->load->model("db_m");

		$this->db_m->tableName = $this->amphur_d->tableName;
		$this->db_m->sequenceColumn = $this->amphur_d->colAmphurName;
		$this->db_m->colId = $this->amphur_d->colProvinceCode;
		$fkProvinceCode = ( ($fkProvinceCode < 1) ? null : $fkProvinceCode);

		$dataSet = $this->db_m->GetRowById($fkProvinceCode, null);
    
    	return $dataSet;
    }
	// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ Province Table ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    private function GetDsProvince($id=null) {
		$this->load->model("dataclass/province_d");
		$this->load->model("db_m");

		$this->db_m->tableName = $this->province_d->tableName;
		$this->db_m->sequenceColumn = $this->province_d->colProvinceName;
		$dataSet = $this->db_m->GetRowById(null, null);
    
    	return $dataSet;
    }



    // ----------------------------------------------- Get DB for render garbage ---------------------------------
	private function GetDsGarbageIncludeTransactionAndTypeGrouping($fkIccCardId=null) {
		$this->LoadModelGarbageForSetInputDisplay();
		$this->load->model('helper_m');

		// Group.
		$sqlStrGroup = "SELECT gt." . $this->garbageType_d->colPriority
						. " FROM " . $this->garbageType_d->tableName . " AS gt"
						. " ORDER BY gt." . $this->garbageType_d->colPriority;
		// Execute sql.
		$this->load->model('db_m');
		$resultGroup = $this->db_m->GetRow($sqlStrGroup);


		// Loop.
		$i = 0;
		foreach($resultGroup as $row) {
			// Create sql string.
			$sqlStr = "SELECT g." . $this->garbage_d->colId
					. ", gt." . $this->garbageType_d->colName . " AS garbageTypeName"
					. ", g." . $this->garbage_d->colName
					. ", gs." . $this->garbageTransaction_d->colId . " AS GarbageTransactionId"
					. ", gs." . $this->garbageTransaction_d->colGarbageQty

					. " FROM " . $this->garbageType_d->tableName . " AS gt"
					
					. " LEFT JOIN " . $this->garbage_d->tableName . " AS g"
					. " ON gt." . $this->garbageType_d->colId
					. "=g." . $this->garbage_d->colFkGarbageType

					. " LEFT JOIN " . $this->garbageTransaction_d->tableName . " AS gs"
					. " ON g." . $this->garbage_d->colId
					. "=gs." . $this->garbageTransaction_d->colFkGarbage
					. " AND gs." . $this->garbageTransaction_d->colActive . "=1"
					. " AND gs." . $this->garbageTransaction_d->colFkIccCard . "=" . $fkIccCardId

					. " WHERE gt." . $this->garbageType_d->colPriority
					. "=" . $row[$this->garbageType_d->colPriority]

					. " ORDER BY gt." . $this->garbageType_d->colPriority
					. ", g." . $this->garbage_d->colName;
			// Execute sql.
			$this->load->model('db_m');
			$result[$i++] = $this->db_m->GetRow($sqlStr);
		}
	
    	return $result;
	}
// End Private function.
}