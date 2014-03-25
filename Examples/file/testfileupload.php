<?php
/**
 * Created by PhpStorm.
 * User: Sagar
 * Date: 3/21/14
 * Time: 11:49 AM
 */
require_once "../../Utilities.php";

if( Utilities::checkArray($_POST) )
{


    if( isset($_FILES))
    {
        $_FILES['name']['destination'] = '../../uploads/';
        $_FILES['name1']['destination'] = '../../uploads/';
        $_FILES['name2']['destination'] = '../../uploads/';

        $_FILES['name']['resize'] = array('prefix'=>'thumbforname','image_x'=>100,'path'=>'../../thumbs/');
        Utilities::initUploader();
        $aResults = Utilities::processFiles($_FILES);
        r($aResults);
    }
}
?>

<form name="form1" id="formID" action="" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
    <div class="from-control">
        <label class="control-label col-lg-3">Label</label>
        <div class="col-lg-9">
            <input type="file" class="form-control" name="name[]" id="name">
            <input type="file" class="form-control" name="name[]" id="name">
            <input type="file" class="form-control" name="name1[]" id="name">
            <input type="file" class="form-control" name="name1[]" id="name">
            <input type="file" class="form-control" name="name2" id="name">
            <button name="submit">Submit</button>
        </div>
    </div>
</form>