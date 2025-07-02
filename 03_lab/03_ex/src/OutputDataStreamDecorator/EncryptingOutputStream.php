<?php

require_once __DIR__ . '/../OutputDataStream/OutputDataStreamInterface.php';
require_once __DIR__ . '/../EncryptionTableBuilder.php';

class EncryptingOutputStream implements OutputDataStreamInterface
{
    private OutputDataStreamInterface $stream;
    private array $encryptionTable;

    public function __construct(OutputDataStreamInterface $stream, int $key)
    {
        $this->stream = $stream;
        $this->encryptionTable = EncryptionTableBuilder::buildEncryptionTable($key);
    }

    public function writeByte(int $data): void
    {
        $this->stream->writeByte($this->encryptByte($data));
    }

    public function writeBlock($srcData, int $size): void
    {
        $bytes = array_values(unpack('C*', $srcData));

        for ($i = 0; $i < $size; $i++) {
            $this->writeByte($bytes[$i]);
        }
    }

    private function encryptByte(int $byte): int
    {
        return $this->encryptionTable[$byte];
    }
}
