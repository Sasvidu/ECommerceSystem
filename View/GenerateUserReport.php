<?php

include '../commons/fpdf184/fpdf.php';

//$userObj = new User();
//$userResult = $userObj->getallUsers();


$fpdf = new FPDF();
$fpdf->AddPage("P", "A4");

$fpdf->SetTitle("User Report");

$fpdf->SetFont("Arial", "B", "20");

//$fpdf->Image("../images/user_images/logo.jpg", 10,5,30,30);

$fpdf->Cell(0, 20, "User Report", 0, 1, "C");

$fpdf->SetFont("Arial", "B", 10);

$fpdf->Cell(0, 20, "", 0, 1, "C");

$fpdf->Cell(30, 8, "Name", 1, 0, "C");
$fpdf->Cell(60, 8, "Email", 1, 0, "C");
$fpdf->Cell(30, 8, "Date of Birth", 1, 0, "C");
$fpdf->Cell(30, 8, "NIC", 1, 0, "C");
$fpdf->Cell(30, 8, "Status", 1, 1, "C");

$fpdf->SetFont("Arial", "", 10);

/*
while($userrow- $userResult->fetch_assoc())
{
    $fpdf->Cell(30,8,"$userrow[user_fname]",1,0,"C");
    $fpdf->Cell(60,8,"$userrow[user_email]",1,0,"C");
    $fpdf->Cell(30,8,"$userrow[user_dob]",1,0,"C");
    $fpdf->Cell(30,8,"$userrow[user_nic]",1,0,"C");
    $status;

    if($userrow["user_status"]==1)
    {
        $status="Active";
    }
    else
    {
        $status="De Active";
    }

    $fpdf->Cell(30,8,"Active",1,1,"C");

}
*/


$fpdf->Cell(0, 50, "", 0, 1, "L");
$fpdf->Cell(0, 10, "This isa computer generateddocument, and therefore requires no authorized signature", 0, 1, "c");













$fpdf->Output();
