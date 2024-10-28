<?php

require_once __DIR__ . '/InputDataStreamDecorator.php';
require_once __DIR__ . '/../InputDataStream/InputDataStreamInterface.php';

class DecryptingInputStream extends InputDataStreamDecorator
{
    private array $decryptionTable;

    /**
     * Конструктор для инициализации декодирующего потока.
     *
     * @param InputDataStreamInterface $stream Входной поток данных
     * @param int $key Ключ для генерации таблицы дешифровки
     */
    public function __construct(InputDataStreamInterface $stream, int $key)
    {
        parent::__construct($stream);
        $this->decryptionTable = EncryptionTableBuilder::buildDecryptionTable($key);
    }

    /**
     * Читает и декодирует один байт из потока.
     *
     * @return int Декодированный байт
     */
    public function readByte(): int
    {
        return $this->decryptByte($this->stream->readByte());
    }

    /**
     * Читает и декодирует блок данных из потока.
     *
     * @param int $size Количество байтов для чтения
     * @return string Прочитанный и декодированный блок данных
     */
    public function readBlock(int $size): string
    {
        $block = $this->stream->readBlock($size);
        $decodedBlock = '';

        for ($i = 0, $length = strlen($block); $i < $length; ++$i) {
            $decodedBlock .= chr($this->decryptByte(ord($block[$i])));
        }

        return $decodedBlock;
    }

    /**
     * Декодирует один байт с использованием таблицы дешифровки.
     *
     * @param int $byte Байт для декодирования
     * @return int Декодированный байт
     */
    private function decryptByte(int $byte): int
    {
        return $this->decryptionTable[$byte];
    }
}
