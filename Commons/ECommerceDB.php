<?php

class DbConnection{

    //Define database metadata:
    public $con;
    private $servername = "localhost";
    private $dbusername = "root";
    private $dbpassword = "";
    private $dbName = "tgecommerce";

    function __construct()
    {
        //Connect to the database:
        $this->con = new mysqli($this->servername, $this->dbusername, $this->dbpassword, $this->dbName);

        if(!$this->con){
            //Display the error occured when connecting:
            die("Connection failed : " . mysqli_connect_error()); 
        }
    }

}