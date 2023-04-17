<?php

if(isset($_POST)){
   $all_form_data = $_POST['form_data'];
   
   $special_access = array();
   foreach($all_form_data as $data){
        foreach($data as $key=>$value){
            $special_access[$key] = $value;
        }
   }
   print_r($special_access);
}