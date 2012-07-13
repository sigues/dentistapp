<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paciente extends CI_Controller {
	public function index()
	{
	    $this->load->library('session');
	    $usuario = $this->session->userdata("usuario");
	    if(isset($_POST["entrar"])){
		$login = $this->login($_POST["usuario"],$_POST["contrasena"]);
	    }
	    if($usuario==FALSE){
		$data["titulo"][0]="Inicio de Sesión";
		$data["subtitulo"][0]="Si aún no cuenta con acceso favor de pedirlo en la clínica.";
		$data["contenido"][0]=$this->load->view('login','',true);
	    }else{
		
	    }
	    $data['seccion']='paciente';
	    $this->load->view('template',$data);
	}
	
	public function login(){
	    
	}
}