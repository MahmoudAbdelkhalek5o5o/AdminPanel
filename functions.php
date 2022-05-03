<?php
function randString($length){
    $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIGKLMNOPQRSTUVWXYZ";
    $path = "";
    for($i=0;$i<$length;$i++){
      $path.=$chars[rand(0,strlen($chars)-1)];
    }
    return $path;
}
?>