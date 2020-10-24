<?php

namespace filmhouse;
use filmhouse\DAOs\DAO_Usuario;
use filmhouse\DAOs\Usuario;
use filmhouse\Aplicacion;

$app = Aplicacion::getInstance();
if (! $app->usuarioLogueado()) {
    // Con esto lo redirigimos direcamente a la raiz, también podría ser a una página de error genérica 403.php <=> NO tienes permiso
    error_log("Error 403: Usuario no registrado.");
    header('Location: '.$app->resuelve('fallo.php'));
}
$dao = new DAO_Usuario();
$usuario= $dao->read( $app->idUsuario());

$imagen = $usuario->getImagen();
$rol = $usuario->getRol();

class FormularioModificacion extends Form
{
    public function __construct() {
        parent::__construct('formModificacion');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $descripcion = '';
        $nombre = '';
        $email = '';
        if ($datos) {
            $descripcion     = isset($datos['descripcion']) ? $datos['descripcion'] : $descripcion;
            $nombre = isset($datos['nombre']) ? $datos['nombre'] : $nombre;
            $email  = isset($datos['email']) ? $datos['email'] : $email;
        }
        $html = <<<EOF
		<fieldset>
            <div class="grupo-control">
                <label>Nick:</label> <input class="control" type="text" name="nombre" value="$nombre" />
            </div>
            <div class="grupo-control">
                <label>Descripción:</label> <input class="control" type="text" name="descripcion" value="$descripcion" />
            </div>
			<div class="grupo-control">
				<label>Email:</label> <input class="control" type="text" name="email" value="$email" />
			</div>
			<div class="grupo-control">
				<label>Password:</label> <input class="control" type="password" name="password" />
			</div>
			<div class="grupo-control"><label>Vuelve a introducir el Password:</label> <input class="control" type="password" name="password2" /><br /></div>
			<div class="grupo-control"><button type="submit" name="modificacion">Modificar datos</button></div>
		</fieldset>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $app = Aplicacion::getInstance();
        if (! $app->usuarioLogueado()) {
            // Con esto lo redirigimos direcamente a la raiz, también podría ser a una página de error genérica 403.php <=> NO tienes permiso
            error_log("Error 403: Usuario no registrado.");
            header('Location: '.$app->resuelve('/fallo.php'));
        }
        $dao = new DAO_Usuario();
        $actual= $app->idUsuario();
        $usuario= $dao->read( $actual);

        $errores = array();
        $enlace = new \mysqli(BD_HOST, BD_USER ,BD_PASS , BD_NAME);
        
        $nombre = isset($datos['nombre']) ? $enlace->real_escape_string($datos['nombre']) : null;

        if($nombre == NULL)
        {
            $nombre = $usuario->getNombre();
        }
        else{
            if($nombre != $usuario->getNombre())
            {
                if( empty($nombre) || mb_strlen($nombre) < 5 )
                    $errores[] = "El nombre tiene que tener una longitud de al menos 5 caracteres.";
            }
            else{
                $errores[] = "Los datos no pueden ser los mismos que antes";
            }
            
        }

        $descripcion = isset($datos['descripcion']) ? $enlace->real_escape_string($datos['descripcion']) : null;
        if($descripcion == NULL)
        {
            $descripcion = $usuario->getDescripcion();
        }
        else{
            if($descripcion == $usuario->getDescripcion())
            {
                $errores[] = "Los datos no pueden ser los mismos que antes";
            }
        }

        $email = isset($datos['email']) ? $enlace->real_escape_string($datos['email']) : null;

        if($email == NULL)
        {
            $email = $usuario->getEmail();
        }
        else{
            if($email != $usuario->getEmail())
            {
                if(!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
                    $errores[] = "El email debe ser una direccion de correo valida";
            }
            else
            {
                $errores[] = "Los datos no pueden ser los mismos que antes";
            }
            
        } 
        
        $password = isset($datos['password']) ? $enlace->real_escape_string($datos['password']) : null;
        if($password == NULL)
        {
            $password = $usuario->getPassword();
        }
        else{
            if($password != $usuario->getPassword())
            {
                if(empty($password) || mb_strlen($password) < 5 ){
                    $errores[] = "El password tiene que tener una longitud de al menos 5 caracteres.";
                }
                else{
                    $password2 = isset($datos['password2']) ? $enlace->real_escape_string($datos['password2']) : null;
                    if ( empty($password2) || strcmp($password, $password2) !== 0 ) {
                        $errores[] = "Los passwords deben coincidir";
                    }    
                } 
                $password = password_hash("$password",PASSWORD_BCRYPT);  
            }
            else
            {
                $errores[] = "Los datos no pueden ser los mismos que antes";
            }
        }
        
        if (count($errores) === 0) {

            $imagen = $usuario->getImagen();
            $rol = $usuario->getRol();
            $id = $app->idUsuario();
            $u = new Usuario($id, $nombre, $email, $password, $descripcion, $imagen, $rol);
            $dao->update($u);
            $_SESSION['login']  = true;
            $_SESSION['nombre'] = $u->getNombre();
            $_SESSION['id']     = $u->getID();
            $_SESSION['rol']    = $u->getRol();
            $errores = 'perfil.php';

        }
        return $errores;
    }
}