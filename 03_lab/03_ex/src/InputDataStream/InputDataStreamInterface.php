<?php

interface InputDataStreamInterface
{
    /**
     * Проверяет, достигнут ли конец потока.
     *
     * @return bool
     */
    public function isEOF(): bool;

    /**
     * Читает один байт из потока.
     *
     * @return int
     */
    public function readByte(): int;

    /**
     * Читает блок данных заданного размера из потока.
     *
     * @param int $size Количество байтов для чтения
     * @return string Прочитанные данные в виде строки
     */
    public function readBlock(int $size): string;
}
