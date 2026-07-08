<?php

function formatarData($data){
    return date('d/m/Y', $data);
}

function converterDataMysql($data){
    return date('Y-m-d', $data);
}
?>