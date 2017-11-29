<?php 
    // Plugin.
    echo $map['js'];
    // Shared Css.
    $this->load->view('template/sharedCss_v');
    // My Css.
    echo css_asset('iccCard/stylesheet.css');
?>