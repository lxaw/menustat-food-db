<?php
// see:
// https://stackoverflow.com/questions/2905696/method-for-creating-php-templates-ie-html-with-variables


// Populates HTML template with data from array (dictionary)
// Input: $arrData (array of str), $filePath (str)
// Output: string of html template 
//
function load_template_to_string($arrData,$filePath){
    // load the template body
    //
    $tempBody = file_get_contents($filePath);
    // populate the template
    // NOTE: 
    // The values to populate in the template sould be 
    // in brackets, ie: [POPULATE_ME]
    //
    foreach($arrData as $key=>$value){
        $tempBody = str_replace("[$key]",$value,$tempBody);
    }
    return $tempBody;
}