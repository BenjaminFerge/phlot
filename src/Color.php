<?php

namespace XChart;

class Color
{
    private $r;
    private $g;
    private $b;
    private $a;

    public function __construct(int $r, int $g, int $b, int $a = 0)
    {
        assert($r >= 0 && $a <= 255);
        assert($g >= 0 && $g <= 255);
        assert($b >= 0 && $b <= 255);
        assert($a >= 0 && $a <= 127);
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
        $this->a = $a;
    }

    public static function fromArray(array $rgba)
    {
        return new self($rgba[0], $rgba[1], $rgba[2], $rgba[3] ?? 0);
    }

    public static function fromHex($hex)
    {
        $rgba = hexToRgba($hex);
        return self::fromArray($rgba);
    }
}
