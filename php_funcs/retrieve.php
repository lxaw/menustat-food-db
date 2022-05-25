<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// for connection to db
//
require_once('db_connect.php');

// for template to str
//
require_once('template_to_str.php');

function strReplaceIfNull($strValue, $strReplacement){
    // replaces $value if NULL
    if($strValue!= NULL){
        return $strValue;
    }
    return $strReplacement;
}

function strGetImgPath($strFoodName,$strRestaurantName,$strSourcePath){
    // returns NULL or image path
    // essentially we are redoing what we did in scrape.py
    // 's strSlugName(strName) function.
    // (see https://github.com/lxaw/menustat-food-db)
    //
    $strFormattedFoodName = str_replace("/","~",$strFoodName);
    $strFormattedFoodName= str_replace(" ","_",$strFormattedFoodName);

    $strFormattedRestName = str_replace("/","~",$strRestaurantName);
    $strFormattedRestName = str_replace(" ","_",$strRestaurantName);

    return 
        strtolower($strSourcePath."/".$strFormattedRestName."/".$strFormattedRestName."___".$strFormattedFoodName.".jpeg");
}


// return query
//
if(isset($_GET["strQuery"])){
    // connect to db  
    //
    $msConnect= new MySQLiConnection();

    $strFormattedQuery = '%'.$_GET['strQuery'].'%';

    // prepare sql statment
    //
    $stmt = $msConnect->mysqli()->prepare('
    select 
        *
    from
        menustat_query
    where
        description like
            ?
    limit
        5
    ');
    $stmt->bind_param("s",$strFormattedQuery);
    $stmt->execute();

    $result =$stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $strRestaurant = "";
    $strDescription = "";
    $strServingSize = "";
    $strServingSizeText = "";
    $strServingSizeUnit = "";
    $strImgPath = "";

    $strNullReplacement = "Not present in db";
    $intIndex = 0;

    foreach($data as $subArr){
        // perform checks for nulls here
        //
        $strRestaurant = strReplaceIfNull($subArr['restaurant'],$strNullReplacement);
        $strDescription= strReplaceIfNull($subArr['description'],$strNullReplacement);
        $strImgPath = strGetImgPath($strDescription,$strRestaurant,kIMG_DIR);

        $templateData = array(
            "index" =>$intIndex,
            "restaurant" => $strRestaurant,
            "description" => $strDescription,
            "img_path"=>$strImgPath,
        );
        $tempBody = load_template_to_string($templateData,"../templates/table_entry.html");
        echo($tempBody);
        $intIndex += 1;
    }

    $stmt->close();

}