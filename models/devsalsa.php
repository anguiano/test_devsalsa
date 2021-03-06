<?php

//https://stackoverflow.com/questions/3228694/php-database-connection-class

include 'common/db.php';

class devsalsaModel extends Dbconfig {

    public $connectionString;
    public $dataSet;
    private $sqlQuery;

    protected $databaseName;
    protected $hostName;
    protected $userName;
    protected $passCode;

    function devsalsaModel() {
        $this->connectionString = NULL;
        $this->sqlQuery = NULL;
        $this->dataSet = NULL;

        $dbPara = new Dbconfig();
        $this->databaseName = $dbPara -> dbName;
        $this->hostName = $dbPara -> serverName;
        $this->userName = $dbPara -> userName;
        $this->passCode = $dbPara ->passCode;
        $dbPara = NULL;
    }

    function dbConnect()    {
        $this->connectionString = new mysqli($this->serverName, $this->userName, $this->passCode, $this->databaseName);
        return $this->connectionString;
    }

    function dbDisconnect() {
        $this->connectionString->close();
        $this->connectionString = NULL;
        $this->sqlQuery = NULL;
        $this->dataSet = NULL;
        $this->databaseName = NULL;
        $this->hostName = NULL;
        $this->userName = NULL;
        $this->passCode = NULL;
    }

    function get_user($data)   {
        $query = "SELECT id FROM usuarios WHERE user='$data[user]' and passw=md5($data[pass])" ;
        error_log($query);
        $result = $this->connectionString->query($query);
        if($result->num_rows>0){
          while($row = $result->fetch_assoc()){
            $user = $row;
          }
        }else{
          $user = 0;
        }

        return $user;
    }

    function insert_user($data)   {
        $query = "INSERT INTO usuarios (nombre, correo, passw, activo) values ('$data[name]', '$data[user]', MD5($data[pass]), 1)" ;
        $result = $this->connectionString->query($query);
        return $mysqli->insert_id;
    }

    function get_user_exist($data)   {
        $query = "SELECT id FROM usuarios WHERE user='$data[user]' and active=1 limit 1" ;
        $result = $this->connectionString->query($query);
        if($result->num_rows>0){
          while($row = $result->fetch_assoc()){
            $user = $row;
          }
        }else{
          $user = 0;
        }

        return $user;
    }

}

 ?>
