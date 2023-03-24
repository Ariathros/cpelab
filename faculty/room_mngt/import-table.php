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
                $room_no = $row['0'];
                $room_type = $row['1'];
                $seat_count = $row['2'];
                $room_status = $row['3'];
                
                // INSERT Query
                $roomQuery = "INSERT INTO rooms (room_no, room_type, seat_count, room_status) 
                VALUES ('$room_no','$room_type','$seat_count','$room_status')";
                $result = mysqli_query($conn, $roomQuery);
                if($result) {
                    header("Location: room-mngt.php?msg=New Records Created Succesfully");
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
        header("Location: room-mngt.php?err=Invalid file format. Only accepts 'xls','csv','xlsx' file.");
    }
}
?>