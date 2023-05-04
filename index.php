<?php
$root_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .'/gharat-ent/hospital-management/log-in/log-in';
header('Location: '.$root_url);