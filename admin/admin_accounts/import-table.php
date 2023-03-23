<?php
include '../../connections.php';
include '../sessions.php';

require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// when import button is pressed
if(isset($_POST['save_excel_data']))
{
    // get the file name and extension
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    // allowed extensions
    $allowed_ext = ['xls','csv','xlsx'];
    // check if file format is allowed
    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        // offset for column header
        $count = "0";
        foreach($data as $row)
        {
            // skips the header row
            if($count > 0)
            {   
                // get the values on each row
                $firstName = $row['0'];
                $lastName = $row['1'];
                $id_num = $row['2'];
                $username = $row['3'];
                $email = $row['4'];
                $password = $row['5'];
                $usertype = $row['6'];
                // INSERT Query
                $userQuery = "INSERT INTO useraccounts (firstname,lastname,id_num,username, email, password, usertype) 
                VALUES ('$firstName','$lastName','$id_num','$username','$email','$password','$usertype')";
                $result = mysqli_query($conn, $userQuery);
                if($result) {
                    header("Location: admin-accounts.php?msg=New Record Created Succesfully");
                }
                else {
                    echo "Failed: " . mysqli_error($conn); 
                }
            }
            // increment count to start getting data on the 2nd row
            else
            {
                $count = "1";
            }
        }
    }
    // redirect with error flash message
    else
    {
        header("Location: admin-accounts.php?err=Invalid file format");
    }
}
?>