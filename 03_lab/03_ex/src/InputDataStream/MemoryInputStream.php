<?php

require_once __DIR__ . '/InputDataStreamInterface.php';

class MemoryInputStream implements InputDataStreamInterface
{
    private array $data;
    private int $currentPosition = 0;

    /**
     * Инициализирует поток данных из массива байтов.
     *
     * @param array $data Массив байтов для чтения
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Проверяет, достигнут ли конец данных.
     *
     * @return bool
     */
    public function isEOF(): bool
    {
        return $this->currentPosition >= count($this->data);
    }

    /**
     * Читает один байт из массива данных.
     *
     * @return int Прочитанный байт
     * @throws RuntimeException Если достигнут конец данных
     */
    public function readByte(): int
    {
        if ($this->isEOF()) {
            throw new RuntimeException("Cannot read past EOF");
        }

        return $this->data[$this->currentPosition++];
    }

    /**
     * Читает блок данных заданного размера из массива.
     *
     * @param int $size Количество байтов для чтения
     * @return string Прочитанные данные в виде строки
     */
    public function readBlock(int $size): string
    {
        $readSize = min($size, count($this->data) - $this->currentPosition);
        $block = '';

        for ($i = 0; $i < $readSize; ++$i) {
            $block .= chr($this->readByte());
        }

        return $block;
    }
}
