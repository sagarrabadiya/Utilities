<?php

require_once "../../Utilities.php";

Utilities::initCSV();

/* basic csv parser return object having titles and data */
$csv = Utilities::parseCSV('_books.csv');
?>
<h1>Basic Parsing</h1>
<style type="text/css" media="screen">
    table { background-color: #BBB; }
	th { background-color: #EEE; }
	td { background-color: #FFF; }
</style>
<table border="0" cellspacing="1" cellpadding="3">
	<tr>
		<?php foreach ($csv->titles as $value): ?>
    <th><?php echo $value; ?></th>
<?php endforeach; ?>
</tr>
<?php foreach ($csv->data as $key => $row): ?>
    <tr>
        <?php foreach ($row as $value): ?>
            <td><?php echo $value; ?></td>
        <?php endforeach; ?>
    </tr>
<?php endforeach; ?>
</table>
<?php

/* parse csv as array returns array having titles and data 2 dimensional array */
$csv = Utilities::parseCSVAsArray('_books.csv');
?>
<style type="text/css" media="screen">
    table { background-color: #BBB; }
    th { background-color: #EEE; }
    td { background-color: #FFF; }
</style>
<h1>Parsing As Array</h1>
<table border="0" cellspacing="1" cellpadding="3">
    <tr>
        <?php foreach ($csv['titles'] as $value): ?>
            <th><?php echo $value; ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($csv['data'] as $key => $row): ?>
        <tr>
            <?php foreach ($row as $value): ?>
                <td><?php echo $value; ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>


<?php

/* conditional parse csv as array or object returns array or object having titles and data 2 dimensional array */
/*conditions can be any ONE as follow
'rating < 4 OR author is John Twelve Hawks'
'rating > 4 AND author is Dan Brown'
title contains paperback OR title contains hardcover

3rd argument is weather output should be as array or object having title and data if true then it will return array other wise object default is object
*/
$csv = Utilities::parseCSVWithConditions('_books.csv','rating < 4 OR author is John Twelve Hawks',true);
?>
<style type="text/css" media="screen">
    table { background-color: #BBB; }
    th { background-color: #EEE; }
    td { background-color: #FFF; }
</style>
<h1>Parsing As Array With Condition (rating < 4 OR author is John Twelve Hawks)</h1>
<table border="0" cellspacing="1" cellpadding="3">
    <tr>
        <?php foreach ($csv['titles'] as $value): ?>
            <th><?php echo $value; ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($csv['data'] as $key => $row): ?>
        <tr>
            <?php foreach ($row as $value): ?>
                <td><?php echo $value; ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>


<?php

/* parse csv with sorting sorting type limit offset as array or object returns array or object having titles and data 2 dimensional array */
/*
 * 2nd argument is sort by field it can be any field from csv file optional
 * 3rd argument is sort type it can be SORT_REGULAR SORT_NUMERIC or SORT_STRING the given argument will use ksort or krsort function to rearrange optional
 * 4th argument is limit optional
 * 5th argument is offset optional
 * 6th argument is weather output will array or object of titles and data
 * */
$csv = Utilities::customParseCSV('_books.csv','rating','SORT_REGULAR',5,2,true);
?>
<style type="text/css" media="screen">
    table { background-color: #BBB; }
    th { background-color: #EEE; }
    td { background-color: #FFF; }
</style>
<h1>Parsing As Array With sorting limit(5) and offset(2)</h1>
<table border="0" cellspacing="1" cellpadding="3">
    <tr>
        <?php foreach ($csv['titles'] as $value): ?>
            <th><?php echo $value; ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($csv['data'] as $key => $row): ?>
        <tr>
            <?php foreach ($row as $value): ?>
                <td><?php echo $value; ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>