<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
// Set the class variable.
    private $dataTemplate = array();
    public $data = array();
    public $lastBreadcrumbCaption;
    private $rBreadcrumb = array(
        "report" => array(
            array(
                "caption"   => "รายงานข้อมูลขยะทะเล",
                "link"      => "report/overviewReport",
            )
        ),
        "publicRelations" => array(
            array(
                "caption"   => "ข่าวสารโครงการ",
                "link"      => "publicRelations/articleCategory/1/0",
            )
        ),
        "eventImage" => array(
            array(
                "caption"   => "ภาพกิจกรรม",
                "link"      => "eventImage/gallery/-1",
            )
        ),
        "mapPlace" => array(
            array(
                "caption"   => "แผนที่การทำกิจกรรม",
                "link"      => "mapPlace",
            )
        ),
        "Gallery" => array(
            array(
                "caption"   => "แผนที่การทำกิจกรรม",
                "link"      => "mapPlace",
            )
        ),
    );
// End Set the class variable.

// Set default variable.
    public $extendedCss = '';
    public $header = '';
    public $body = '';
    public $footer = '';
    public $extendedJs = '';
// End Set default variable.

// Set default condition variable.
    public $useCssTemplate = true;
    public $useJsTemplate = true;
    public $useJsTemplateHeadTag = false;

    public $isHomePage = false;
// Set default condition variable.


// public method.
    // ************************************************* Load template *********************************
    protected function renderWithTemplate() {
        // Set Breadcrumb.
        $breadcrumb = NULL;
        if($this->uri->rsegment_array()[1] !== "index") {
            if(array_key_exists($this->uri->rsegment_array()[1], $this->rBreadcrumb)) {
                $breadcrumb = $this->rBreadcrumb[$this->uri->rsegment_array()[1]];
                $countBreadCrumb = count($breadcrumb);

                if ($this->lastBreadcrumbCaption === NULL) {
                    $breadcrumb[$countBreadCrumb-1]["link"] = NULL;
                } else {
                    $breadcrumb[$countBreadCrumb]["caption"] = $this->lastBreadcrumbCaption;
                    $breadcrumb[$countBreadCrumb]["link"] = NULL;
                }
            }
        }
        // Set default data.
        $this->dataTemplate['level'] = ( ($this->session->userdata('level')) ? $this->session->userdata('level') : 0 );
        // making temlate and send data to view.
        $this->dataTemplate['breadcrumb'] = $breadcrumb;
        $this->dataTemplate['useCssTemplate'] = $this->useCssTemplate;
        $this->dataTemplate['useJsTemplate'] = $this->useJsTemplate;
        $this->dataTemplate['useJsTemplateHeadTag'] = $this->useJsTemplateHeadTag;

        $this->dataTemplate['extendedCss'] = ((($this->extendedCss != null) && ($this->extendedCss != ''))
            ? $this->load->view($this->extendedCss, $this->data, true) : '');

        $this->dataTemplate['header'] = ((($this->header != null) && ($this->header != ''))
            ? $this->load->view($this->header, $this->data, true) : '');

        $this->dataTemplate['body'] = ((($this->body != null) && ($this->body != ''))
            ? $this->load->view($this->body, $this->data, true) : '');

        $this->dataTemplate['footer'] = ((($this->footer != null) && ($this->footer != ''))
            ? $this->load->view($this->footer, $this->data, true) : '');

        $this->dataTemplate['extendedJs'] = ((($this->extendedJs != null) && ($this->extendedJs != ''))
            ? $this->load->view($this->extendedJs, $this->data, true) : '');

        if($this->isHomePage) {
            $this->load->view('template/index_v', $this->dataTemplate);
        } else {
            $this->load->view('template/index_v', $this->dataTemplate);
        }
    }
    protected function renderWithTemplate3() {
        
		

        $this->dataTemplate['extendedCss'] = ((($this->extendedCss != null) && ($this->extendedCss != ''))
            ? $this->load->view($this->extendedCss, $this->data, true) : '');

        $this->dataTemplate['header'] = ((($this->header != null) && ($this->header != ''))
            ? $this->load->view($this->header, $this->data, true) : '');

        $this->dataTemplate['body'] = ((($this->body != null) && ($this->body != ''))
            ? $this->load->view($this->body, $this->data, true) : '');

        $this->dataTemplate['footer'] = ((($this->footer != null) && ($this->footer != ''))
            ? $this->load->view($this->footer, $this->data, true) : '');

        $this->dataTemplate['extendedJs'] = ((($this->extendedJs != null) && ($this->extendedJs != ''))
            ? $this->load->view($this->extendedJs, $this->data, true) : '');
	//print_r( $this->data['rIccCardStatus']);exit;

            $this->load->view('template/admin_template', $this->dataTemplate);

    }


    protected function renderWithTemplate2() {

        // Set Breadcrumb.
        $breadcrumb = NULL;
        if($this->uri->rsegment_array()[1] !== "index") {
            if(array_key_exists($this->uri->rsegment_array()[1], $this->rBreadcrumb)) {
                $breadcrumb = $this->rBreadcrumb[$this->uri->rsegment_array()[1]];
                $countBreadCrumb = count($breadcrumb);

                if ($this->lastBreadcrumbCaption === NULL) {
                    $breadcrumb[$countBreadCrumb-1]["link"] = NULL;
                } else {
                    $breadcrumb[$countBreadCrumb]["caption"] = $this->lastBreadcrumbCaption;
                    $breadcrumb[$countBreadCrumb]["link"] = NULL;
                }
            }
        }
        // Set default data.
        $this->dataTemplate['level'] = ( ($this->session->userdata('level')) ? $this->session->userdata('level') : 0 );
        // making temlate and send data to view.
        $this->dataTemplate['breadcrumb'] = $breadcrumb;
        $this->dataTemplate['useCssTemplate'] = $this->useCssTemplate;
        $this->dataTemplate['useJsTemplate'] = $this->useJsTemplate;
        $this->dataTemplate['useJsTemplateHeadTag'] = $this->useJsTemplateHeadTag;

        $this->dataTemplate['extendedCss'] = ((($this->extendedCss != null) && ($this->extendedCss != ''))
            ? $this->load->view($this->extendedCss, $this->data, true) : '');

        $this->dataTemplate['header'] = ((($this->header != null) && ($this->header != ''))
            ? $this->load->view($this->header, $this->data, true) : '');

        $this->dataTemplate['body'] = ((($this->body != null) && ($this->body != ''))
            ? $this->load->view($this->body, $this->data, true) : '');

        $this->dataTemplate['footer'] = ((($this->footer != null) && ($this->footer != ''))
            ? $this->load->view($this->footer, $this->data, true) : '');

        $this->dataTemplate['extendedJs'] = ((($this->extendedJs != null) && ($this->extendedJs != ''))
            ? $this->load->view($this->extendedJs, $this->data, true) : '');

        if($this->isHomePage) {
            $this->load->view('template/welcome_index', $this->dataTemplate);
        } else {
            $this->load->view('template/welcome_index', $this->dataTemplate);
        }

    }


	// *************************************************** Check logged ********************************
	protected function is_logged() {
            /*
		if(!$this->session->userdata('id')){
			$this->logout();
			return false;
		} else {
                    
			
		}*/
                return true;
	}
	protected function logout() {
        $this->session->sess_destroy();
        redirect("index");
    }
    // **************************************************** End logged *********************************
// End public method.
}