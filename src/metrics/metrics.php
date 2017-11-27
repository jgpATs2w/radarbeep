<?php
namespace metrics;

function increase($name){

  $q= "INSERT INTO metrics (name, value) VALUES (?, 1)
        ON DUPLICATE KEY UPDATE value = value + 1";

  \db\prepare($q);
  \db\execute(array($name));
}

function set($name, $value){
  $q= "INSERT INTO metrics (name, value) VALUES (?, ?) ON DUPLICATE KEY UPDATE value = ?";

  \db\prepare($q);
  \db\execute(array($name, $value, $value));
}

function get($name){
  $q= "select * from metrics where name='$name'";

  return \db\query_single($q);
}

?>
