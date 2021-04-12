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
        $this -> connectionString = new mysqli($this -> serverName,$this -> userName,$this -> passCode,$this -> databaseName);
        return $this -> connectionString;
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
        $query = "SELECT id FROM usuarios WHERE user='$data[user]' and passw='$data[pass]'" ;
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
