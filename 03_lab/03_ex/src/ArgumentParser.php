<?php
declare(strict_types=1);

require __DIR__ . '/Args.php';

class ArgumentParser
{
    private array $args;

    private const ENCRYPT_PARAMETER = '--encrypt';
    private const DECRYPT_PARAMETER = '--decrypt';
    private const COMPRESS_PARAMETER = '--compress';
    private const DECOMPRESS_PARAMETER = '--decompress';

    public function __construct(int $argc, array $argv)
    {
        // Удаляем первый элемент (название скрипта) из аргументов
        $this->args = array_slice($argv, 1, $argc);
    }

    public function parse(): Args
    {
        $args = new Args();

        for ($i = 0; $i < count($this->args); ++$i)
        {
            $arg = $this->args[$i];

            switch ($arg)
            {
                case self::ENCRYPT_PARAMETER:
                    if (isset($this->args[$i + 1]))
                    {
                        $args->encryptionKeys[] = $this->stringToInt($this->args[++$i]);
                    }
                    break;

                case self::DECRYPT_PARAMETER:
                    if (isset($this->args[$i + 1]))
                    {
                        array_unshift($args->decryptionKeys, $this->stringToInt($this->args[++$i]));
                    }
                    break;

                case self::COMPRESS_PARAMETER:
                    $args->compress = true;
                    break;

                case self::DECOMPRESS_PARAMETER:
                    $args->decompress = true;
                    break;

                default:
                    if (empty($args->inputFilename))
                    {
                        $args->inputFilename = $arg;
                    }
                    elseif (empty($args->outputFilename))
                    {
                        $args->outputFilename = $arg;
                    }
                    else
                    {
                        throw new InvalidArgumentException("Unsupported option: $arg");
                    }
                    break;
            }
        }

        if (empty($args->outputFilename))
        {
            throw new InvalidArgumentException("Output file not specified");
        }

        if (empty($args->inputFilename))
        {
            throw new InvalidArgumentException("Input file not specified");
        }

        return $args;
    }

    private function stringToInt(string $str): int
    {
        if (!is_numeric($str))
        {
            throw new InvalidArgumentException("Invalid number value: $str");
        }

        $value = (int)$str;

        if ($value > PHP_INT_MAX || $value < PHP_INT_MIN)
        {
            throw new OutOfRangeException("Number out of range: $str");
        }

        return $value;
    }
}
