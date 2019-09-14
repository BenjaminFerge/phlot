<?php

namespace Phlot;

use Phlot\Math\Vector2;

interface Drawable
{
    public function draw($img, Vector2 $startv, Vector2 $maxSize): void;
}
