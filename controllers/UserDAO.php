<?php
 class USerDAO implements Dao{
    private $db;

    //essa atributo db vai receber um objeto da classe Database
    public function __construct(Database $db){
        $this->db=$db;
    }

     
    //aq ambaixo estamos chamando os metodos dos cruds


    //esses metodos create ele vai receber um pacote dedos para criar o usuario
    //basicamente nesses crud vai ter que abrir a conexao com o objeto instanciado db depois fazer a query gaurdar em uma varivel e depois fechar a conexao
    public function create($data){
        $nome = $data['name'];
        $email = $data['email'];
        $password = $data['password'];

        $sql = "INSERT INTO users(name,email,PASSWORD) VALUES('$nome','$email','$password')";
        $this->db->connect();
        $resultados = $this->db->query($sql);
        $id = $this->db->getLastIsertedId();
        $this->db->close();

        if($resultados){
            return new User($id,$nome,$email,$password);
        }
        else{
            die("error ao criar usuario".$this->db->getError());
        }
        
    }
    public function read(){
            $sql = "SELECT * FROM users";
            $this->db->connect();
            $resultados = $this->db->query($sql);

            $users = array();
            if($resultados && !$resultados->num_rows>0){
              
                while($row=$resultados->fetch_assoc()){
                    $users = new User($row['id'],$row['name'],$row['email'],$row['password']);
                    $user[]=$users;
                } 

            }
            $this->db->close();

            return $user;
    }

    public function update($id,$data){
       $nome = $data['name'];
       $email = $data['email'];
       $sql = "UPDATE users SET name ='$nome',email = '$email' WHERE id=$id";
       $this->db->connect();
       $resultados = $this->db->query($sql);
       $this->db->close();

       return $resultados;

    }

    public function delete($id){
      $sql = "DELETE from users WHERE = id=$id";
      $this->db->connect();
      $resultados = $this->db->query($sql);
      $this->db->close();
      
      return $resultados;

    }


 }




?>