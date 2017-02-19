<?php
  global $root;

  $root=$_SERVER['DOCUMENT_ROOT'];
  //$root.="/jamesMcHugh";
  if(strpos($root, "jamesMcHugh")<16){
    $root=$root."jamesMcHugh";
  }
  
  require_once($root."/php/components/database/dbConn.php");
  require_once($root."/php/components/database/secureDatabase.php");
  require_once($root."/php/functions/functions.php");

  $data=array();
  $data['projectName'] = prepareString($_POST['projectName']);

  $data['website'] = prepareString($_POST['website']);

  if (isset($_POST['websiteAction']) && isset($_POST['numberOfPages']) && isset($_POST['websiteDetails'])){
      $data['websiteAction'] = prepareString($_POST['websiteAction']);
      $data['numberOfPages'] = $_POST['numberOfPages'];
      $data['websiteDetails'] = $_POST['websiteDetails'];
  }

  $data['database'] = prepareString($_POST['database']);

  if (isset($_POST['databaseAction']) && isset($_POST['numberOfTables']) && isset($_POST['databaseDetails'])){
    $data['databaseAction'] = prepareString($_POST['databaseAction']);
    $data['relational'] = prepareString($_POST['relational']);
    $data['dbDesign'] = prepareString($_POST['dbDesign']);
    $data['numberOfTables'] = prepareString($_POST['numberOfTables']);
    $data['databaseDetails'] = prepareString($_POST['databaseDetails']);
  }

  $data['logo']=prepareString($_POST['logo']);

  if (isset($_POST['logoAction']) && isset($_POST['logoDetails'])){
      $data['logoAction'] = prepareString($_POST['logoAction']);
      $data['logoDetails'] = prepareString($_POST['logoDetails']);
  }

  $data['graphics'] = prepareString($_POST['graphics']);

  if (isset($_POST['graphicsAction']) && isset($_POST['graphicsDetails'])){
    $data['graphicsAction'] = prepareString($_POST['graphicsAction']);
    $data['graphicsDetails'] = prepareString($_POST['graphicsDetails']);
  }

  $data['other'] = prepareString($_POST['other']);

  if (isset($_POST['otherDetails'])){
    $data['otherDetails'] = prepareString($_POST['otherDetails']);
  }

  $data['projectDetails']=prepareString($_POST['projectDetails']);

  //cehck functions.php for details
  if(validateNewProjectData($data)){
    $response=registerNewProjectFull($data);
    if($response==true){
      echo "success";
    }else{
      echo $response;
    }
  }else{
    echo "data not valid";
  }

  require_once($root."/php/components/php/database/closedbConn.php");
?>
