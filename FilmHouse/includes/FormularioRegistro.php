<?php

namespace filmhouse;
use filmhouse\DAOs\DAO_Usuario;
use filmhouse\DAOs\Usuario;

class FormularioRegistro extends Form
{
    public function __construct() {
        parent::__construct('formRegistro');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $id = '';
        $nombre = '';
        $email = '';
        if ($datos) {
            $id     = isset($datos['id']) ? $datos['id'] : $id;
            $nombre = isset($datos['nombre']) ? $datos['nombre'] : $nombre;
            $email  = isset($datos['email']) ? $datos['email'] : $email;
        }
        $html = <<<EOF
		<fieldset>
			<div class="grupo-control">
				<label>Nombre de usuario:</label> <input class="control" type="text" name="id" value="$id" />
            </div>
            <div class="grupo-control">
                <label>Nick:</label> <input class="control" type="text" name="nombre" value="$nombre" />
            </div>
			<div class="grupo-control">
				<label>Email:</label> <input class="control" type="text" name="email" value="$email" />
			</div>
			<div class="grupo-control">
				<label>Password:</label> <input class="control" type="password" name="password" />
			</div>
			<div class="grupo-control"><label>Vuelve a introducir el Password:</label> <input class="control" type="password" name="password2" /><br /></div>
			<div class="grupo-control"><button type="submit" name="registro">Registrar</button></div>
		</fieldset>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $errores = array();
        $enlace = new \mysqli(BD_HOST, BD_USER ,BD_PASS , BD_NAME);

        $id = isset($datos['id']) ? $enlace->real_escape_string($datos['id']) : null;
        
        if ( empty($id) || mb_strlen($id) < 5 ) {
            $errores[] = "El nombre de usuario tiene que tener una longitud de al menos 5 caracteres.";
        }
        
        $nombre = isset($datos['nombre']) ? $enlace->real_escape_string($datos['nombre']) : null;
        if ( empty($nombre) || mb_strlen($nombre) < 5 ) {
            $errores[] = "El nombre tiene que tener una longitud de al menos 5 caracteres.";
        }

        $email = isset($datos['email']) ? $enlace->real_escape_string($datos['email']) : null;

        if(!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errores[] = "El email debe ser una direccion de correo valida";
        }
        
        $password = isset($datos['password']) ? $enlace->real_escape_string($datos['password']) : null;
        if ( empty($password) || mb_strlen($password) < 5 ) {
            $errores[] = "El password tiene que tener una longitud de al menos 5 caracteres.";
        }
        $password2 = isset($datos['password2']) ? $enlace->real_escape_string($datos['password2']) : null;
        if ( empty($password2) || strcmp($password, $password2) !== 0 ) {
            $errores[] = "Los passwords deben coincidir";
        }
        
        if (count($errores) === 0) {
            $dao = new DAO_Usuario();
	        $user = $dao->read($id);
            if ( !empty($user) ) {
                $errores[] = "El usuario ya existe";
            } else {
                $password = password_hash("$password",PASSWORD_BCRYPT);
                $u = new Usuario($id, $nombre, $email, $password, NULL, "img/usuarios/predeterminado.png", 0);
                $dao->create($u);
                $_SESSION['login']  = true;
                $_SESSION['visita'] = false;
                $_SESSION['nombre'] = $u->getNombre();
                $_SESSION['id']     = $u->getID();
                $_SESSION['rol']    = $u->getRol();
                $errores = 'perfil.php';
            }
        }
        return $errores;
    }
}