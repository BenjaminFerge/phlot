<?php

namespace Phlot;

class Legend implements Drawable
{
    private $nodes;
    private $font;
    private $display;

    public function __construct($nodes = [], Font $font = null)
    {
        $this->nodes = $nodes;
        $this->font = $font;
    }
    
    public function draw($img): void
    {
        if (!$this->display) {
            return;
        }
    }

    public function show()
    {
        $this->display = true;
    }

    public function hide()
    {
        $this->display = false;
    }
}
