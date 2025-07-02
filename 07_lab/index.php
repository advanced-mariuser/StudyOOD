<?php

require_once __DIR__ . '/src/Canvas/SVGCanvas.php';
require_once __DIR__ . '/src/Slide.php';
require_once __DIR__ . '/src/Shape/Rectangle.php';
require_once __DIR__ . '/src/Shape/Ellipse.php';
require_once __DIR__ . '/src/Shape/Triangle.php';
require_once __DIR__ . '/src/Shape/GroupShape.php';
require_once __DIR__ . '/src/RGBAColor.php';
require_once __DIR__ . '/src/Rect.php';

$slide = new Slide();

$fillStyleWall = new Style();
$fillStyleWall->setColor(new RGBAColor(200, 150, 100, 255)); // Стены
$fillStyleRoof = new Style();
$fillStyleRoof->setColor(new RGBAColor(150, 50, 50, 255)); // Крыша
$fillStyleDoor = new Style();
$fillStyleDoor->setColor(new RGBAColor(100, 50, 0, 255)); // Дверь
$fillStyleWindow = new Style();
$fillStyleWindow->setColor(new RGBAColor(50, 150, 200, 255)); // Окно

// Домик из отдельных фигур
$wall = new Rectangle(new Rect(50, 150, 200, 150));
$wall->setFillStyle($fillStyleWall);
$roof = new Triangle(new Rect(50, 50, 200, 100));
$roof->setFillStyle($fillStyleRoof);
$door = new Rectangle(new Rect(110, 230, 40, 70));
$door->setFillStyle($fillStyleDoor);
$window = new Rectangle(new Rect(180, 180, 40, 40));
$window->setFillStyle($fillStyleWindow);

$slide->addShape($wall);
$slide->addShape($roof);
$slide->addShape($door);
$slide->addShape($window);

// Создаем GroupShape для второго домика
$groupShape = new GroupShape();
$groupWall = new Rectangle(new Rect(300, 150, 200, 150));
$groupWall->setFillStyle($fillStyleWall);
$groupShape->addShape($groupWall);

$groupRoof = new Triangle(new Rect(300, 50, 200, 100));
$groupRoof->setFillStyle($fillStyleRoof);
$groupShape->addShape($groupRoof);

$groupDoor = new Rectangle(new Rect(360, 230, 40, 70));
$groupDoor->setFillStyle($fillStyleDoor);
$groupShape->addShape($groupDoor);

$groupWindow = new Rectangle(new Rect(430, 180, 40, 40));
$groupWindow->setFillStyle($fillStyleWindow);
$groupShape->addShape($groupWindow);

$groupStyle = new Style();
$groupStyle->setColor(new RGBAColor(0, 0, 0, 255));
$groupStyle->setThickness(2);
$groupShape->setStrokeStyle($groupStyle);

$groupShape->setFrame(new Rect(300, 50, 200 * 10, 250 * 10));
$slide->addShape($groupShape);

$canvas = new SvgCanvas('output.svg');
$slide->draw($canvas);
