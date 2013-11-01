<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	public function index($seccion='')
	{
	    $data['seccion']='home';
            $data["nobarra"]=TRUE;
            $data["titulo"][0]=$this->load->view('slideshow','',TRUE);
            $data["subtitulo"][0]='';
            $data["contenido"][0]='';

            $data["titulo"][1]="Bienvenidos";
            $data["subtitulo"][1]="Bienvenidos";
            $data["contenido"][1]="<br><br>Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos Bienvenidos
                ";

	    $this->load->view('template',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */