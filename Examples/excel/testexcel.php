<?php

/* two dimensional data for excel 1st element that is 0 index will be used as titles for the sheet */
/* 1st dimension will be number of row and 2nd dimension will be column number */
$aTestData[0][] = 'Name';
$aTestData[0][] = 'Roll No';
$aTestData[0][] = 'Subject';

$aTestData[1][] = 'Sagar';
$aTestData[1][] = '206';
$aTestData[1][] = 'PHP';

$aTestData[2][] = 'Niyati';
$aTestData[2][] = '225';
$aTestData[2][] = 'PHP';

$aTestData[3][] = 'Fenil';
$aTestData[3][] = '200';
$aTestData[3][] = 'CSS';

$aTestData[4][] = 'Jay';
$aTestData[4][] = '199';
$aTestData[4][] = 'JQUERY';

require_once "../../Utilities.php";
Utilities::initEXCEL();

/* 1st argument is excel data 2 dimensional array,
2nd arguent will be file name where it should save including absolute or relative path
3rd argument will be creator of the file optional
4th argument will be last modified by the file optional
5th argument will be title of the sheet
6th argument will be subject of the sheet
*/
Utilities::generateExcel($aTestData,'test.xlsx','Sagar','Sagar','Subject Data','survey');


/* to read the excel as 2 dimensional array of data in which 1st dimension will be number of record and 2nd dimension will be name of field
    1st element will always be the titles of the sheet
 */

r(Utilities::readExcelAsArray('test.xlsx'));

/* to perform advanced operation with phpexcel plugin use following method to get the object of phpexcel */

$objExcel = Utilities::getPHPExcelObject();