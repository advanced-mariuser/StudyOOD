<?php

require_once __DIR__ . '/InputDataStreamInterface.php';

class FileInputStream implements InputDataStreamInterface
{
    private $fileHandle;

    /**
     * Открывает файл для чтения в бинарном режиме.
     *
     * @param string $filename Имя файла
     * @throws RuntimeException Если файл не удалось открыть
     */
    public function __construct(string $filename)
    {
        $this->fileHandle = fopen($filename, 'rb');
        if (!$this->fileHandle) {
            throw new RuntimeException("Failed to open file for reading");
        }
    }

    /**
     * Закрывает файл при уничтожении объекта.
     */
    public function __destruct()
    {
        if ($this->fileHandle) {
            fclose($this->fileHandle);
        }
    }

    /**
     * Проверяет, достигнут ли конец файла.
     *
     * @return bool
     */
    public function isEOF(): bool
    {
        return feof($this->fileHandle);
    }

    /**
     * Читает один байт из файла.
     *
     * @return int
     * @throws RuntimeException Если не удалось прочитать байт
     */
    public function readByte(): int
    {
        if ($this->isEOF()) {
            throw new RuntimeException("Failed to read from file: EOF reached");
        }

        $byte = fread($this->fileHandle, 1);

        if ($byte === false || strlen($byte) !== 1) {
            throw new RuntimeException("Failed to read from file");
        }

        return ord($byte);
    }

    /**
     * Читает блок данных из файла.
     *
     * @param int $size Количество байтов для чтения
     * @return string Прочитанные данные
     * @throws RuntimeException Если не удалось прочитать данные
     */
    public function readBlock(int $size): string
    {
        $data = fread($this->fileHandle, $size);

        if ($data === false) {
            throw new RuntimeException("Failed to read from file");
        }

        return $data;
    }
}
