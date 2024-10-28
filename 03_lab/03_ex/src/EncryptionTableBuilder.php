<?php
declare(strict_types=1);

class EncryptionTableBuilder
{
    // Таблица шифрования/дешифрования — это массив из 256 элементов
    public const TABLE_SIZE = 256;

    /**
     * Строит таблицу шифрования на основе ключа.
     *
     * @param int $key Ключ для шифрования
     * @return array Таблица шифрования
     */
    public static function buildEncryptionTable(int $key): array
    {
        $encryptionTable = range(0, self::TABLE_SIZE - 1); // Массив с числами от 0 до 255

        // Используем mt_srand для инициализации генератора случайных чисел
        mt_srand($key);

        // Перемешиваем таблицу
        shuffle($encryptionTable);

        return $encryptionTable;
    }

    /**
     * Строит таблицу дешифрования на основе ключа.
     *
     * @param int $key Ключ для шифрования
     * @return array Таблица дешифрования
     */
    public static function buildDecryptionTable(int $key): array
    {
        $encryptionTable = self::buildEncryptionTable($key);

        $decryptionTable = array_fill(0, self::TABLE_SIZE, 0); // Инициализируем таблицу нулями

        // Строим таблицу дешифрования на основе таблицы шифрования
        for ($i = 0; $i < self::TABLE_SIZE; ++$i) {
            $decryptionTable[$encryptionTable[$i]] = $i;
        }

        return $decryptionTable;
    }
}