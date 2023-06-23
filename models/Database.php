<?php

class Database
{

    private string $host;
    private string $database;

    private string $username;

    private string $password;

    private $conexao; //essa variavel server para manipular o banco 

    public function __construct($host, $database, $username, $password)
    {

        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;


    }


    //esse metodo vai abrir a conexao
    public function connect()
    {
        $this->conexao = new mysqli($this->host, $this->username, $this->password, $this->database);
        //veriricar se a conexao vai te reotornar erro
        if ($this->conexao->connect_error) {
            die("erro na conexao: " . $this->conexao);
        }
    }

    //  essa metodo vai fazer a verificação se recebeu uma query ou n , vamos passar como parametro a variavel sql
    // que quando a gente for chamar essa function ela vai receber um valor que vai ser a query , ai a query vai passar nesse if que vai verificar se foi feito uma query se n for feito vai dar essa mensagem de erro e die e vai me mostar o erro caso contrario vai me retornar o resultado dessa query

    // a variavel resultados guarda o valor da query inserida

    public function query($sql)
    {
        $resultados = $this->conexao->query($sql);
        if (!$resultados) {
            die("erro ao fazer a query: " . $this->conexao->error);
        }
        return $resultados;
    }


     // esse metodo vai ficar responsavel  de fechar a conexao
    public function closeConection()
    {
        $this->conexao->close();
    }


    //esses metodos vai ficar retornando os erros que da
    public function getError(){
        return $this->conexao->error;
    }
    
    //metodo para pegar o utimo id criado isso é bom para o servidor n ficar fazendo request de todos ids de um uma vez e sim ja saber qual foi o utimo id criado

    public function getLastIsertedId(){
        return $this->conexao->insert_id;
    }


}
//chaves que fecha a classe 




?>