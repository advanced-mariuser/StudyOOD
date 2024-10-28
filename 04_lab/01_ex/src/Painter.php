<?php
declare(strict_types=1);

class Painter
{
    public function drawPicture(PictureDraft $draft, CanvasInterface $canvas): void
    {
        foreach ($draft->getShapes() as $shape)
        {
            $shape->draw($canvas);
        }
    }
}