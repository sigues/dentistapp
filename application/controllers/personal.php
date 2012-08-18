<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal extends CI_Controller {
    var $usuario;
    var $contrasena;
    var $puesto;

    public function index()
    {
        $usuario = $this->session->userdata("idempleado");
        if(isset($_POST["entrar"])){
            $this->usuario = $_POST["usuario"];
            $this->contrasena = $_POST["contrasena"];
            $login = $this->login();
            if ($login === TRUE){
                $data["error"][0] = '';
                $usuario = $this->session->userdata("idempleado");
            } elseif ($login == 'error'){
                $data["error"][0] = "Usuario o Contraseña Incorrectos";
            } elseif ($login === FALSE){
                $data["error"][0] = "Debe introducir su usuario y contraseña correctamente para continuar";
            }
        }
        if($usuario === FALSE){
            $data["titulo"][0]="Inicio de Sesión de Personal";
            $data["subtitulo"][0]="Si aún no cuenta con acceso favor de pedirlo en la clínica.";
            $data["contenido"][0]=$this->load->view('login','',true);
            $data['seccion']='personal';
            $this->load->view('template',$data);
        }else{
            $this->controlPanel();
        }
    }

    public function login(){
        if(isset($this->usuario) && isset($this->contrasena) && $this->usuario != '' && $this->contrasena != ''){
            $query = $this->db->get_where('empleado',array('correo'=>$this->usuario,'contrasena'=>md5($this->contrasena)),1);
            if(sizeof($query->result())>0){
                foreach ($query->result() as $row){
                    $userdata = array("idempleado"   => $row->idempleado,
                                      "correo"      => $row->correo,
                                      "puesto"      => $row->puesto);
                    $this->session->set_userdata($userdata);
                    $this->puesto = $row->puesto;
                    return TRUE;
                }
            } else {
                return 'error';
            }
        } else {
            return FALSE;
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        $this->session->unset_userdata("idempleado");
        redirect('/personal','location');
    }

    public function controlPanel(){
        $puesto = $this->session->userdata("puesto");
        $data["titulo"][0] = "Panel de Control de ".$puesto;
        $data["subtitulo"][0] = "Desde este panel podrá administrar sus opciones en el sistema";
        if($puesto == 'dentista'){
            $data["contenido"][0] = $this->load->view('controlPanelDentista','',true);
        }elseif($puesto == 'recepcionista'){
            $data["contenido"][0] = $this->load->view('controlPanelRecepcionista','',true);
        }
        $data['seccion']='personal';
        $this->load->view('template',$data);
    }

    public function altaEmpleados(){
        if($_POST){
            $data = $this->alta();
        }else{
        	$data["titulo"][0] = "<span id='tituloAltaEmpleado'>Alta de empleado</span>";
			$data["subtitulo"][0] = "Por favor llene los siguientes datos";
			$data["contenido"][0] = $this->load->view('altaEmpleados',"",TRUE);
			$data["titulo"][1] = "Listado de empleados";
			$data["subtitulo"][1] = "Listado de empleados";
			$data["contenido"][1] = "<div id='listadoEmpleados'></div>";
			$data['seccion']='personal';
			$this->load->view("template",$data);
        }
    }
    
    public function getEmpleadoJSON(){
    	$idempleado = $this->uri->segment(3);
		$empleado = $this->db->get_where("empleado",array("idempleado"=>$idempleado));
		foreach($empleado->result() as $row){
			$respuesta=$row;
                        $respuesta->fechaNacimiento=date("m/d/Y",strtotime($respuesta->fechaNacimiento));
		}
		echo json_encode($respuesta);
    }

    public function alta(){
        $this->load->library('form_validation');
        $tipo = $_POST["tipo"];
		if($tipo != "editar"){
            $this->form_validation->set_rules('correo', 'Correo Electrónico', 'trim|required|valid_email|is_unique[empleado.correo]');
            $this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|required|md5');
        } else {
            $empleados = $this->db->get_where("empleado",array("correo"=>trim($_POST["correo"]),
                                                        "idempleado !="=>$_POST["idempleado"]));
		    $correoRepetido=0;
            foreach($empleados->result() as $empleado){
                $correoRepetido++;
            }
            $this->form_validation->set_rules('correo', 'Correo Electrónico', 'trim|required|valid_email');
            $this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|md5');
        }
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|max_length[45]');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('fechaNacimiento', 'Fecha de Nacimiento', 'trim|required|date');
        $this->form_validation->set_rules('puesto', 'Puesto', 'trim|required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'trim');
        $this->form_validation->set_rules('idempleado', 'idempleado', 'trim');

        if ($this->form_validation->run() == FALSE || $correoRepetido>0)
        {
                echo 'KO';
                echo (form_error('nombre')!="")?"###nombre":"";
                echo (form_error('apellidos')!="")?"###apellidos":"";
                echo (form_error('correo')!="")?"###correo":"";
                echo (form_error('contrasena')!="")?"###contrasena":"";
                echo (form_error('fechaNacimiento')!="")?"###fechaNacimiento":"";
                echo (form_error('puesto')!="")?"###puesto":"";
                if($correoRepetido>0){
                    echo "###correo";
                }
        }
        else
        {
                $data["nombre"]=set_value('nombre');
                $data["apellidos"]=set_value('apellidos');
                $data["contrasena"] = set_value('contrasena');
                $data["correo"] = set_value('correo');
                $data["fechaNacimiento"] = date("Y-m-d",strtotime(set_value('fechaNacimiento')));
                $data["puesto"] = set_value('puesto');
                $idempleado = set_value('idempleado');
                $tipo = set_value('tipo');
                if($tipo == "editar"){
                    if($data["contrasena"]==""){
                        unset($data["contrasena"]);
                    }
                    $this->db->where("idempleado",$idempleado);
                    $this->db->update("empleado",$data);
                } else {
                    $this->db->insert("empleado",$data);
                }
                echo 'OK';
        }
        
    }

    public function listadoEmpleados(){
        $data["empleados"] = $this->db->get_where("empleado",array("activo"=>"si"));
        $data["idpersonal"] = $this->session->userdata("idempleado");
        $this->load->view("listadoEmpleados",$data);
    }

    public function eliminaEmpleado(){
        $idempleado = $_POST["idempleado"];
        $data = array(
               'activo' => "no"
            );
        $this->db->where('idempleado', $idempleado);
        $this->db->update('empleado', $data);
        echo 'OK';
    }

/*
 * Paciente
 */

    public function altaPacientes(){
        if($_POST){
            $data = $this->altaPaciente();
        }else{
        	$data["titulo"][0] = "<span id='tituloAltaPaciente'>Alta de paciente</span>";
			$data["subtitulo"][0] = "Por favor llene los siguientes datos";
			$data["contenido"][0] = $this->load->view('altaPacientes',"",TRUE);
			$data["titulo"][1] = "Listado de pacientes";
			$data["subtitulo"][1] = "Listado de pacientes";
			$data["contenido"][1] = "<div id='listadoPacientes'></div>";
			$data['seccion']='personal';
			$this->load->view("template",$data);
        }
    }
	
    public function altaPaciente(){
            $this->load->library('form_validation');
            $tipo = $_POST["tipo"];
            $correoRepetido=0;
                
            if($tipo != "editar"){
                $this->form_validation->set_rules('correo', 'Correo Electrónico', 'trim|required|valid_email|is_unique[paciente.correo]');
            } else {
                $pacientes = $this->db->get_where("paciente",array("correo"=>trim($_POST["correo"]),
                                                            "idpaciente !="=>$_POST["idpaciente"]));
                foreach($pacientes->result() as $paciente){
                	    $correoRepetido++;
                }
                $this->form_validation->set_rules('correo', 'Correo Electrónico', 'trim|required|valid_email');
            }

            $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|max_length[45]');
            $this->form_validation->set_rules('apellidoPaterno', 'Apellido Paterno', 'trim|required|min_length[3]|max_length[60]');
            $this->form_validation->set_rules('apellidoMaterno', 'Apellido Materno', 'trim|required|min_length[3]|max_length[60]');
            $this->form_validation->set_rules('fechaNacimiento', 'Fecha de Nacimiento', 'trim|required|date');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'trim|min_length[5]|max_length[10]');
            $this->form_validation->set_rules('celular', 'Celular', 'trim|min_length[5]|max_length[10]');
            $this->form_validation->set_rules('direccion', 'Direccion', 'trim|min_length[5]|max_length[80]');
            $this->form_validation->set_rules('tipo', 'Tipo', 'trim');
            $this->form_validation->set_rules('idpaciente', 'idpaciente', 'trim');

            if ($this->form_validation->run() == FALSE || $correoRepetido>0)
            {
                    echo 'KO';
					echo (form_error('nombre')!="")?"###nombre":"";
                    echo (form_error('apellidoPaterno')!="")?"###apellidoPaterno":"";
                    echo (form_error('apellidoMaterno')!="")?"###apellidoMaterno":"";
                    echo (form_error('correo')!="")?"###correo":"";
                    echo (form_error('fechaNacimiento')!="")?"###fechaNacimiento":"";
                    echo (form_error('telefono')!="")?"###telefono":"";
                    echo (form_error('celular')!="")?"###celular":"";
                    echo (form_error('direccion')!="")?"###direccion":"";
                    echo (form_error('fechaNacimiento')!="")?"###fechaNacimiento":"";
                    echo (form_error('tipo')!="")?"###tipo":"";
                    echo (form_error('idpaciente')!="")?"###idpaciente":"";
                    if($correoRepetido>0){
                        echo "###correo";
                    }
            }
            else
            {
                    $data["nombre"]=set_value('nombre');
                    $data["apellidoPaterno"]=set_value('apellidoPaterno');
                    $data["apellidoMaterno"]=set_value('apellidoMaterno');
                    $data["correo"] = set_value('correo');
                    $data["direccion"] = set_value('direccion');
                    $data["telefono"] = set_value('telefono');
                    $data["celular"] = set_value('celular');
                    $data["fechaNacimiento"] = date("Y-m-d",strtotime(set_value('fechaNacimiento')));
                    $data["contrasena"] = md5('abc123');
                    $idpaciente = set_value('idpaciente');
                    $tipo = set_value('tipo');
                    if($tipo == "editar"){
                        if($data["contrasena"]==""){
                            unset($data["contrasena"]);
                        }
                        $this->db->where("idpaciente",$idpaciente);
                        $this->db->update("paciente",$data);
                    } else {
                        $this->db->insert("paciente",$data);
                    }
                    echo 'OK';
            }
    }

    public function listadoPacientes(){
            $data["pacientes"] = $this->db->get_where("paciente",array("activo"=>'si'));
            $this->load->view("listadoPacientes",$data);
    }

    public function getPacienteJSON(){
    	$idpaciente = $this->uri->segment(3);
        $paciente = $this->db->get_where("paciente",array("idpaciente"=>$idpaciente));
        foreach($paciente->result() as $row){
                $respuesta=$row;
                $respuesta->fechaNacimiento=date("m/d/Y",strtotime($respuesta->fechaNacimiento));
        }
        echo json_encode($respuesta);
    }

    public function getPacienteByNombre($nombrePaciente){
        $this->db->from("paciente");
        $this->db->where("concat(nombre,' ',apellidoPaterno,' ',apellidoMaterno) = '$nombrePaciente'");
        $pacientes = $this->db->get();
        foreach ($pacientes->result() as $paciente){
            $pac = $paciente;
        }
        return $pac;
    }

    public function eliminaPaciente(){
        $idpaciente = $_POST["idpaciente"];
        $data = array(
               'activo' => "no"
            );
        $this->db->where('idpaciente', $idpaciente);
        $this->db->update('paciente', $data);
        echo 'OK';
    }

    public function buscaPaciente(){
        $cadena = $this->uri->segment(3);//$_POST["cadena"];
        $cadena = $_GET["term"];
        $condiciones["activo"]="si";
        if($cadena != ""){
            $this->db->where("(nombre like '%$cadena%' OR apellidoPaterno like '%$cadena%' OR apellidoMaterno like '%$cadena%'
                            OR concat(nombre,' ',apellidoPaterno,' ',apellidoMaterno) LIKE '%$cadena%')");
        }
        $this->db->where("activo","si");
        $data["pacientes"] = $this->db->get("paciente");
        $this->load->view("buscaPaciente",$data);
    }

/*
 *
 *          AGENDA
 *
 */

    public function agenda(){
        $data["titulo"][0]="Agenda";
        $data["subtitulo"][0]="Citas de los pacientes";
        $this->db->select('*');
        $this->db->from('cita');
        $this->db->join('paciente', 'cita.paciente_idpaciente = paciente.idpaciente');
        $data["citas"] = $this->db->get()->result();
        $data["empleados"] = $this->db->get_where("empleado", array("puesto"=>"dentista","activo"=>"si"))->result();
        $this->db->where('cita.estado','pendiente');
        $data["scriptAjax"]=$this->load->view('ajax/citas',$data,TRUE);
        $data["contenido"][0]=$this->load->view('agenda',$data,TRUE);
        $data["seccion"]="personal";
        $this->load->view('template',$data);
    }
    
    public function agendaAjax(){
        $idempleado = intval($_POST["personal"]);
        $this->db->select('*');
        $this->db->from('cita');
        $this->db->join('paciente', 'cita.paciente_idpaciente = paciente.idpaciente');
        if($idempleado>0){
            $this->db->where('empleado_idempleado',$idempleado);
        }
        $this->db->where('cita.estado','pendiente');
        $data["citas"] = $this->db->get()->result();
        $this->load->view('ajax/citas',$data);
    }

    public function verCita(){
        $data["id"] = $this->uri->segment(3);
        $this->db->select("cita.*");
        $this->db->select("paciente.*");
        $this->db->select("paciente.nombre nombrePaciente");
        $this->db->select("empleado.*");
        $this->db->select("empleado.nombre nombreEmpleado");
        $this->db->select("procedimiento.nombre nombreProcedimiento");
        $this->db->from("cita");
        $this->db->join("paciente","paciente.idpaciente = cita.paciente_idpaciente");
        $this->db->join("empleado","empleado.idempleado = cita.empleado_idempleado");
        $this->db->join("procedimiento","procedimiento.idprocedimiento = cita.procedimiento_idprocedimiento");
        $this->db->where("cita.idcita",$data["id"]);
        $data["cita"] = $this->db->get()->result();
        //print_r($data["cita"]);
        $this->load->view('verCita',$data);
    }

/*
 * Expediente
 */

    public function expediente(){
        $data["idpaciente"] = $this->uri->segment(3);
        $paciente = $this->db->get_where("paciente",array("idpaciente"=>$data["idpaciente"]));
        foreach($paciente->result() as $pac){
            $data["paciente"]=$pac;
        }
        $this->db->select("cita.*");
        $this->db->select("procedimiento.nombre nombreProcedimiento");
        $this->db->from("cita");
        $this->db->join("procedimiento","cita.procedimiento_idprocedimiento = procedimiento.idprocedimiento");
        $this->db->join("empleado","empleado.idempleado=cita.empleado_idempleado");
        $this->db->where("cita.paciente_idpaciente",$data["paciente"]->idpaciente);
        $data["citas"] = $this->db->get()->result();
        $data["titulo"][0]="Ficha del paciente Paciente Ejemplo";
        $data["subtitulo"][0]="En la pestaña de Cita puede ver la cita actual y en la de expediente las citas anteriores e información sobre el paciente";
        $data["contenido"][0] = $this->load->view('fichaPaciente',$data,TRUE);
        $data["seccion"] = 'personal';
        $this->load->view('template',$data);
    }

    public function cita(){
        $data["idcita"]=$this->uri->segment(3);
        $citas = $this->db->get_where("cita",array("idcita"=>$data["idcita"]))->result();
        foreach($citas as $cita){
            $data["cita"] = $cita;
        }
        $this->db->select("paciente.nombre nombrePaciente, paciente.*");
        $paciente = $this->db->get_where("paciente",array("idpaciente"=>$data["cita"]->paciente_idpaciente));
        foreach($paciente->result() as $pac){
            $data["paciente"]=$pac;
        }

        $this->db->select_sum("pago.cantidad");
        $this->db->select("cita.*");
        $this->db->select("procedimiento.nombre nombreProcedimiento");
        $this->db->from("cita");
        $this->db->join("procedimiento","cita.procedimiento_idprocedimiento = procedimiento.idprocedimiento");
        $this->db->join("empleado","empleado.idempleado=cita.empleado_idempleado");
        $this->db->join("pago","cita.idcita = pago.cita_idcita","left");
        $this->db->where("cita.paciente_idpaciente",$data["paciente"]->idpaciente);
        $this->db->group_by("cita.idcita");
        $data["citas"] = $this->db->get()->result();
        //var_dump($data["citas"]);
        //echo $this->db->last_query();die();
        $data["idpaciente"] = $data["paciente"]->idpaciente;

        /* valores enum de estado */
        $row = $this->db->query("SHOW COLUMNS FROM cita LIKE 'estado'")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        foreach ($enum_fields as $key=>$value)
        {
            $enums[$value] = $value;
        }

        /* valores enum de estado */
        $row = $this->db->query("SHOW COLUMNS FROM cita LIKE 'estadoFinanciero'")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        foreach ($enum_fields as $key=>$value)
        {
            $enumsFinanciero[$value] = $value;
        }

        $this->db->from("observacion");
        $this->db->join("empleado", "observacion.empleado_idempleado = empleado.idempleado");
        $this->db->where("observacion.cita_idcita",$data["idcita"]);
        $data["observaciones"] = $this->db->get()->result();
        $data["estados"] = $enums;
        $data["estadosFinancieros"] = $enumsFinanciero;
        $data["titulo"][0]="Ficha del paciente Paciente Ejemplo";
        $data["subtitulo"][0]="En la pestaña de Cita puede ver la cita actual y en la de expediente las citas anteriores e información sobre el paciente";
        $data["contenido"][0] = $this->load->view('fichaPaciente',$data,TRUE);
        $data["seccion"] = 'personal';
        $this->load->view('template',$data);
    }

    public function tabCita(){
        $data["idcita"]=$this->uri->segment(3);
        $this->db->select("cita.*");
        $this->db->select("procedimiento.nombre nombreProcedimiento");
        $this->db->select("paciente.nombre nombrePaciente");
        $this->db->select("paciente.*");
        $this->db->from("cita");
        $this->db->join("procedimiento","cita.procedimiento_idprocedimiento = procedimiento.idprocedimiento");
        $this->db->join("empleado","empleado.idempleado=cita.empleado_idempleado");
        $this->db->join("paciente","paciente.idpaciente=cita.empleado_idempleado");
        $this->db->where("cita.idcita",$data["idcita"]);
        $data["citas"] = $this->db->get()->result();
        
        $row = $this->db->query("SHOW COLUMNS FROM cita LIKE 'estado'")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        foreach ($enum_fields as $key=>$value)
        {
            $enums[$value] = $value; 
        }
        $data["estados"] = $enums;
        
        $this->db->from("observacion");
        $this->db->join("empleado", "observacion.empleado_idempleado = empleado.idempleado");
        $this->db->where("observacion.cita_idcita",$data["idcita"]);
        $data["observaciones"] = $this->db->get()->result();
        
        
        
        $this->load->view("cita",$data);
    }
    
    public function agendarCita(){
	$data["fecha"]=$this->uri->segment(3);
        $data["doctores"] = $this->db->get_where("empleado",array("activo"=>"si","puesto"=>"dentista"));
        $data["procedimientos"] = $this->db->get_where("procedimiento",array("activo"=>"si","tratamiento"=>false));
        $this->load->view('agendarCita',$data);
    }

    public function actualizaCita(){
        $observacion["cita_idcita"] = $_POST["idcita"];
        $observacion["observacion"]         = $_POST["observacion"];
        $cita["estado"]                     = $_POST["estado"];
        $observacion["empleado_idempleado"] = $this->session->userdata("idempleado");
        $observacion["fechaHora"]           = date("Y-m-d H:i:s");
        $this->db->insert("observacion",$observacion);
        $this->db->where('idcita', $observacion["cita_idcita"]);
        if($this->db->update('cita', $cita)){
            $respuesta["tipo"] = "OK";
        }else{
            $respuesta["tipo"] = "KO";
        }
        echo json_encode($respuesta);
        return true;
    }

    public function cargaObservaciones(){
        $cita["cita_idcita"] = $this->uri->segment(3);
        $this->db->from("observacion");
        $this->db->join("empleado", "observacion.empleado_idempleado = empleado.idempleado");
        $this->db->where("observacion.cita_idcita",$cita["cita_idcita"]);
        $data["observaciones"] = $this->db->get()->result();
        $this->load->view("observaciones",$data);
    }

/*
 * Procedimientos
 *
 */
    public function procedimientos(){
	$data["titulo"][0] = "<div id='tituloAltaProcedimiento'>Alta De Procedimientos</div>";
	$data["subtitulo"][0] = "Desde aquí podrá agregar los procedimientos que se pueden realizar en el hospital";
	$data["contenido"][0] = $this->load->view('altaProcedimientos',$data,true);
	$data["titulo"][1] = "Reporte De Procedimientos";
	$data["subtitulo"][1] = "Ver, Editar y Eliminar Procedimientos";
	$data["contenido"][1] = "<div id='listadoProcedimientos'></div>";//$this->load->view('reporteProcedimientos',$data,true);
        $data["seccion"]="personal";
	$this->load->view('template',$data);
    }

    public function altaProcedimiento(){
        $this->load->library('form_validation');
            $tipo = $_POST["tipo"];
            $nombreRepetido=0;

            if($tipo != "editar"){
                $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[2]|max_length[80]|is_unique[procedimiento.nombre]');
            } else {
                $procedimientos = $this->db->get_where("procedimiento",array("nombre"=>trim($_POST["nombre"]),
                                                            "idprocedimiento !="=>$_POST["idprocedimiento"]));
                foreach($procedimientos->result() as $procedimiento){
                    $nombreRepetido++;
                }
                $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[2]|max_length[80]');
            }

            $this->form_validation->set_rules('precio', 'Precio', 'trim|min_length[1]|max_length[8]');
            $this->form_validation->set_rules('descripcion', 'Direccion', 'trim|min_length[5]|max_length[80]');
            $this->form_validation->set_rules('tratamiento', 'Tratamiento', 'trim');
            $this->form_validation->set_rules('tipo', 'Tipo', 'trim');
            $this->form_validation->set_rules('idprocedimiento', 'idprocedimiento', 'trim');
            
            if ($this->form_validation->run() == FALSE || $nombreRepetido>0)
            {
                    echo 'KO';
                    echo (form_error('nombre')!="")?"###nombre":"";
                    echo (form_error('precio')!="")?"###precio":"";
                    echo (form_error('descripcion')!="")?"###descripcion":"";
                    echo (form_error('tratamiento')!="")?"###tratamiento":"";
                    echo (form_error('tipo')!="")?"###tipo":"";
                    echo (form_error('idprocedimiento')!="")?"###idprocedimiento":"";
                    if($nombreRepetido>0){
                        echo "###nombre";
                    }
            }
            else
            {
                    $data["nombre"]=set_value('nombre');
                    $data["precio"]=set_value('precio');
                    $data["descripcion"]=set_value('descripcion');
                    $data["tratamiento"] = (set_value('tratamiento')=="checked")?true:false;
                    $idprocedimiento = set_value('idprocedimiento');
                    $tipo = set_value('tipo');
                    if ($tipo == "editar") {
                        $this->db->where("idprocedimiento",$idprocedimiento);
                        $this->db->update("procedimiento",$data);
                    } else {
                        $this->db->insert("procedimiento",$data);
                    }
                    echo 'OK';
            }
    }

    public function listadoProcedimientos(){
        $data["procedimientos"] = $this->db->get_where("procedimiento",array("activo"=>"si"));
        $this->load->view('listadoProcedimientos',$data);
    }

    public function eliminaProcedimiento(){
        $idprocedimiento = $_POST["idprocedimiento"];
        $this->db->where("idprocedimiento",$idprocedimiento);
        $this->db->update("procedimiento",array("activo"=>"no"));
        echo 'OK';
    }

    public function getProcedimientoJSON(){
        $idprocedimiento = $this->uri->segment(3);
        $procedimiento = $this->db->get_where("procedimiento",array("idprocedimiento"=>$idprocedimiento));
        foreach($procedimiento->result() as $row){
                $respuesta=$row;
        }
        echo json_encode($respuesta);
    }

 /*
  * Tratamientos
  */

    public function altaTratamientos(){
        $this->db->from("procedimiento");
        $this->db->where("tratamiento",true);
        $this->db->where("activo","si");
        $data["procedimientos"] = $this->db->get();
        $data["titulo"][0] = "<div id='tituloAltaTratamiento'>Alta De Tratamientos</div>";
	$data["subtitulo"][0] = "Desde aquí podrá agregar tratamientos a los pacientes, 
            la diferencia entre citas y tratamientos es que la cita es solo una visita y
            los tratamientos son visitas múltiples que se manejan con citas";
	$data["contenido"][0] = $this->load->view('altaTratamientos',$data,true);
        $data["titulo"][1] = "Reporte De Tratamientos";
	$data["subtitulo"][1] = "Ver, Editar y Eliminar Tratamientos";
	$data["contenido"][1] = "<div id='listadoTratamientos'></div>";
        $data["seccion"]="personal";
	$this->load->view('template',$data);
    }

    public function altaTratamiento(){
        $this->load->library('form_validation');
        $tipo = $_POST["tipo"];
        $nombreRepetido=0;

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[11]|max_length[137]');
        $this->form_validation->set_rules('tratamiento', 'Tratamiento', 'trim|required|is_numeric');
        $this->form_validation->set_rules('costo', 'Costo', 'trim|is_float');
        $this->form_validation->set_rules('duracion', 'duracion', 'trim|is_numeric');
        $this->form_validation->set_rules('citas', 'citas', 'trim|is_numeric');
        $this->form_validation->set_rules('fechaInicio', 'Fecha Inicio', 'trim|date');
        $this->form_validation->set_rules('tipo', 'Tipo', 'trim');
        $this->form_validation->set_rules('idtratamiento', 'idtratamiento', 'trim|is_numeric');

        if ($this->form_validation->run() == FALSE || $nombreRepetido>0)
        {
                echo 'KO';
                echo (form_error('nombre')!="")?"###nombre":"";
                echo (form_error('tratamiento')!="")?"###tratamiento":"";
                echo (form_error('costo')!="")?"###costo":"";
                echo (form_error('duracion')!="")?"###duracion":"";
                echo (form_error('citas')!="")?"###citas":"";
                echo (form_error('fechaInicio')!="")?"###fechaInicio":"";
                echo (form_error('tipo')!="")?"###tipo":"";
                echo (form_error('idtratamiento')!="")?"###idtratamiento":"";
        }
        else
        {
            $paciente = $this->getPacienteByNombre(set_value('nombre'));
            $data["paciente_idpaciente"] = $paciente->idpaciente;
            $data["procedimiento_idprocedimiento"]=set_value('tratamiento');
            $data["costo"]=set_value('costo');
            $data["duracion"]=set_value('duracion');
            $data["citas"]=set_value('citas');
            $data["fechaInicio"] = date("Y-m-d",strtotime(set_value('fechaInicio')));
            $idtratamiento = set_value('idtratamiento');
            $tipo = set_value('tipo');
            if ($tipo == "editar") {
                $this->db->where("idtratamiento",$idtratamiento);
                $this->db->update("tratamiento",$data);
            } else {
                $this->db->insert("tratamiento",$data);
            }
            echo 'OK';
        }
    }

    public function listadoTratamientos(){
        $this->db->select("tratamiento.idtratamiento idtratamiento, procedimiento.nombre nombreTratamiento, tratamiento.costo,
            sum(cita.costo) pagado, count(cita.idcita) citas, count(cita.idcita) pendientes, paciente.nombre, 
            paciente.apellidoPaterno, paciente.apellidoMaterno, paciente.idpaciente");
        $this->db->from("tratamiento");
        $this->db->join("paciente","paciente.idpaciente = tratamiento.paciente_idpaciente");
        $this->db->join("procedimiento","procedimiento.idprocedimiento = tratamiento.procedimiento_idprocedimiento");
        $this->db->join("cita","tratamiento.idtratamiento = cita.tratamiento_idtratamiento AND cita.estado = 'realizada' ","left");
        $this->db->join("cita citasPendientes","tratamiento.idtratamiento = citasPendientes.tratamiento_idtratamiento
                        AND citasPendientes.estado = 'pendiente' ","left");
        $this->db->where("paciente.activo = 'si'");
        $this->db->where("tratamiento.estado != 'cancelado'");
        $this->db->group_by("tratamiento.idtratamiento");
        $data["tratamientos"]= $this->db->get();
        $this->load->view("listadoTratamientos",$data);
    }

    public function getTratamientoJSON(){
        $idtratamiento = $this->uri->segment(3);
        $this->db->select("tratamiento.idtratamiento idtratamiento, procedimiento.idprocedimiento, tratamiento.citas, tratamiento.duracion,
            procedimiento.nombre nombreTratamiento, tratamiento.costo,paciente.nombre,
            paciente.apellidoPaterno, paciente.apellidoMaterno, paciente.idpaciente, tratamiento.fechaInicio");
        $this->db->from("tratamiento");
        $this->db->join("paciente","paciente.idpaciente = tratamiento.paciente_idpaciente");
        $this->db->join("procedimiento","procedimiento.idprocedimiento = tratamiento.procedimiento_idprocedimiento");
        $this->db->where("paciente.activo = 'si'");
        $this->db->where("tratamiento.estado != 'cancelado'");
        $this->db->where("tratamiento.idtratamiento = '$idtratamiento'");
        $this->db->group_by("tratamiento.idtratamiento");
        $tratamientos = $this->db->get();
        foreach($tratamientos->result() as $row){
                $respuesta=$row;
                $respuesta->fechaInicio=date("m/d/Y",strtotime($respuesta->fechaInicio));
        }
        echo json_encode($respuesta);
    }

    public function eliminaTratamiento(){
        $idtratamiento = $_POST["idtratamiento"];
        $this->db->where("idtratamiento",$idtratamiento);
        $this->db->update("tratamiento",array("estado"=>"cancelado"));
        echo "OK";
    }

    public function seguimientoTratamiento(){
        $data["titulo"][0] = "Buscador de Tratamiento";
        $data["subtitulo"][0] = "Panel para buscar un tratamiento";
        $data["contenido"][0] = $this->load->view('buscaTratamiento',$data,TRUE);
        $data["titulo"][1] = "Seguimiento de Tratamiento de Ortodoncia de Juan Perez";
        $data["subtitulo"][1] = "Panel para ver el seguimiento que se le ha dado a un tratamiento";
        $data["contenido"][1] = $this->load->view('seguimientoTratamiento',$data,TRUE);
        $data["seccion"]="personal";
	$this->load->view("template",$data);
    }

    /*
     * PAGOS
     *
     */

    public function pagos(){
        $data["seccion"]= "personal";
        $data["idcita"] = $this->uri->segment(3);
        $this->db->select_sum("pago.cantidad");
        $this->db->select("cita.*");
        $this->db->select("procedimiento.nombre nombreProcedimiento");
        $this->db->from("cita");
        $this->db->join("procedimiento","cita.procedimiento_idprocedimiento = procedimiento.idprocedimiento");
        $this->db->join("empleado","empleado.idempleado=cita.empleado_idempleado");
        $this->db->join("pago","cita.idcita = pago.cita_idcita","left");
        $this->db->where("cita.idcita",$data["idcita"]);
        $this->db->group_by("cita.idcita");

        $data["cita"] = $this->db->get()->result();
        $data["titulo"][0] = "Registro de pagos";
        $data["subtitulo"][0] = "Utilize esta forma para registrar los pagos de los pacientes";
        $data["contenido"][0] = $this->load->view("altaPagos",$data,TRUE);

        $data["titulo"][1] = "Historial de pagos";
        $data["subtitulo"][1] = "Pagos realizados por el paciente";
        $data["contenido"][1] = "<div id='listadoPagos'></div>";
        $this->load->view("template",$data);
    }

    public function listadoPagos(){
        $cita = (isset($_POST["idCita"]))?$_POST["idCita"]:(is_numeric($this->uri->segment(3))?$this->uri->segment(3):false);
        if($cita == false){
            return false;
        } else {
            $this->db->select("pago.idpago");
            $this->db->select("pago.cantidad");
            $this->db->select("pago.fechaHora");
            $this->db->select("pago.referencia");
            $this->db->select("empleado.nombre");
            $this->db->select("empleado.apellidos");
            $this->db->from("pago");
            $this->db->join("empleado","pago.empleado_idempleado = empleado.idempleado");
            $this->db->where("pago.cita_idcita",$cita);
            $data["pagos"] = $this->db->get()->result();
        }
        $this->load->view("listadoPagos",$data);
    }


    /*
     * AJAX
     */

    public function getTratamiento(){
        $nombrePaciente = urldecode($this->uri->segment(3));
        $this->db->select("tratamiento.idtratamiento idtratamiento, procedimiento.nombre nombreTratamiento");
        $this->db->from("tratamiento");
        $this->db->join("paciente","paciente.idpaciente = tratamiento.paciente_idpaciente");
        $this->db->join("procedimiento","procedimiento.idprocedimiento = tratamiento.procedimiento_idprocedimiento");
        $this->db->where("concat(paciente.nombre,' ',paciente.apellidoPaterno,' ',paciente.apellidoMaterno) = '$nombrePaciente'");
        $pacientes = $this->db->get();
        echo '<select name=tratamiento id=tratamiento>
                <option value="">Seleccione</option>';
        foreach ($pacientes->result() as $paciente){
            echo "<option value='$paciente->idtratamiento'>$paciente->nombreTratamiento</option>";
        }
        echo '</select>';
    }


    public function diaDoctor(){
        $data["empleado_idempleado"] = $this->uri->segment(4);
        $fecha = explode("-",$this->uri->segment(3));
        $data["fecha"] = $fecha[2]."-".$fecha[1]."-".$fecha[0];
        $this->db->order_by("horaInicio","asc");
        $data["citas"] = $this->db->get_where("cita",$data)->result();
        //echo $this->db->last_query();
        $this->load->view("ajax/diaDoctor",$data);
    }

    public function costoSugerido(){
        $idprocedimiento = $this->uri->segment(3);
        if(!$idprocedimiento){
            return false;
        }
        $procedimientos = $this->db->get_where("procedimiento",array("idprocedimiento"=>$idprocedimiento));
        foreach ($procedimientos->result() as $procedimiento) {
            $costo = number_format($procedimiento->precio,2,".",",");
        }
        echo "Costo sugerido:$$costo";
    }
    
    public function validaCita(){
        $error = array();
        if(!is_numeric($_POST["h_inicio"]) || $_POST["h_inicio"] < 0 || $_POST["h_inicio"] > 23){
            $error["h_inicio"] = "La hora de inicio de la cita debe ser un número entre 0 y 23";
        }
        if(!is_numeric($_POST["m_inicio"]) || $_POST["m_inicio"] < 0 || $_POST["m_inicio"] > 59){
            $error["m_inicio"] = "Los minutos de inicio de la cita debe ser un número entre 0 y 59";
        }
        $data["horaInicio"] = date("H:i:s",strtotime($_POST["h_inicio"].":".$_POST["m_inicio"]));

        if(!is_numeric($_POST["h_fin"]) || $_POST["h_fin"] < 0 || $_POST["h_fin"] > 23){
            $error["h_fin"] = "La hora de inicio de la cita debe ser un número entre 0 y 23";
        }
        if(!is_numeric($_POST["m_fin"]) || $_POST["m_fin"] < 0 || $_POST["m_fin"] > 59){
            $error["m_fin"] = "Los minutos de inicio de la cita debe ser un número entre 0 y 59";
        }
        $data["horaFin"] = date("H:i:s",strtotime($_POST["h_fin"].":".$_POST["m_fin"]));
        if(strtotime($data["horaFin"]) <= strtotime($data["horaInicio"])){
            $error["h_fin"] = "La hora de fin debe ser mayor a la de inicio.";
        }
        
        $data["empleado_idempleado"] = $_POST["doctor"];
        $empleado = $this->db->get_where("empleado",array("idempleado"=>$data["empleado_idempleado"]))->result();
        if(!$empleado){
            $error["doctor"] = "El doctor no existe";
        }
        $data["procedimiento_idprocedimiento"] = $_POST["procedimiento"];
        $procedimiento = $this->db->get_where("procedimiento",array("idprocedimiento"=>$data["procedimiento_idprocedimiento"]))->result();
        if(!$procedimiento){
            $error["procedimiento"] = "El procedimiento no existe";
        }
        $query = $this->db->query('select * from paciente where CONCAT(nombre," ",apellidoPaterno," ",apellidoMaterno) = "'.$_POST["paciente"].'"');
        foreach($query->result() as $paciente){
            $data["paciente_idpaciente"]=$paciente->idpaciente;
        }
        if(!isset($data["paciente_idpaciente"])){
            $error["paciente"]="No existe el paciente";
        }
        $data["costo"] = $_POST["costo"];
        if(!isset($_POST["costo"]) || !is_numeric($_POST["costo"])){
            $error["costo"]="Debe ingresar un costo válido";
        }
        
        $fecha = explode("/",$_POST["fecha"]);
        $data["fecha"] = date("Y-m-d",strtotime($fecha[2]."-".$fecha[1]."-".$fecha[0]));
        if(strtotime($data["fecha"]) < strtotime("today")){
            $error["fecha"] = "La fecha de la cita debe ser mayor o igual a hoy.";
        }

        $data["tratamiento_idtratamiento"] = (isset($_POST["tratamiento"]))?$_POST["tratamiento"]:"";
        $data["observaciones"] = $_POST["observaciones"];

        $citas = $this->db->query("SELECT * FROM cita WHERE empleado_idempleado = ".$data["empleado_idempleado"]." AND fecha = '".$data["fecha"]."' AND (horaInicio BETWEEN '".$data["horaInicio"]."' AND '".$data["horaFin"]."' 
                                                                                                        OR horaFin BETWEEN '".$data["horaInicio"]."' AND '".$data["horaFin"]."') ORDER BY horaInicio ")->result();
        
        if($citas){
            if(sizeof($citas) == 1){
                foreach($citas as $cita){
                    $error["hora"] = "La hora de la cita choca con otra cita programada de <strong>".$cita->horaInicio."</strong> a <strong>".$cita->horaFin."</strong>";
                }
            } else {
                $i=0;
                $error["hora"] = "La hora de la cita choca con otras citas programadas ";
                foreach($citas as $cita){
                    if($i>0){
                        $error["hora"] .= " y ";
                    }
                    $error["hora"] .= " de <strong>".$cita->horaInicio."</strong> a <strong>".$cita->horaFin."</strong>";
                    $i++;
                }
            }
        }
        if(sizeof($error)>0){
            $error["tipo"] = "error";
            echo json_encode($error);
            
        } else {
            $this->db->insert("cita", $data);
            $data["tipo"] = "insert";
            echo json_encode($data);
        }
    }
}