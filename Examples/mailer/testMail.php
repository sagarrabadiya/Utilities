<?php

require_once "../../Utilities.php";

Utilities::initMail();


/** reciepents will be either 2 dimensional array or 1 dimensional array with emails only
 * following is the example of 2 dimensional and 1 dimensional array of reciepents!
 */
$aReciepents[0]['email'] = 'sam.coolone70@gmail.com';
$aReciepents[0]['name'] = 'sagar Rabadiya';

$aReciepents[1]['email'] = 'sagar@techplussoftware.com';
$aReciepents[1]['name'] = 'sagar Rabadiya';


/*** 1 dimensional array of reciepents **/
$aReciepentsSingle[] = 'sam.coolone70@gmail.com';
$aReciepentsSingle[] = 'sagar@techplussoftware.com';

/** from will be array containing name and email of the from person */
$aFrom['name'] = "Sagar Rabadiya";
$aFrom['email'] = 'sagar@techplussoftware.com';

/** attachments can be 2 dimensional or 1 dimensional array as follow it can contain full or absolute path including name */
$aAttachmentsSingle[] = 'photo1.jpg';
$aAttachmentsSingle[] = 'photo2.jpg';

/** 2 dimensional array that can include name of attahcments also to display in email */
$aAttachments[0]['path'] = 'photo1.jpg';
$aAttachments[0]['name'] = "pic 1";

$aAttachments[1]['path'] = 'photo2.jpg';
$aAttachments[1]['name'] = "pic 2";

/** 1st argument will be the array of receipents
 *  2nd argument will be array of from address
 *  3rd argument will be subject of the email
 *  4th argument will be body of email that will be html content ( will be ignored if template is given )
 * 5th argument will be name of email template, if it should be used instead of html string if html template is passed then email body will be ignored and
 *      content of the template will be used! if no template then you can give '' or omit if you have no attachment
 *
 * 6th argument will be array of attachements optional if no attachment then you can ommit it
 *
 *
 * it will return the array of status if all went good it will return array with index success value true like
 * $aArray['success'] = true;
 * and if it has error then it will return array including all the errors!
 */
$body = '<h1>Test</h1>';
$aResponse = Utilities::sendMail($aReciepents,$aFrom,'Utilities Test Mail',$body,'',$aAttachments);
r($aResponse);

/* consider 5th argument that is template for email if last argument is passed then template must be exists and $body html will be ignored!
$aResponse = Utilities::sendMail($aReciepents,$aFrom,'Utilities Test Mail',$body,'content.html',$aAttachments);

*/