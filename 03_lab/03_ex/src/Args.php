<?php
declare(strict_types=1);

class Args
{
    public string $inputFilename = '';
    public string $outputFilename = '';
    public array $encryptionKeys = [];
    public array $decryptionKeys = [];
    public bool $compress = false;
    public bool $decompress = false;
}
