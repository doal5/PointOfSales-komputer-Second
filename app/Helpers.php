<?php

function rupiah($nominal)
{
    return "Rp." . number_format($nominal, 0, ',', '.');
}

function kode_prodnol($value, $threshold = null)
{
    return sprintf("%0" . $threshold . "s", $value);
}
