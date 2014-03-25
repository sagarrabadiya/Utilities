<?php

/**
 *
 */
define('UTILITY_PATH',dirname(__FILE__));
require_once UTILITY_PATH."/Lib/php-ref/ref.php";

/** you can use r() function for reference purpose.. which can generate variable value with structure */
/**
 * This is a utility class which includes all the common utilities used in the web application development!
 * Class Utilities
 * @author : Sagar Rabadiya
 * date: 21-3-2014
 * version: 0.0.1
 */
class Utilities {


    /**
     * @var array array of added files for uploader
     */
    public $aAddedFiles = array();
    /**
     *
     */
    function __construct()
    {

    }


    /* common utility functions which can be used in many ways.. */
    /**
     * @param $param
     * @param $request_uri
     * @return mixed
     */
    public static function removeParameterFromRequestURI( $param, $request_uri )
    {
        $sRegex = '/(\?|\&)'.$param.'=([^&]+)/si';
        $sReplace = "";

        if ( preg_match( $sRegex , $request_uri , $aMatches ) )
        {
            if ( $aMatches[1] == "?" )
            {
                $sReplace = "?";
            }
        }
        $request_uri = preg_replace( $sRegex , $sReplace , $request_uri );

        return str_replace( "?&" , "?" , $request_uri );
    }

    /**
     * Function that takes an request url and replaces a argument value or removes and argument all together
     *
     * Note if argument does not exist and value is !== false then the argument is added to the string
     *
     * Example of usage:
     * <code>
     * <?php
     *   $test1 = "start.php?parameter=value";
     *   $test2 = "start.php?id=1&parameter=value";
     *   $test3 = "start.php?id=1&parameter=value&number=2";
     *   $test4 = "start.php?parameter=value&key2=value2";
     *
     *   echo changeArgumentValueInRequestURI( "parameter" ,  false ,$test1 );//Remove parameter
     *   echo changeArgumentValueInRequestURI( "parameter" ,  false ,$test1 );//Remove parameter
     *   echo changeArgumentValueInRequestURI( "parameter" ,  false ,$test1 );//Remove parameter
     *   echo changeArgumentValueInRequestURI( "parameter" ,  "new_value" ,$test1 );//Remove parameter
     * ?>
     * </code>
     *
     * @param        string          $sArgumentName          The name of the argument to remove / replace value for
     * @param        mixed           $sNewArgumentValue      The new argument value (string) OR false (boolean) to be removed
     * @param        string          $sRequestUri            The supplied string to remove arguments in. Most often $_SERVER['REQUEST_URI']
     * @return       string
     *
     * @author       Jan Bolmeson (ZCE)   (jan.bolmeson@ecotech.se)
     * @version      1.00
     * @package      Framework
     */
    public static function changeArgumentValueInRequestURI( $sArgumentName, $sNewArgumentValue , $sRequestUri )
    {
        $sRegex = '/(&|\?)('.$sArgumentName.'=)([^&]+)/si';

        $sTmp = preg_replace( $sRegex , '$1$2##TO_BE_REPLACED##', $sRequestUri );

        return str_replace("##TO_BE_REPLACED##" , $sNewArgumentValue , $sTmp );
    }

    /**
     * Check if supplied string exists in original string
     * @param        string      $needle         The string to search for
     * @param        string      $haystack       The string to search in
     * @param        integer     $insensitive    Whether to ignore small and large letters
     * @return       boolean     True if the needle is a part of the haystack else false
     * @access       public
     */
    public static function in_string($needle, $haystack, $insensitive = 1)
    {
        if ($insensitive) {
            return (false !== stristr($haystack, $needle)) ? true : false;
        } else {
            return (false !== strpos($haystack, $needle))  ? true : false;
        }
    }

    /**
     * Function that checks if supplied array:
     *  1. isset()
     *  2. is_array()
     *  3. count() > 0
     *  4. !empty()
     *
     * @param    array       Array to check
     * @return   boolean     True if array fulfills all conditions stated above
     * @access   public
     */
    public static function checkArray( & $aArray )
    {
        return ( isset( $aArray ) && is_array( $aArray) && !empty( $aArray ) && count( $aArray ) > 0 ) ? true : false;
    }

    /**
     * @param $iTimestamp
     * @param string $sElseFormat
     * @return bool|string
     */
    public static function getDay( $iTimestamp , $sElseFormat = "Y-m-d" )
    {
        if ( date("ymd") == date("ymd",$iTimestamp ) )
        {
            return "idag";
        }

        if ( date("ymd",mktime(0,0,0,date("m"),date("d")-1,date("Y"))) == date("ymd",$iTimestamp ) )
        {
            return "yesterday";
        }

        return date( $sElseFormat , $iTimestamp );
    }

    /**
     * @return bool
     */
    public function isInternetExplorer()
    {
        if (isset($_SERVER['HTTP_USER_AGENT']) &&
            (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
            return true;
        else
            return false;
    }

    /**
     * @param string $sWhat
     * @return mixed
     */
    public static function getMonthsArray($sWhat = "both" )
    {
        $aMonths['short'] = array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
        $aMonths['long'] = array("Januari","Februari","March","April","May","June","July","August","September","October","November","December");

        return $sWhat == "both" ? $aMonths : $aMonths[$sWhat];
    }

    /**
     * @param $iIndex
     * @param bool $bMinusOne
     * @return mixed
     */
    public static function getMonthShortName( $iIndex , $bMinusOne = true )
    {
        $aMonths['short'] = Functions::getMonthsArray("short");

        return $bMinusOne ? $aMonths['short'][$iIndex-1] : $aMonths['short'][$iIndex];
    }

    /**
     * @param $iIndex
     * @param bool $bMinusOne
     * @return mixed
     */
    public static function getMonthFullName( $iIndex , $bMinusOne = true )
    {
        $aMonths['long'] = Functions::getMonthsArray("long");

        return $bMinusOne ? $aMonths['long'][$iIndex-1] : $aMonths['long'][$iIndex];
    }

    /**
     * @param $timestamp
     * @return string
     */
    public static function TimeSince( $timestamp )
    {
        $difference = time() - $timestamp;

        if($difference < 60)
            return $difference." second".($difference==1?"":"s")." ago";
        else{
            $difference = round($difference / 60);
            if($difference < 60)
                return $difference." minute".($difference==1?"":"s")." ago";
            else{
                $difference = round($difference / 60);
                if($difference < 24)
                    return $difference." hour".($difference==1?"":"s")." ago";
                else{
                    $difference = round($difference / 24);
                    if($difference < 7)
                    {
                        return $difference." day".($difference==1?"":"s")." ago";
                    }
                    else{
                        $difference = round($difference / 7);
                        return $difference." week".($difference==1?"":"s")." ago";
                    }
                }
            }
        }
    }

    /**
     * @param $sString
     * @param int $iLength
     * @return string
     */
    public static function truncate( $sString , $iLength = 20 )
    {
        $iParts = floor( $iLength / 2);

        $sResult = substr( $sString , 0 , $iParts );

        $sResult .= "...";

        $sResult .= substr( $sString , strlen($sString)-$iParts+3 ,$iParts-2  );

        return $sResult;
    }

    /**
     * @param $iLength
     * @return string
     */
    public static function getRandomChars( $iLength )
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";

        $pass = array(); //remember to declare $pass as an array

        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

        for ($i = 0; $i < $iLength; $i++)
        {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }


    /********************************************* Common Functions Over **************************************/


    /******************************************** File uploading Related Functions Starts *****************************/

    public static function initUploader()
    {
        require_once UTILITY_PATH."/Lib/FileUpload/class.upload.php";
    }

    /**
     * @param $aAllFiles
     * @return array
     */
    protected static function _rearrangeFiles($aAllFiles)
    {
        $aFilesToHandle = array();
        foreach($aAllFiles AS $sFieldName=>$aFiles)
        {
            foreach ($aAllFiles[$sFieldName] as $k => $l)
            {
                if(self::checkArray($l))
                {
                    foreach ($l as $i => $v)
                    {
                        if($k != 'resize' AND $k!= 'destination')
                        {
                            $aFilesToHandle[$sFieldName][$i][$k] = $v;
                            $aFilesToHandle[$sFieldName][$i]['destination'] = isset( $aAllFiles[$sFieldName]['destination'] ) ? $aAllFiles[$sFieldName]['destination'] : '../uploads/';
                            if( self::checkArray( $aAllFiles[$sFieldName]['resize'] ) )
                            {
                                $aFilesToHandle[$sFieldName][$i]['resize'] = $aAllFiles[$sFieldName]['resize'];
                            }
                        }
                    }
                }
                else
                {

                    $aFilesToHandle[$sFieldName][$k] = $l;
                    $aFilesToHandle['name1']['destination'] = isset( $aAllFiles[$sFieldName]['destination'] ) ? $aAllFiles[$sFieldName]['destination'] : '../uploads/';
                    if( self::checkArray( $aAllFiles[$sFieldName]['resize'] ) )
                    {
                        foreach($aAllFiles[$sFieldName]['resize'] AS $key=>$val)
                            $aFilesToHandle[$sFieldName]['resize'][$key] = $val;
                    }
                }
            }
        }

        foreach( $aFilesToHandle AS $sKey => $aFile )
        {
            if( ! isset( $aFile['name'] ) )
            {
                unset($aFilesToHandle[$sKey]['destination']);
                unset($aFilesToHandle[$sKey]['resize']);
            }
        }
        return $aFilesToHandle;
    }


    /**
     * @param $aAllFiles
     * @return array|bool
     */
    public static function processFiles($aAllFiles)
    {
        $aArrangedFiles = self::_rearrangeFiles($aAllFiles);
        if( self::checkArray($aArrangedFiles))
        {
            $aError = array();
            foreach( $aArrangedFiles AS $sKey=>$aFile )
            {
                if( isset( $aFile['name'] ) )
                {
                    $aError[$sKey] = self::_processFile($aFile);
                }
                else
                {
                    foreach($aFile AS $sSubKey=>$aSubFile)
                        $aError[$sKey][$sSubKey] = self::_processFile($aSubFile);
                }
            }
            return $aError;
        }
        return false;
    }

    /**
     * @param $aFile
     * @return array
     */
    protected static function _processFile($aFile)
    {
        $sDestination = $aFile['destination'];
        $aResize = ( isset($aFile['resize']) AND self::isImageFile($aFile['name']) ) ? $aFile['resize'] : array();

        unset($aFile['destination']);
        unset($aFile['resize']);
        $aError = array();
        $oFileUploader = new upload($aFile);
        if ($oFileUploader->uploaded)
        {
            // save uploaded image with no changes
            $sNewFileName = self::isFileNameIncludedInDestination($sDestination);
            if( ! $sNewFileName )
            {
                $aTemp = pathinfo($aFile['name']);
                $sNewFileName = $aTemp['filename'];
            }
            $oFileUploader->file_new_name_body = $sNewFileName;
            $oFileUploader->Process(self::getFilePathWithoutName( $sDestination ));
            if ($oFileUploader->processed)
            {
                $aError['success'] = true;
            } else {
                $aError['success'] = false;
                $aError['error'] = $$oFileUploader->error;
            }

            // resize image
            if( self::checkArray( $aResize ) )
            {
                $handle = new upload($aFile);
                if ($handle->uploaded) {
                    $handle->file_new_name_body   = isset( $aResize['prefix'] ) ? $aResize['prefix'].$sNewFileName : "thumb_".$sNewFileName;
                    $handle->image_resize         = true;
                    $handle->image_x              = intval($aResize['image_x']);
                    $handle->image_ratio_y        = true;
                    $handle->process($aResize['path']);
                    if( $handle->processed )
                    {
                        $aError['thumb']['success'] = true;
                        $handle->clean();
                    }
                    else
                    {
                        $aError['thumb']['success'] = false;
                        $aError['thumb']['error'] = $handle->error;
                    }
                }

            }

        }
        return $aError;
    }


    /**
     * @param $sDest
     * @return bool
     */
    public static function isFileNameIncludedInDestination( $sDest )
    {
        $sFile = basename($sDest);
        $aFileComponent = explode('.',$sFile);
        if( count($aFileComponent) > 1 )
            return $aFileComponent[0];

        return false;
    }


    /**
     * @param $sName
     * @return bool
     */
    public static function isImageFile( $sName )
    {
        $aFilePart = explode(".",$sName);
        if( count($aFilePart) > 1)
        {
            $sExt = end($aFilePart);
            if( $sExt == 'jpg' OR $sExt == 'jpeg' OR $sExt == 'png' OR $sExt == 'BMP' OR $sExt == 'gif')
                return true;
            return false;
        }
        return false;
    }

    /**
     * @param null $sDest
     * @return bool|null
     */
    public static function getFilePathWithoutName( $sDest = NULL )
    {
        if( !empty($sDest) )
        {
            if( self::isFileNameIncludedInDestination($sDest) )
            {
                $aFileInfo = pathinfo($sDest);
                return $aFileInfo['dirname'];
            }
            return $sDest;
        }
        return false;
    }

    /******************************************** File uploading Related Functions Ends *****************************/

    public static function downloadFile( $sFileName , $sDownloadedFileName = "attachments" )
    {
        if( file_exists($sFileName) )
        {
               $aFilePart = explode(".",$sFileName);
               $type = end($aFilePart);
               if($type=='png') {
                   header("Content-type: image/png");
               } else if($type=='jpeg' or $type=='jpg') {
                   header("Content-type: image/jpeg");
               }	else if($type=='pdf') {
                   header("Content-type: application/pdf");
               } else if($type=='txt') {
                   header("Content-type: text/plain");
               }	else if($type=='html' or $type=='htm') {
                   header("Content-type: text/html");
               }	else if($type=='exe') {
                   header("Content-type: application/octet-stream");
               }	else if($type=='zip') {
                   header("Content-type: application/zip");
               } 	else if($type=='doc') {
                   header("Content-type: application/msword");
               }	else if($type=='xls') {
                   header("Content-type: application/vnd.ms-excel");
               }	else if($type=='ppt') {
                   header("Content-type: application/vnd.ms-powerpoint");
               }	else if($type=='gif') {
                   header("Content-type: image/gif");
               }	else if($type=='php') {
                   header("Content-type: text/plain");
               } else {
                   header("Content-type: application/octet-stream");
               }

                header('Content-Disposition: attachment; filename="'.$sDownloadedFileName.'.'.$type.'"');
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header("Cache-Control: public");
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($sFileName));
                readfile($sFileName);

        }
        return false;
    }

    /****************************************** CSV File related function starts **********************************/

    public static function initCSV()
    {
        require_once UTILITY_PATH."/Lib/csvHandler/parsecsv.lib.php";
    }

    /**
     * @param $sFileName
     * @return bool|stdClass
     */
    public static function parseCSV( $sFileName )
    {
        if( file_exists($sFileName) )
        {
            $oCSV = new parseCSV();

            $oCSV->auto($sFileName);

            $oResponse = new stdClass();
            $oResponse->titles = $oCSV->titles;
            $oResponse->data = $oCSV->data;

            return $oResponse;
        }
        return false;
    }

    /**
     * @param $sFileName
     * @return array|bool
     */
    public static function parseCSVAsArray( $sFileName )
    {
        if( file_exists($sFileName) )
        {
            $oCSV = new parseCSV();

            $oCSV->auto($sFileName);

            $aResponse = array();
            $aResponse['titles'] = $oCSV->titles;
            $aResponse['data'] = $oCSV->data;
            return $aResponse;
        }
        return false;
    }

    /**
     * @param $sFileName
     * @param $sConditions
     * @param bool $bAsArray
     * @return array|bool|stdClass
     */
    public static function parseCSVWithConditions( $sFileName , $sConditions , $bAsArray = false )
    {
        if( file_exists($sFileName))
        {
            $oCSV = new parseCSV();

            if( empty( $sConditions ) )
            {
                return $bAsArray ? self::parseCSVAsArray($sFileName) : self::parseCSV($sFileName);
            }
            $oCSV->conditions = $sConditions;

            $oCSV->auto($sFileName);

            if( $bAsArray )
            {
                $aResponse = array();
                $aResponse['titles'] = $oCSV->titles;
                $aResponse['data'] = $oCSV->data;
                return $aResponse;
            }
            else
            {
                $oResponse = new stdClass();
                $oResponse->titles = $oCSV->titles;
                $oResponse->data = $oCSV->data;

                return $oResponse;
            }
        }
        return false;
    }

    /**
     * @param $sFilename
     * @param null $sSortBy
     * @param null $sSortType
     * # regular = SORT_REGULAR
     * # numeric = SORT_NUMERIC
     * # string  = SORT_STRING
     * @param null $iLimit
     * @param null $iOffset
     * @param bool $bAsArray
     * @return array|bool|stdClass
     */
    public static function customParseCSV($sFilename, $sSortBy = NULL, $sSortType = NULL ,  $iLimit = NULL, $iOffset = NULL , $bAsArray = false)
    {
        if( file_exists($sFilename))
        {
            $oCSV = new parseCSV();

            if( !empty( $sSortBy ) )
                $oCSV->sort_by = $sSortBy;

            if( !empty( $sSortType ) )
                $oCSV->sort_type = $sSortType;

            if( !empty( $iLimit ) )
                $oCSV->limit = $iLimit;

            if( !empty($iOffset))
                $oCSV->offset = $iOffset;

            $oCSV->auto($sFilename);

            if( $bAsArray )
            {
                $aResponse = array();
                $aResponse['titles'] = $oCSV->titles;
                $aResponse['data'] = $oCSV->data;
                return $aResponse;
            }
            else
            {
                $oResponse = new stdClass();
                $oResponse->titles = $oCSV->titles;
                $oResponse->data = $oCSV->data;

                return $oResponse;
            }

        }
        return false;
    }

    /****************************************** CSV File related function starts **********************************/


    /****************************************** PDF related function starts **********************************/

    /* for pdf purpose this utility uses mpdf as its base class */
    /**
     * pdf initiator
     */
    public static function initPDF()
    {
        require_once UTILITY_PATH."/Lib/MPDF/mpdf.php";
    }

    /**
     * @param $sHtml
     * @param null $sFileName it will be complete relative or absolute path on server including filename
     * @param string $mode mode Can be 'D' or 'F' D- download file F-save file in directory works only when file name is given
     */
    public static function generateBasicPDF($sHtml,$sFileName = NULL,$mode = 'F')
    {
        $oPDF = new mPDF();

        $oPDF->WriteHTML($sHtml);
        if( empty( $sFileName ) )
            $oPDF->Output();
        else
            $oPDF->Output($sFileName,$mode);
    }

    /**
     * @param $sHtml
     * @param null $sFileName same as above
     * @param null $sStyleSheetName it will be the absolute path of the css file including name
     * @param string $mode same as above
     */
    public static function generatePDFWithCSS($sHtml,$sStyleSheetName = NULL ,$sFileName = NULL, $mode = 'F')
    {
        $oPDF = new mPDF('c');

        $oPDF->SetDisplayMode('fullpage');

        // LOAD a stylesheet
        $stylesheet = file_get_contents($sStyleSheetName);
        $oPDF->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

        $oPDF->WriteHTML($sHtml);

        if( empty( $sFileName ) )
            $oPDF->Output();
        else
            $oPDF->Output($sFileName,$mode);
    }


    /**
     * @param null $sArguments
     * @return mPDF
     */
    public static function getMPDFObject($sArguments = NULL)
    {
        if( empty( $sArguments ) )
            return new mPDF();
        else
            return new mPDF($sArguments);
    }

    /****************************************** PDF related function ends **********************************/


    /****************************************** Excel related function starts **********************************/

    /* utilities uses phpexcel class for excel generation */
    /**
     * initiator of phpexcel
     */
    public static function initEXCEL()
    {
        require_once UTILITY_PATH."/Lib/PHPExcel/PHPExcel.php";
    }

    /**
     * @param $aData
     * @param null $sFileName
     * @param string $sCreator
     * @param string $sLastModifiedBy
     * @param string $sTitle
     * @param string $sSubject
     * @param string $sType
     * @return bool
     */
    public static function generateExcel($aData,$sFileName = NULL ,$sCreator = 'Utilities',$sLastModifiedBy = "Utilities Class",$sTitle = 'Excel Document',$sSubject = "Excel Document",$sType = 'Excel2007')
    {
        $objPHPExcel = new PHPExcel();
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        // Set document properties
        $objPHPExcel->getProperties()->setCreator($sCreator)
            ->setLastModifiedBy($sLastModifiedBy)
            ->setTitle($sTitle)
            ->setSubject($sSubject)
            ->setDescription("generated using Utilities class.")
            ->setKeywords("office PHPExcel php")
            ->setCategory("Test result file");


        $objPHPExcel->setActiveSheetIndex(0);
        //writing titles
        $row = 1;
        $col = 0;
        foreach( $aData[0] AS $sTitle )
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $sTitle);
            $col++;
        }
        unset( $aData[0] );
        $row++;

        //write data
        foreach($aData AS $aValues)
        {
            $col = 0;
            foreach( $aValues AS $sValue )
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$sValue);
                $col++;
            }
            $row++;
        }


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        if( empty($sFileName))
        {
            // Redirect output to a client’s web browser (Excel2007)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="01simple.xlsx"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header ('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
        }
        else
        {
            $objWriter->save($sFileName);
        }
        return true;
    }

    /**
     * @return PHPExcel
     */
    public static function getPHPExcelObject()
    {
        return new PHPExcel();
    }

    /**
     * @param $sFileName
     * @param string $sVersion
     * @return bool
     */
    public static function readExcelAsArray($sFileName,$sVersion = 'Excel2007')
    {
        if( !empty($sFileName) AND file_exists($sFileName))
        {
            $objReader = PHPExcel_IOFactory::createReader( $sVersion );
            $objReader->setReadDataOnly(true);

            /**
             * @var PHPExcel_Reader_Excel2007
             */
            $objPHPExcel = $objReader->load( $sFileName );

            //display all the sheets
            $iSheetCount = $objPHPExcel->getSheetCount();
            $aExcelSheets = $objReader->listWorksheetNames( $sFileName );

            $iActiveSheetIndex = 0;
            /**
             * @var PHPExcel_Worksheet
             */
            $objWorksheet = $objPHPExcel->setActiveSheetIndex( $iActiveSheetIndex );

            $oRows = $objWorksheet->getRowIterator();
            $aTitles = array();
            foreach( $oRows AS $oRow)
            {
                $rowIndex = $oRow->getRowIndex();

                $oCellIterator = $oRow->getCellIterator();
                $iCol = 0;
                foreach( $oCellIterator as $oCell )
                {
                    if( $rowIndex == 1 )
                    {
                        $aTitles[$iCol] = $oCell->getCalculatedValue();
                    }
                    $aDefaultsExcelData[$rowIndex-1][$aTitles[$iCol]] = $oCell->getCalculatedValue();
                    $iCol++;
                }
            }
            return $aDefaultsExcelData;
        }
        return false;
    }

    /****************************************** Excel related function ends **********************************/


    /******************************************** phpmailer related function starts *******************************/

    public static function initMail()
    {
        require_once UTILITY_PATH."/Lib/PHPMailer/PHPMailerAutoload.php";
    }

    /**
     * @param $aReceipents
     * @param array $aFrom
     * @param string $sSubject
     * @param $sHTML
     * @param array $aAttachments
     * @param null $sHtmlTemplate
     * @return array
     */
    public static function sendMail($aReceipents,$aFrom = array(),$sSubject = "PHPMailer Mail",$sHTML,$sHtmlTemplate = NULL,$aAttachments = array())
    {
        $aError = array();
        if( empty($aReceipents) )
        {
            $aError[] = 'Receipent is not defined!';
            return $aError;
        }
        if( empty( $aFrom ) )
        {
            $aError[] = 'From is not defined!';
            return $aError;
        }
        if( empty($sHTML) AND empty($sHtmlTemplate) )
        {
            $aError[] = 'Mail Body is not defined!';
            return $aError;
        }

        $oMailer = new PHPMailer();
        $oMailer->isSendmail();

        $oMailer->setFrom($aFrom['email'], $aFrom['name']);
        //Set an alternative reply-to address
        $oMailer->addReplyTo($aFrom['email'], $aFrom['name']);
        //Set who the message is to be sent to

        foreach($aReceipents AS $aReceipent)
        {
            if(self::checkArray($aReceipent))
                $oMailer->addAddress($aReceipent['email'], $aReceipent['name']);
            else
                $oMailer->addAddress($aReceipent);
        }
        //Set the subject line
        $oMailer->Subject = $sSubject;
        if( !empty($sHtmlTemplate) )
        {
            if( file_exists($sHtmlTemplate))
            {
                $oMailer->msgHTML(file_get_contents($sHtmlTemplate), dirname(__FILE__));
            }
            else
            {
                $aError[] = "Html Template Not found!";
            }
        }
        else
        {
            $oMailer->msgHTML($sHTML);
        }
        //Attachments
        if( !empty($aAttachments))
        {
            foreach($aAttachments AS $aAttachment )
            {
                if( self::checkArray($aAttachment) )
                    $oMailer->addAttachment($aAttachment['path'],$aAttachment['name']);
                else
                    $oMailer->addAttachment($aAttachment);
            }
        }
        //send the message, check for errors
        if (!$oMailer->send())
        {
            $aError[] = $oMailer->ErrorInfo;
        } else
        {
            $aError['success'] = true;
        }
        return $aError;
    }

    /******************************************** phpmailer related function ends *******************************/

    /******************************************* XML related functions starts **********************************/

    public static function initXML()
    {
        require_once UTILITY_PATH."/Lib/xml/Array2XML.php";
    }

    /**
     * @param null $sRootNode
     * @param $aArray
     * @param null $sFileName
     * @return array
     */
    public static function Array2XML($sRootNode = NULL, $aArray , $sFileName = NULL )
    {
        if( empty($aArray) OR empty($sRootNode) )
        {
            return array('Root Node or node Array is not defined!');
        }

        $oXML = Array2XML::createXML($sRootNode,$aArray);
        file_put_contents($sFileName,$oXML->saveXML());
    }

    /**
     * @param $sXML
     * @return mixed
     */
    public static function XML2Array( $sXML )
    {
        return json_decode(json_encode((array)simplexml_load_string($sXML)),1);
    }

    /******************************************* XML related functions ends **********************************/

    /******************************************* CURL related functions starts **********************************/

    public static function sendCURL($sDestination,$aFields = array() , $sType = "POST" , $sCookieFile = NULL)
    {
        if( empty( $sDestination ) )
        {
            return false;
        }
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $sDestination );

        if( !empty($aFields))
        {
            $sFields = self::Array2String($aFields);
            curl_setopt($c, CURLOPT_POSTFIELDS, $sFields );
        }
        if( $sType == "POST" )
        {
            curl_setopt($c, CURLOPT_POST, 3);
        }

        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

        if( ! empty( $sCookieFile ) )
        {
            curl_setopt($c, CURLOPT_COOKIEFILE, $sCookieFile);
            curl_setopt($c, CURLOPT_COOKIEJAR , $sCookieFile );
        }

        $userAgent  = 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:11.0) Gecko/20100101 Firefox/11.0';
        curl_setopt($c, CURLOPT_USERAGENT,  $userAgent); // empty user agents probably not accepted
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($c, CURLOPT_AUTOREFERER,    1);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($c, CURLOPT_HEADER, 1);
        curl_setopt($c, CURLOPT_REFERER, $sDestination);
        $sHtml = curl_exec ($c);
        curl_close ($c);
        return $sHtml;
    }

    /**
     * @param $aFields
     * @return string
     */
    public static function Array2String( $aFields )
    {
        $sFields = "";
        foreach( $aFields AS $sKey => $sValue )
        {
            $sFields .= "&".$sKey."=".$sValue;
        }
        return substr( $sFields , 1 );
    }
}