<?php

function validate($data) {
    $data = addslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>