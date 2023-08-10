<?php

require_once './models/Database.php';
require_once './models/User.php';
require_once './models/DAO.php';
require_once './controllers/UserDAO.php';

$url = $_SERVER('REQUEST_URI'); // como isso ele vai sempre saber qual vai ser a url da rota 

if (strpos($url, '/teste/teste') !== false) {
    echo 'bak end rodando';
} else if (strpos($url, 'teste/users') !== false) {
    $db = new Database('localhost', 'teste', 'root', '');
    $usuario = new UserDAO($db);
    $methodo = $_SERVER('REQUEST_METHODO');
    switch ($methodo) {
        case 'GET':
            $usuarios = $usuario->read();

            foreach ($usuarios as $user) {
                echo "id" . $user->getId() . "<br/>";
                echo "nome" . $user->getName() . "<br/>";
                echo "Email" . $user->getEmail() . "<br/>";
                echo "Senha" . $user->getPassword() . "<br/>";

            }
            break;

        case 'POST';
            $name = $_POST['name'];
            $email = $_POST['email'];
            $senha = $_POST['password'];
            

            $data = array(
                "name" => $name,
                "email" => $email,
                "password" => $senha
            );

            $createUser = $usuario->create($data);
            break;
        default:
            break;
    }
}
?>