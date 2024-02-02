<?php
function rupiah($nominal)
{
    // if ($prefix) {
    //     return "Rp." . $prefix . "" . number_format($nominal, 0, ',', '.');
    // }
    return "Rp." . number_format($nominal, 0, ',', '.');
}
