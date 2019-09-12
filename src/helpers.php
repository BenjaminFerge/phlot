<?php

use Phrism\Color;

function hexToRgba($hex)
{
    $hex      = str_replace('#', '', $hex);
    $length   = strlen($hex);
    $rgba['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
    $rgba['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
    $rgba['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
    $rgba['a'] = hexdec($length == 8 ? substr($hex, 6, 2) : 0);
    return $rgba;
}

function imagecolor($img, Color $color)
{
    if ($color->getAlpha()) {
        return imagecolorallocatealpha($img, $color->getRed(), $color->getGreen(), $color->getBlue(), $color->getAlpha());
    }
    return imagecolorallocate($img, $color->getRed(), $color->getGreen(), $color->getBlue());
}
