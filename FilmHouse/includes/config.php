<?php
use filmhouse\Aplicacion;

session_start();
/**
 * Función para autocargar clases PHP.
 *
 * @see http://www.php-fig.org/psr/psr-4/
 */
spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'filmhouse\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . DIRECTORY_SEPARATOR;

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

    // Varios defines para los parámetros de configuración de acceso a la BD y la URL desde la que se sirve la aplicación
    
    define('BD_HOST', 'vm03.db.swarm.test');
    define('BD_NAME', 'sw');
    define('BD_USER', 'sw');
    define('BD_PASS', 'sw');
    define('RAIZ_APP', __DIR__);
    define('RUTA_APP', '/');
    /*
    define('BD_HOST', 'localhost');
    define('BD_NAME', 'filmhouse');
    define('BD_USER', 'root');
    define('BD_PASS', '');
    define('RAIZ_APP', __DIR__);
    define('RUTA_APP', '/FilmHouse/');
    */
    ini_set('default_charset', 'UTF-8');
    setLocale(LC_ALL, 'es_ES.UTF.8');


$app = Aplicacion::getInstance();
$app->init(array('host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS), RUTA_APP, RAIZ_APP);
