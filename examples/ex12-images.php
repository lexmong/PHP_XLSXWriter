<?php
include_once("xlsxwriter.class.php");
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

$filename = "example.xlsx";
$font_max_width = 7;
$font_height_ratio = 0.75;
$image_width = 180;
$image_height= 220;

header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

$writer = new XLSXWriter();
$writer->setAuthor('Some Author'); 

$writer->writeSheetHeader('Sheet1',
    $rowdata = ["string", "string", "string", "string"],
    $col_options = [
        'widths' => array_fill(0,4, $image_width / $font_max_width),
        'suppress_row' => true,
        'font' => 'Arial',
        'font-size' => 10,
        'font-style' => 'bold',
    ]
);

$writer->writeSheetRow('Sheet1',
    ["","","",""],
    ['height' => $font_height_ratio * $image_height]
);


$writer->writeImg('Sheet1','img/pepper.png',0,0,[
    'width'     => $image_width,
    'height'    => $image_height,
]);

$writer->writeImg('Sheet1','img/pepper.jpeg',0,1,[
    'width'     => $image_width,
    'height'    => $image_height,
]);

$writer->writeImg('Sheet1','img/pepper.bmp',0,2,[
    'width'     => $image_width,
    'height'    => $image_height,
]);

$writer->writeImg('Sheet1','img/pepper.gif',0,3,[
    'width'     => $image_width,
    'height'    => $image_height,
]);

$writer->writeSheetRow('Sheet1',
    ["png","jpeg","bmp","gif"]
);


$writer->writeToStdOut();
//$writer->writeToFile('example.xlsx');
//echo $writer->writeToString();
exit(0);
