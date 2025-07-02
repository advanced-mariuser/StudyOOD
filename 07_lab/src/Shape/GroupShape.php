<?php
declare(strict_types=1);

require_once __DIR__ . '/Shape.php';
require_once __DIR__ . '/../Canvas/CanvasInterface.php';

class GroupShape extends Shape
{
    /** @var Shape[] */
    private array $shapes = [];

    public function draw(CanvasInterface $canvas): void
    {
        foreach ($this->shapes as $shape)
        {
            $shape->draw($canvas);
        }
    }

    public function getComposite(): ?GroupShape
    {
        return $this;
    }

    public function getStrokeStyle(): Style
    {
        if (empty($this->shapes))
        {
            return parent::getStrokeStyle();
        }

        $firstStyle = $this->shapes[0]->getStrokeStyle();
        foreach ($this->shapes as $shape)
        {
            if ($shape->getStrokeStyle() !== $firstStyle)
            {
                return parent::getStrokeStyle(); // Разные стили у вложенных элементов
            }
        }
        return $firstStyle; // Все стили одинаковы
    }

    public function setStrokeStyle(Style $newStyle): void
    {
        foreach ($this->shapes as $shape)
        {
            $shape->setStrokeStyle($newStyle); // Применить стиль ко всем элементам
        }
    }

    public function getFillStyle(): Style
    {
        if (empty($this->shapes))
        {
            return parent::getFillStyle(); // Нет элементов
        }

        $firstStyle = $this->shapes[0]->getFillStyle();
        foreach ($this->shapes as $shape)
        {
            if ($shape->getFillStyle() !== $firstStyle)
            {
                return parent::getFillStyle(); // Разные стили у вложенных элементов
            }
        }
        return $firstStyle; // Все стили одинаковы
    }

    public function setFillStyle(Style $newStyle): void
    {
        foreach ($this->shapes as $shape)
        {
            $shape->setFillStyle($newStyle); // Применить стиль ко всем элементам
        }
    }

    public function getShapeCount(): int
    {
        return count($this->shapes);
    }

    public function getShapeAtIndex(int $index): Shape
    {
        return $this->shapes[$index];
    }

    public function addShape(Shape $shape): void
    {
        $this->shapes[] = $shape;
    }

    public function removeShapeAtIndex(int $index): void
    {
        if (!isset($this->shapes[$index]))
        {
            throw new OutOfBoundsException("Shape at index $index does not exist.");
        }

        unset($this->shapes[$index]);
        $this->shapes = array_values($this->shapes);
    }

    public function getFrame(): ?Rect
    {
        if (empty($this->shapes))
        {
            return null; // Группа пуста
        }

        $left = PHP_FLOAT_MAX;
        $top = PHP_FLOAT_MAX;
        $right = PHP_FLOAT_MIN;
        $bottom = PHP_FLOAT_MIN;

        foreach ($this->shapes as $shape)
        {
            $frame = $shape->getFrame();
            if ($frame === null)
            {
                continue; // Пропустить элементы без фрейма
            }

            $left = min($left, $frame->left);
            $top = min($top, $frame->top);
            $right = max($right, $frame->left + $frame->width);
            $bottom = max($bottom, $frame->top + $frame->height);
        }

        return new Rect(
            $left,
            $top,
            $right - $left,
            $bottom - $top
        );
    }

    public function setFrame(Rect $newFrame): void
    {
        $currentFrame = $this->getFrame();
        if ($currentFrame === null)
        {
            throw new LogicException("Cannot set frame for an empty group.");
        }

        $scaleX = $newFrame->width / $currentFrame->width;
        $scaleY = $newFrame->height / $currentFrame->height;

        foreach ($this->shapes as $shape)
        {
            $frame = $shape->getFrame();
            if ($frame === null)
            {
                continue;
            }

            $newLeft = $newFrame->left + ($frame->left - $currentFrame->left) * $scaleX;
            $newTop = $newFrame->top + ($frame->top - $currentFrame->top) * $scaleY;
            $newWidth = $frame->width * $scaleX;
            $newHeight = $frame->height * $scaleY;

            $shape->setFrame(new Rect($newLeft, $newTop, $newWidth, $newHeight));
        }
    }
}
