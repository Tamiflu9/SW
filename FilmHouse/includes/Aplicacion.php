<?php
namespace filmhouse;
require_once __DIR__ . "/config.php";
use filmhouse\DAOs\DAO_Pelicula;
use filmhouse\DAOs\DAO_FavoritosPeli;
use filmhouse\DAOs\DAO_FavoritosSerie;
use filmhouse\DAOs\DAO_Serie;
use filmhouse\DAOs\DAO_Amigos;
use filmhouse\DAOs\FavoritosPeli;
use filmhouse\DAOs\FavoritosSerie;
use filmhouse\DAOs\Amistad;
use filmhouse\DAOs\DAO_ForoUsuario;
use filmhouse\DAOs\ForoUsuario; 
use filmhouse\DAOs\DAO_ForoPelicula;
use filmhouse\DAOs\ForoPelicula;
use filmhouse\DAOs\DAO_ForoSerie;
use filmhouse\DAOs\ForoSerie;
use filmhouse\DAOs\DAO_Usuario;
use filmhouse\DAOs\Usuario;
use filmhouse\DAOs\Notas;
use filmhouse\DAOs\DAO_Notas;

/**
 * Clase que mantiene el estado global de la aplicación.
 */
class Aplicacion
{
	private static $instancia;
	
	private $bdDatosConexion;
	private $rutaRaizApp;
	private $dirInstalacion;
	/**
	 * Permite obtener una instancia de <code>Aplicacion</code>.
	 * 
	 * @return Applicacion Obtiene la única instancia de la <code>Aplicacion</code>
	 */
	public static function getInstance() {
		if (  !self::$instancia instanceof self) {
			self::$instancia = new self;
		}
		return self::$instancia;
	}
	/**
	 * Evita que se pueda instanciar la clase directamente.
	 */
	private function __construct() {
	}
	/**
	 * Evita que se pueda utilizar el operador clone.
	 */
	private function __clone()
	{
	    parent::__clone();
	}
	
	/**
	 * Evita que se pueda utilizar unserialize().
	 */
	private function __wakeup()
	{
	    return parent::__wakeup();
	}

	public function init($bdDatosConexion, $rutaRaizApp, $dirInstalacion)
  	{
	    $this->bdDatosConexion = $bdDatosConexion;
	    $bd = \filmhouse\DAOs\DB::init($this->bdDatosConexion);

	    $this->rutaRaizApp = $rutaRaizApp;
	    $tamRutaRaizApp = mb_strlen($this->rutaRaizApp);
	    if ($tamRutaRaizApp > 0 && $this->rutaRaizApp[$tamRutaRaizApp-1] !== '/') {
	      $this->rutaRaizApp .= '/';
	    }

	    $this->dirInstalacion = $dirInstalacion;
	    $tamDirInstalacion = mb_strlen($this->dirInstalacion);
	    if ($tamDirInstalacion > 0 && $this->dirInstalacion[$tamDirInstalacion-1] !== '/') {
	      $this->dirInstalacion .= '/';
	    }

	    $this->conn = null;
  	}
	public function usuarioLogueado() {
	    return isset($_SESSION["login"]) && ($_SESSION["login"]===true);
	}

	public function nombreUsuario() {
	    return isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
	}

	public function idUsuario() {
	   return  isset($_SESSION['id']) ? $_SESSION['id'] : null;
	}

	public function resuelve($path = '')
  	{
	    $rutaRaizAppLongitudPrefijo = mb_strlen($this->rutaRaizApp);
	    if( mb_substr($path, 0, $rutaRaizAppLongitudPrefijo) === $this->rutaRaizApp ) {
	      return $path;
	    }

	    if (mb_strlen($path) > 0 && $path[0] == '/') {
	      $path = mb_substr($path, 1);
	    }
	    return $this->rutaRaizApp . $path;
  	}

  	public function doInclude($path = '')
  	{
	    if (mb_strlen($path) > 0 && $path[0] == '/') {
	      $path = mb_substr($path, 1);
	    }
	    include($this->dirInstalacion . '/'.$path);
  	}

	public function esAdmin()
	{
		if($_SESSION['rol'] == 3)
		{
			return true;
		}
		return false;
	}

	public function esGestor()
	{
		if($_SESSION['rol'] >= 2)
		{
			return true;
		}
		return false;
	}

	public function esMod()
	{
		if($_SESSION['rol'] >= 1)
		{
			return true;
		}
		return false;
	}
	public function usuarioDis($nombreUsu)
	{
		if($this->idUsuario() != $nombreUsu)
		{
			return true;
		}
		return false;
	}
	public function usuarioDisA($idUsu1, $idUsu2)
	{
		if($idUsu1 !== $idUsu2)
		{
			return true;
		}
		return false;
	}

	function borrarMensaje($id_foro){
        $dao = new DAO_ForoUsuario();
        $foro = $dao->read($id_foro);
        $dao->delete($foro);
	}
	
	function borrarPublicacion($id_foro){
        $dao = new DAO_ForoUsuario();
        $foro = $dao->read($id_foro);
        $asunto = $foro->getAsunto();
		$partir = explode(" ", $asunto);
        if($partir[0] == 'Pelicula')
        {
            $daoForo = new DAO_ForoPelicula();
        }
        else if($partir[0] == 'Serie')
        {
            $daoForo = new DAO_ForoSerie();
        }
        $nulo = $daoForo->readUsuFecha($foro->getIDUsu1(), $foro->getFecha());
        $daoForo->delete($nulo);
	}

	function aceptarAmigo($id_foro){
        $dao = new DAO_ForoUsuario();
        $foro = $dao->read($id_foro);
        $id = $foro->getIDUsu1();

        $daoUsu = new DAO_Usuario();
        $usuario = $daoUsu->read($this->idUsuario());
        $usuario->anadirAmigo($id);
	}
	
	function mensajeRechazo($id_foro){
        $dao = new DAO_ForoUsuario();
        $foro = $dao->read($id_foro);
        $id = $foro->getIDUsu1();

        $fecha = getdate(); 
        $fecha = $fecha['year'] . "-" . $fecha['mon'] . "-" .$fecha['mday'] . " " . $fecha['hours'] . ":" . $fecha['minutes'] . ":" . $fecha['seconds'];

        $msj = new ForoUsuario(0, $this->idUsuario(), $id, 'Solicitud rechazada' , $this->idUsuario().' ha rechazado tu solicitud de amistad', 0, $fecha, 'Mensaje');
        $dao->create($msj);    
	}
	
	function borrarPersona($id){
		$daoUsu = new DAO_Usuario();
		$user = $daoUsu->read($id);
		$usuario = $daoUsu->delete($user);
	}
	
	function promocionarPersona($id){
		$daoUsu = new DAO_Usuario();
		$user = $daoUsu->read($id);
		$rol = $user->getRol();
		$user->setRol($rol+1);
		$usuario = $daoUsu->update($user);
	}

	function degradarPersona($id){
		$daoUsu = new DAO_Usuario();
		$user = $daoUsu->read($id);
		$rol = $user->getRol();
		$user->setRol($rol-1);
		$usuario = $daoUsu->update($user);
	}

	function mandarSolicitud($id){
		$dao = new DAO_ForoUsuario();

		$fecha = getdate();
		$fecha = $fecha['year'] . "-" . $fecha['mon'] . "-" .$fecha['mday'] . " " . $fecha['hours'] . ":" . $fecha['minutes'] . ":" . $fecha['seconds'];
	
		$msj = new ForoUsuario(0, $this->idUsuario(), $id, 'Solicitud de Amistad' , 'solicitud de amistad', 0, $fecha, 'Solicitud');
		$dao->create($msj);
	}

	function borrarAmigo($id){
		$daoUsu = new DAO_Usuario();
		$usuario = $daoUsu->read($this->idUsuario());
		$usuario->borrarAmigo($id);
	}


	function borrarMensajePeli($tituloPeli, $id_foro){
        $dao = new DAO_ForoPelicula();
        $foro = $dao->read($id_foro);
        $dao->delete($foro);
	}
	
	function borrarPeli($tituloPeli){
        $dao = new DAO_Pelicula();
        $id = $dao->dameId($tituloPeli);
        $peli = $dao->read($id);
        $dao->delete($peli);
	}
	
	function anadirPeli($tituloPeli){
        $daoUsu = new DAO_Usuario();
        $usuario = $daoUsu->read($this->idUsuario());
        $usu = new Usuario($usuario->getID(), $usuario->getNombre(), $usuario->getEmail(), $usuario->getPassword(), $usuario->getDescripcion(), $usuario->getImagen(), $usuario->getRol());
        $dao = new DAO_Pelicula();
        $usu->anadirPeliFav($dao->dameId($tituloPeli));
	}
	
	function borrarFavPeli($tituloPeli){
        $daoUsu = new DAO_Usuario();
        $usuario = $daoUsu->read($this->idUsuario());
        $dao = new DAO_Pelicula();
        $usuario->borrarPeliFav($dao->dameId($tituloPeli));
	}

	function calculoNota($titulo){
        $daoNo = new DAO_Notas();
        $listanotas = $daoNo->readAll(0,$titulo);
        $calculo = 0;
        if(!isset($listanotas))        {
            return "Sin calificar";
		}
		else{
            $i = 0;
            foreach ($listanotas as $n) {
                $i++;
                $calculo += $n->getNota();
            }
            return round($calculo/$i, 2);
        } 
	}
	
	function borrarSerie($tituloSerie){
        $dao = new DAO_Serie();
        $id = $dao->dameId($tituloSerie);
        $serie = $dao->read($id);
        $dao->delete($serie);
	}
	
    function borrarMensajeSerie($tituloSerie, $id_foro){
        $dao = new DAO_ForoSerie();
        $foro = $dao->read($id_foro);
        $dao->delete($foro);
    }

	function anadirSerie($tituloSerie){
        $daoUsu = new DAO_Usuario();
        $usuario = $daoUsu->read($this->idUsuario());
        $dao = new DAO_Serie();
        $usuario->anadirSerieFav($dao->dameId($tituloSerie));
	}
	
	function borrarFavSerie($tituloSerie){
        $daoUsu = new DAO_Usuario();
        $usuario = $daoUsu->read($this->idUsuario());
        $dao = new DAO_Serie();
        $usuario->borrarSerieFav($dao->dameId($tituloSerie));
    }

}