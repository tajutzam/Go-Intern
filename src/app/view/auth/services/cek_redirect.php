<?php

use LearnPhpMvc\APP\View;


var_dump($role);
if (isset($role)) {
    echo "ha";
    View::redirect("");
} else if ($role == "1") {
    echo "h123a";
    View::redirect("/penyedia");
} else if ($role == "2") {
    echo "ha123";
    View::redirect("/pencari_magang");
}

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

debug_to_console($role);
