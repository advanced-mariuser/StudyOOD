<?php

require_once __DIR__ . '/OutputDataStreamInterface.php';

class FileOutputStream implements OutputDataStreamInterface
{
    private $fileHandle;

    /**
     * Конструктор, открывающий файл для записи.
     *
     * @param string $filename Имя файла для записи
     * @throws RuntimeException Если файл не удалось открыть для записи
     */
    public function __construct(string $filename)
    {
        $this->fileHandle = fopen($filename, 'wb');
        if ($this->fileHandle === false) {
            throw new RuntimeException("failed to open file for writing");
        }
    }

    /**
     * Записывает один байт данных в файл.
     *
     * @param int $data Байт данных для записи
     * @throws RuntimeException Если запись в файл не удалась
     */
    public function writeByte(int $data): void
    {
        $this->writeBlock(pack('C', $data), 1);
    }

    /**
     * Записывает блок данных в файл.
     *
     * @param string $srcData Блок данных для записи
     * @param int $size Размер блока данных в байтах
     * @throws RuntimeException Если запись в файл не удалась
     */
    public function writeBlock(string $srcData, int $size): void
    {
        $writtenBytes = fwrite($this->fileHandle, $srcData, $size);
        if ($writtenBytes === false || $writtenBytes < $size) {
            throw new RuntimeException("failed to write to file");
        }
        fflush($this->fileHandle);
    }

    /**
     * Деструктор для закрытия файла.
     */
    public function __destruct()
    {
        if ($this->fileHandle) {
            fclose($this->fileHandle);
        }
    }
}
