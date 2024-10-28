<?php

require_once __DIR__ . '/../InputDataStream/InputDataStreamInterface.php';

abstract class InputDataStreamDecorator implements InputDataStreamInterface
{
    protected InputDataStreamInterface $stream;

    /**
     * Конструктор для инициализации декорированного потока.
     *
     * @param InputDataStreamInterface $stream Входной поток данных для декорирования
     */
    public function __construct(InputDataStreamInterface $stream)
    {
        $this->stream = $stream;
    }

    /**
     * Проверяет, достигнут ли конец декорированного потока.
     *
     * @return bool
     */
    public function isEOF(): bool
    {
        return $this->stream->isEOF();
    }
}
