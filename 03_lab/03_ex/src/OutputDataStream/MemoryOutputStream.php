<?php

require_once __DIR__ . '/OutputDataStreamInterface.php';

class MemoryOutputStream implements OutputDataStreamInterface
{
    private array $data;

    /**
     * Конструктор, инициализирующий ссылку на массив для хранения данных.
     *
     * @param array $data Ссылка на массив для хранения данных
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Записывает один байт данных в массив.
     *
     * @param int $data Байт данных для записи
     */
    public function writeByte(int $data): void
    {
        $this->data[] = $data;
    }

    /**
     * Записывает блок данных в массив.
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
}
