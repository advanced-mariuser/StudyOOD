<?php
declare(strict_types=1);

require_once __DIR__ . '/DesignerInterface.php';
require_once __DIR__ . '/../ShapeFactory/ShapeFactoryInterface.php';
require_once __DIR__ . '/../PictureDraft.php';

class Designer implements DesignerInterface
{
    private ShapeFactoryInterface $factory;

    public function __construct(ShapeFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createDraft(string $input): PictureDraft
    {
        $lines = explode("\n", trim($input));
        $draft = new PictureDraft();

        foreach ($lines as $line) {
            if (!empty($line)) {
                $shape = $this->factory->createShape($line);
                $draft->addShape($shape);
            }
        }

        return $draft;
    }
}