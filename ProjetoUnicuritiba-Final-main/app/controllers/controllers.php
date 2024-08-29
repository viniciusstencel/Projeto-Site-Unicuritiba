<?php
namespace App\Controllers;

class Controllers{
    /*
    *@return boolean
    */
    private static function init(){
        session_status() !==  PHP_SESSION_ACTIVE ? session_start(): true;
    }
    /*
    *@param string $email
    *@param string $nome
    */
    public static function login($ra, $nome, $id, $nivel, $senha, $curso, $atletica){
        self::init();

        $_SESSION['user'] = [
            'ra' => $ra,
            'nome' => $nome,
            'id' => $id,
            'nivel' => $nivel,
            'senha' => $senha,
            'curso' => $curso,
            'atletica' => $atletica
        ];
    }
    /*
    *@return boolean
    */
    public static function isLogged(){
        self::init();

        return isset($_SESSION['user']);
    }
    /*
    *@return array
    */
    public static function getInfo(){
        self::init();

        return $_SESSION['user'] ?? [''];
    }
    public static function logout(){
        self::init();

        unset($_SESSION['user']);
        echo '<script>alert("Você fez logout.");
        window.location.href ="../../public/index.php";</script>';
    }

}
?>

