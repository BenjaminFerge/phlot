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

/**
* @author Booteille
*
* @param resource $image
* @param int $font
* @param int $x
* @param int $y
* @param string $string
* @param int $color
*/
function whitespaces_imagestring($image, $font, $x, $y, $string, $color)
{
    $font_height = imagefontheight($font);
    $font_width = imagefontwidth($font);
    $image_height = imagesy($image);
    $image_width = imagesx($image);
    $max_characters = (int) ($image_width - $x) / $font_width ;
    $next_offset_y = $y;

    for ($i = 0, $exploded_string = explode("\n", $string), $i_count = count($exploded_string); $i < $i_count; $i++) {
        $exploded_wrapped_string = explode("\n", wordwrap(str_replace("\t", "    ", $exploded_string[$i]), $max_characters, "\n"));
        $j_count = count($exploded_wrapped_string);
        for ($j = 0; $j < $j_count; $j++) {
            imagestring($image, $font, $x, $next_offset_y, $exploded_wrapped_string[$j], $color);
            $next_offset_y += $font_height;

            if ($next_offset_y >= $image_height - $y) {
                return;
            }
        }
    }
}

function wrap_imagettftext($image, $size, $angle, $x, $y, Color $color, $fontFile, $text, $lineLength, $lineHeight = 3)
{
    $lines = explode('|', wordwrap($text, $lineLength, '|'));
    $_color = imagecolor($image, $color);
    foreach ($lines as $line)
    {
        imagettftext($image, $size, $angle, $x, $y+$size, $_color, $fontFile, $line);
        $y += $size * $lineHeight;
    }
}

function gdstring_utf8($text)
{
    $text = mb_convert_encoding($text, "HTML-ENTITIES", "UTF-8");
    $text = preg_replace('~^(&([a-zA-Z0-9]);)~', htmlentities('${1}'), $text);
    return($text);
}
