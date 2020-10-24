<?php

namespace filmhouse;
use filmhouse\DAOs\DAO_Usuario;

class FormularioLogin extends Form
{
    public function __construct() {
        parent::__construct('formLogin');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $id = '';
        if ($datos) {
            $id = isset($datos['id']) ? $datos['id'] : $id;
        }
        $html = <<<EOF
<fieldset>
<legend>Usuario y contraseña</legend>
<p><label>Nombre de usuario:</label> <input type="text" name="id" value="$id"/></p>
<p><label>Password:</label> <input type="password" name="password" /></p>
<button type="submit" name="login">Entrar</button>
<p>Eres nuevo, <a href="registro.php">registrate</a></p>
</fieldset>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $errores = array();
        $enlace=new \mysqli(BD_HOST, BD_USER ,BD_PASS , BD_NAME);

        $id = isset($datos['id']) ? $enlace->real_escape_string($datos['id']) : null;
                
        if ( empty($id) ) {
            $errores[] = "El nombre de usuario no puede estar vacío";
        }
        
        $password = isset($datos['password']) ? $datos['password'] : null;
        if ( empty($password) ) {
            $errores[] = "El password no puede estar vacío.";
        }
        
        if (count($errores) === 0) {
            $dao = new DAO_Usuario();
            $u = $dao->read($id);
           
            if ( ! $u ) {  
                // No se da pistas a un posible atacante
                $errores[] = "El usuario o el password no coinciden";
            } else {
                
                if($u->compruebaPassword($password)){
                    $_SESSION['login']  = true;
                    $_SESSION['id']     = $id;
                    $_SESSION['nombre'] = $u->getNombre();
                    $_SESSION['rol']    = $u->getRol();
                    $errores = 'index.php';
                }
                else{
                    //aqui tampoco se dan pistas al atacante
                    $errores[] = "El usuario o el password no coinciden";
                }
            }
        }
        return $errores;
    }
}