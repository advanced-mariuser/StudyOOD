<?php

require_once __DIR__ . '/InputDataStreamDecorator.php';
require_once __DIR__ . '/../InputDataStream/InputDataStream.php';

class DecompressingInputStream extends InputDataStreamDecorator
{
    private int $currentBlockSize = 0;
    private int $currentBlockByte = 0;

    /**
     * Конструктор, инициализирующий декорированный поток.
     *
     * @param InputDataStream $stream Входной поток данных
     */
    public function __construct(InputDataStream $stream)
    {
        parent::__construct($stream);
    }

    /**
     * Читает один байт из потока, с декомпрессией, если это необходимо.
     *
     * @return int Прочитанный байт
     * @throws RuntimeException Если невозможно прочитать байт
     */
    public function readByte(): int
    {
        if ($this->currentBlockSize === 0) {
            $this->currentBlockSize = $this->stream->readByte();
            $this->currentBlockByte = $this->stream->readByte();
        }

        --$this->currentBlockSize;
        return $this->currentBlockByte;
    }

    /**
     * Читает блок данных из потока и декомпрессирует его в указанный буфер.
     *
     * @param int $size Количество байтов для чтения
     * @return string Прочитанный блок данных
     */
    public function readBlock(int $size): string
    {
        $block = '';

        for ($i = 0; $i < $size && !$this->isEOF(); ++$i) {
            $block .= chr($this->readByte());
        }

        return $block;
    }
}
