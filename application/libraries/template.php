<?php 

class template
{
    /**
     * summary
     */
    function __construct()
    {
        $this->ci =&get_instance();
    }

    function admin($template, $data= ''){
    	$data['head'] = $this->ci->load->view('init/head', $data, TRUE);
        $data['content'] = $this->ci->load->view($template, $data, TRUE);
        $data['sidebar'] = $this->ci->load->view('init/menu-admin', $data, TRUE);
        $data['footer'] = $this->ci->load->view('init/footer', $data, TRUE);
    	$this->ci->load->view('admin/dashboard', $data);
    }

    function guru($template, $data= ''){
        $data['head'] = $this->ci->load->view('init/head', $data, TRUE);
        $data['content'] = $this->ci->load->view($template, $data, TRUE);
        $data['sidebar'] = $this->ci->load->view('init/menu-guru', $data, TRUE);
        $data['footer'] = $this->ci->load->view('init/footer', $data, TRUE);
        $this->ci->load->view('guru/dashboard', $data);
    }

    function ortu($template, $data= ''){
        $data['head'] = $this->ci->load->view('init/head', $data, TRUE);
        $data['content'] = $this->ci->load->view($template, $data, TRUE);
        $data['sidebar'] = $this->ci->load->view('init/menu-ortu', $data, TRUE);
        $data['footer'] = $this->ci->load->view('init/footer', $data, TRUE);
        $this->ci->load->view('ortu/dashboard', $data);
    }

    function siswa($template, $data= ''){
        $data['head'] = $this->ci->load->view('init/head', $data, TRUE);
        $data['content'] = $this->ci->load->view($template, $data, TRUE);
        $data['sidebar'] = $this->ci->load->view('init/menu-siswa', $data, TRUE);
        $data['footer'] = $this->ci->load->view('init/footer', $data, TRUE);
        $this->ci->load->view('siswa/dashboard', $data);
    }
}
 ?>