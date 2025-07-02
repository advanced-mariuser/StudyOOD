<?php

require_once __DIR__ . '/../OutputDataStream/OutputDataStreamInterface.php';

class CompressingOutputStream implements OutputDataStreamInterface
{
    private OutputDataStreamInterface $stream;
    private array $currentBlock = [
        'byte' => null,
        'size' => 0
    ];

    /**
     * Конструктор, принимающий поток вывода данных.
     *
     * @param OutputDataStreamInterface $stream Поток вывода данных
     */
    public function __construct(OutputDataStreamInterface $stream)
    {
        $this->stream = $stream;
    }

    /**
     * Деструктор для сброса оставшихся данных при удалении объекта.
     */
    public function __destruct()
    {
        $this->flush();
    }

    /**
     * Записывает один байт данных в сжатый поток.
     *
     * @param int $data Байт данных для записи
     */
    public function writeByte(int $data): void
    {
        if ($this->currentBlock['size'] === 0) {
            $this->currentBlock = [
                'byte' => $data,
                'size' => 1,
            ];
            return;
        }

        if ($this->currentBlock['byte'] === $data && $this->currentBlock['size'] < 255) {
            ++$this->currentBlock['size'];
            return;
        }

        $this->flush();
        $this->currentBlock = [
            'byte' => $data,
            'size' => 1,
        ];
    }

    /**
     * Записывает блок данных в сжатый поток.
     *
     * @param string $srcData Строка с данными для записи
     * @param int $size Размер блока данных в байтах
     */
    public function writeBlock(string $srcData, int $size): void
    {
        $bytes = unpack('C*', substr($srcData, 0, $size));

        foreach ($bytes as $byte) {
            $this->writeByte($byte);
        }
    }

    /**
     * Сбрасывает текущий блок данных в поток.
     */
    private function flush(): void
    {
        if ($this->currentBlock['size'] > 0) {
            $this->stream->writeByte($this->currentBlock['size']);
            $this->stream->writeByte($this->currentBlock['byte']);
        }
    }
}
