<?php

    //Verify that the controller had been accessed through the view:
    if($_GET["status"]!="true"){

        header("location: ../View/Login.php");

    }else{

        //Read the data passed form the fields of the view component:
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        try{
            
            //Check for empty input:
            if($username=="" && $password==""){
                throw new Exception("Please enter your username and password.");
            }

            if($username==""){
                throw new Exception("Username cannot be empty!");
            }

            if($password==""){
                throw new Exception("Password cannot be empty!");
            }

            //Load the MySQL Connection and Login Model:
            require_once '../Commons/ECommerceDB.php';
            require_once '../Model/LoginModel.php';
            
            //Create the database connection object:
            $thisDBConnection = new DbConnection();
            $myCon = $thisDBConnection->con;

            //Use the function defined in the model to login the user:
            loginUser($myCon, $username, $password);

        }catch(exception $ex){

            //Check for exceptions, and pass the message back to the view component
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);

            header("location: ../View/Login.php?msg=$msg");

            exit();
        }

    }
    
?>