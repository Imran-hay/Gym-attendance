<?php require_once "../Database/DB.php";
require "../libraries/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


use PhpOffice\PhpSpreadsheet\Spreadsheet;







if(isset($_POST['butt']))
{
  
$date = $_POST['date'];
echo  $_POST['date'];
$ds = strval($date);
$cDate = date('Y-m-d', strtotime($date));
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Write the headers to the spreadsheet
$headers = array('ID', 'Name', 'TimeIN', 'TimeOut');
$sheet->fromArray($headers, NULL, 'A1');
$x =1;

$sql = "SELECT * FROM  table_attendance";
$result = mysqli_query($conn, $sql);


// Write the data to the spreadsheet
$row = 2;
while ($data = $result->fetch_assoc()) {
    if($data['LOGDATE'] == $date)
    {
        $sheet->setCellValue('A'.$row, $data['ID']);
        $sheet->setCellValue('B'.$row, $data['ATTENDANT_NAME']);
        $sheet->setCellValue('C'.$row, $data['TIMEIN']);
        $sheet->setCellValue('d'.$row, $data['TIMEOUT']);
        $row++;
    }

    }


// Create a new CSV writer and save the spreadsheet to a file
$writer = new Csv($spreadsheet);
$writer->setDelimiter(',');
$writer->setEnclosure('"');
$writer->setLineEnding("\r\n");
$writer->setSheetIndex(0);
//$writer->save("$date" . ".csv");
$path = "../Attendance/" . $date . ".csv";
$writer->save($path);






}





?>

<html>
    <head>
        <title>Excel</title>
    </head>
<body>

<form method="post" action="Excel.php">
    <input type="date" name="date">
    <button name="butt">Print</button>


</form>


</body>

</html>