<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$time = "";
function getTime($time) {
    $timeEng = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    $timeVie = ['Một', 'Hai', 'Ba', 'Tư', 'Năm', 'Sáu', 'Bảy', 'Tám', 'Chín', 'Mười', 'Mười Một', 'Mười Hai'];
    $time = date('d \t\h\á\n\g M \n\ă\m Y', $time);

    $time = str_replace( $timeEng, $timeVie, $time);
    echo $time;
}
?>