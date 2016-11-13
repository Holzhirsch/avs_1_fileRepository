<?php

include "Utils.php";
include "FileHandler.php";
include "Register.php";
include "Unregister.php";
include "Query.php";
include "DirectoryService.php";

/**
 * @author era
 * 
 * Description of API:
 * Instantiate an object of DirectoryService and start it.
 * 
 */
$service = new DirectoryService();
if(!empty($_POST)) {
    $service->start();
}


