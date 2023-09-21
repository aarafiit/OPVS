<?php

for ($i = 1; $i <= 8; $i++) {
    $var1 = "etext";
    $var2 = "edate";

    $num = $i;
    $num2 = $i+1;

    $result = $var1 . $num;
    $result2 = $var1 . $num2;
    $result3 = $var2 . $num;
    $result4 = $var2 . $num2;

    // $institute = $_POST[$result];
    // $roll = $_POST[$result2];
    // $fromDate = $_POST[$result3];
    // $toDate = $_POST[$result4];

    echo "$result<br>";
    echo "$result2<br>";
    echo "$result3<br>";
    echo "$result4<br>";

    $i++;

}



?>





