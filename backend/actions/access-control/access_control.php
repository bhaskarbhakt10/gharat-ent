<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/gharat-ent/hospital-management/backend/php-classes/access-control/access.php";

if(isset($_POST)){
   $all_form_data = $_POST['form_data'];
   $id_to_update = $_POST['id_to_update'];

   $special_access = array();
   foreach($all_form_data as $data){
        foreach($data as $key=>$value){
            $special_access[$key] = $value;
        }
   }
   $spa = json_encode($special_access);

   $specialAccess = new Access();
   $specialAccess->getUpdateDetails($id_to_update, $spa);
}