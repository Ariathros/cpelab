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
                $equip_code = $row['0'];
                $equip_name = $row['1'];
                $category = $row['2'];
                $description = $row['3'];
                $total = $row['4'];
                $available = $row['5'];
                $p_img = $row['6'];
                
                // INSERT Query
                $equipQuery = "INSERT INTO equipments (equip_code, equip_name, category, description, total, available, p_img) 
                VALUES ('$equip_code','$equip_name','$category','$description','$total','$available','$p_img')";
                $result = mysqli_query($conn, $equipQuery);
                if($result) {
                    header("Location: equip-mngt.php?msg=New Records Created Succesfully");
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
        header("Location: equip-mngt.php?err=Invalid file format. Only accepts 'xls','csv','xlsx' file.");
    }
}
?>