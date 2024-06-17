<?php

require_once '../Commons/ECommerceDB.php';


    //Check for empty input:
    function emptyInputCheck($Category, $Brand, $Name, $Price, $Image){

        if($Category=="Unspecified"){
           $msg = "Product category cannot be empty!";
           $msg = base64_encode($msg);
           header("location: ../View/Inventory.php?msg=$msg");
        }else if($Brand==""){
            $msg = "Product brand cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
        }else if($Name==""){
            $msg = "Product name cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
        }else if($Price==""){
            $msg = "Product price cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
        }else if($Image==""){
            $msg = "Please upload an image";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
        }else{
            return true;
        }

    }

    /*
    function productExists($con, $category, $brand, $name){
            
        $sql = "SELECT * FROM product WHERE (product_name = ? AND product_brand = ? AND product_category = ?);";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sss", $name, $brand, $category);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }else{
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);

    }
    */

    //Add the product to the database:
    function InsertProduct($con, $category, $brand, $name, $price, $image){

        //Prepare and Execute SQL statement:
        $sql = "INSERT INTO product(product_category, product_brand, product_name, product_price) VALUES (?, ?, ?, ?);";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssss", $category, $brand, $name, $price);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        //Extract the productId generated when inserting to the database:
        $productId = mysqli_insert_id($con);

        //Extract image metadata:
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageSize = $image['size'];
        $imageError = $image['error'];
        $imageType = $image['type'];

        //Derive the image extension:
        $imageExtention = explode('.', $imageName);
        $imageActualExtension = strtolower(end($imageExtention));

        //Extensions allowed to refer to images within the system:
        $allowedExtenstions = array('jpg', 'jpeg', 'png', 'webp');

        $imageNameReal="";

        //Verify that the extension of the uploaded image is compatible with the system:
        if(in_array($imageActualExtension, $allowedExtenstions)){
            //Verify that there are no errors with uploading the image:
            if($imageError === 0){
                //Verify that the image is not too large in size:
                if($imageSize <= 50000000){
                    //Form full image name:
                    $imageNameReal = "Product" . $productId . "." . $imageActualExtension;
                    //Form image intended path:
                    $fileDestination = "../Commons/Products/" . $imageNameReal;
                    //Move the image to the intended location":
                    move_uploaded_file($imageTmpName, $fileDestination);
                    echo "Upload Success!";
                }else{
                    //File size is too large
                    $msg = "The file is too large, please try and compress it";
                    $msg = base64_encode($msg);
                    header("location: ../View/Inventory.php?msg=$msg");
                    exit();
                }
            }else{
                //There is an error with uploading the image
                $msg = "There was an error uploading the file";
                $msg = base64_encode($msg);
                header("location: ../View/Inventory.php?msg=$msg");
                exit();
            }
        }else{
            //The image file type is not compatible with the system
            $msg = "You cannot upload files of this type";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
            exit();
        }

        //As image is successfully uploaded now, updated the product_image attribute in the database:
        $sql = "UPDATE product SET product_image = ? WHERE product_id = ?;";

        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/Inventory.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $imageNameReal, $productId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        //Send success message ot the inventory page:
        $code = "Product added successfully!";
        $code = base64_encode($code);
        header("location: ../View/Inventory.php?msg=$code");

    }



