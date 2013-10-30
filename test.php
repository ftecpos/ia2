<?php

//header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename="file.pdf"');
echo(exec('wkhtmltopdf http://59.148.255.178:8080/report/ReceiptReview.php?receipt_No=6443 file.pdf 2>&1'));


/*
$myProjetDirectory = 'C:\wamp\www\ia230\snappy-master\snappy-master';
$snappy = new Pdf($myProjetDirectory . '/vendor/google/wkhtmltopdf-i386/wkhtmltopdf-i386');
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="file.pdf"');
echo $snappy->getOutput('http://www.github.com');

/*

$snappy = new Pdf();
$snappy->setBinary('C:\Program Files (x86)\wkhtmltopdf');
print_r("<pre>");
print_r($snappy);
print_r("</pre>");

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="file.pdf"');
echo $snappy->getOutput('http://www.github.com');
*/