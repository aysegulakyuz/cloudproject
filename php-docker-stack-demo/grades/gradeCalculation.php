<?php
function calculationGrade($midterm, $final)
{
    $midtermRate = 0.4;
    $finalRate = 0.6;
    $gecmeNotu = 60;

    $totalGrade = $midterm * $midtermRate + $final * $finalRate;

    if ($totalGrade >= $gecmeNotu) {
        return "Passed";
    } else {
        return "Failed";
    }
}
?>
