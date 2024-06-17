<?php

require_once '../Commons/ECommerceDB.php';

    function emptyInputCheck($Category, $Brand, $Name, $Price, $Image){

        if($Category==""){
           $msg = "Product category cannot be empty!";
           $msg = base64_encode($msg);
           header("location: ../View/InventoryManageProducts.php?msg=$msg");
        }else if($Brand==""){
            $msg = "Product brand cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageProducts.php?msg=$msg");
        }else if($Name==""){
            $msg = "Product name cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageProducts.php?msg=$msg");
        }else if($Price==""){
            $msg = "Product price cannot be empty!";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageProducts.php?msg=$msg");
        }else if($Image==""){
            $msg = "Please upload an image";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageProducts.php?msg=$msg");
        }else{
            return true;
        }

    }

    function UpdateProduct($con, $id, $category, $brand, $name, $price, $image){

        $sql = "UPDATE product SET product_category = ? , product_brand = ? , product_name = ? , product_price = ? , product_image = ? WHERE product_id = ?";

        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageSize = $image['size'];
        $imageError = $image['error'];
        $imageType = $image['type'];

        $imageExtention = explode('.', $imageName);
        $imageActualExtension = strtolower(end($imageExtention));
        $allowedExtenstions = array('jpg', 'jpeg', 'png');

        $imageNameReal="";

        if(in_array($imageActualExtension, $allowedExtenstions)){
            if($imageError === 0){
                if($imageSize <= 50000000){
                    $imageNameReal = "Product" . $id . "." . $imageActualExtension;
                    $fileDestination = "../Commons/Products/" . $imageNameReal;
                    move_uploaded_file($imageTmpName, $fileDestination);
                    echo "Upload Success!";
                }else{
                    $msg = "The file is too large, please try and compress it";
                    $msg = base64_encode($msg);
                    header("location: ../View/InventoryManageProducts.php?msg=$msg");
                }
            }else{
                $msg = "There was an error uploading the file";
                $msg = base64_encode($msg);
                header("location: ../View/InventoryManageProducts.php?msg=$msg");
            }
        }else{
            $msg = "You cannot upload files of this type";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageProducts.php?msg=$msg");
        }


        $stmt = mysqli_stmt_init($con);  

        if(!mysqli_stmt_prepare($stmt, $sql)){
            $msg = "Error: MySQL statement Failed";
            $msg = base64_encode($msg);
            header("location: ../View/InventoryManageProducts.php?msg=$msg");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssssss", $category, $brand, $name, $price, $imageNameReal, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $code = "Product updated successfully!";
        $code = base64_encode($code);
        header("location: ../View/InventoryManageProducts.php?msg=$code");

    }



