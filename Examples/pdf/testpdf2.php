<?php
$html = '
<h1>mPDF</h1>
<h2>Basic Example Using CSS Styles</h2>
<p class="breadcrumb">Chapter &raquo; Topic</p>
<h3>Heading 3</h3>
<h4>Heading 4</h4>
<h5>Heading 5</h5>
<p>Nulla felis erat, imperdiet eu, ullamcorper non, nonummy quis, elit. Suspendisse potenti. Ut a eros at ligula vehicula pretium. Maecenas feugiat pede vel risus. Nulla et lectus. Fusce eleifend neque sit amet erat. Integer consectetuer nulla non orci. Morbi feugiat pulvinar dolor. Cras odio. Donec mattis, nisi id euismod auctor, neque metus pellentesque risus, at eleifend lacus sapien et risus. Phasellus metus. Phasellus feugiat, lectus ac aliquam molestie, leo lacus tincidunt turpis, vel aliquam quam odio et sapien. Mauris ante pede, auctor ac, suscipit quis, malesuada sed, nulla. Integer sit amet odio sit amet lectus luctus euismod. Donec et nulla. Sed quis orci. </p>
<h4>Heading using Small-Caps - supported from mPDF version 5</h4>
<p>Proin aliquet lorem id felis. Curabitur vel libero at mauris nonummy tincidunt. Donec imperdiet. Vestibulum sem sem, lacinia vel, molestie et, laoreet eget, urna. Curabitur viverra faucibus pede. Morbi lobortis. Donec dapibus. Donec tempus. Ut arcu enim, rhoncus ac, venenatis eu, porttitor mollis, dui. Sed vitae risus. In elementum sem placerat dui. Nam tristique eros in nisl. Nulla cursus sapien non quam porta porttitor. Quisque dictum ipsum ornare tortor. Fusce ornare tempus enim. </p>
';

require_once "../../Utilities.php";

Utilities::initPDF();

/* 2nd argument is the css it can be full path of css relative or absolute including name and 3rd and 4th argument is optional */
Utilities::generatePDFWithCSS($html,'mpdfstyleA4.css','pdf/test2.pdf','F');


/** if you want to perform advanced operations on mpdf then you can get the object of mpdf as follow */
$oPdf = Utilities::getMPDFObject();

/* also if you want to give the constructor argument you can specify in method as follow */
$oPdf = Utilities::getMPDFObject('c');

/* this will let you communicate directly with mpdf */