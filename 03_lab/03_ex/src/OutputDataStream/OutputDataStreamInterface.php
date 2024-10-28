<?php

interface OutputDataStreamInterface
{
    /**
     * Записывает один байт данных в поток.
     *
     * @param int $data Байт данных для записи
     */
    public function writeByte(int $data): void;

    /**
     * Записывает блок данных в поток.
     *
     * @param string $srcData Строка с данными для записи
     * @param int $size Размер блока данных в байтах
     */
    public function writeBlock(string $srcData, int $size): void;
}
