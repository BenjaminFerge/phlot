<?php

namespace Phlot\Math;

class Vector2
{
    public $x;
    public $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public static function fromVector2(Vector2 $vec)
    {
        return new self($vec->x, $vec->y);
    }

    public function mul(Vector2 $vec)
    {
        $this->x *= $vec->x;
        $this->y *= $vec->y;
    }

    public function mulScalar(int $n)
    {
        $this->x *= $n;
        $this->y *= $n;
    }

    public function div(Vector2 $vec)
    {
        $this->x /= $vec->x;
        $this->y /= $vec->y;
    }

    public function divScalar(int $n)
    {
        $this->x /= $n;
        $this->y /= $n;
    }

    public function add(Vector2 $vec)
    {
        $this->x += $vec->x;
        $this->y += $vec->y;
    }

    public function addScalar(int $n)
    {
        $this->x += $n;
        $this->y += $n;
    }

    public function sub(Vector2 $vec)
    {
        $this->x -= $vec->x;
        $this->y -= $vec->y;
    }

    public function normalize()
    {
        $this->x = 1 / $this->x;
        $this->y = 1 / $this->y;
    }
}
