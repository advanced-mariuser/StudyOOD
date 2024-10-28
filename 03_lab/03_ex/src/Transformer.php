<?php

require_once __DIR__ . '/InputDataStream/InputDataStreamInterface.php';
require_once __DIR__ . '/OutputDataStream/OutputDataStreamInterface.php';
require_once __DIR__ . '/EncryptionTableBuilder.php';
require_once __DIR__ . '/InputDataStreamDecorator/DecryptingInputStream.php';
require_once __DIR__ . '/InputDataStreamDecorator/DecryptingInputStream.php';

class Transformer
{
    private InputDataStreamInterface $input;
    private OutputDataStreamInterface $output;

    public function __construct(Args $args)
    {
        $this->input = new FileInputStream($args->inputFilename);
        $this->output = new FileOutputStream($args->outputFilename);

        $this->addDecorators($args);
    }

    public function transform(): void
    {
        while (!$this->input->isEOF()) {
            $this->output->writeByte($this->input->readByte());
        }
    }

    private function addDecorators(Args $args): void
    {
        foreach ($args->encryptionKeys as $key) {
            $this->output = $this->makeDecorator(EncryptingOutputStream::class, $key)($this->output);
        }

        foreach ($args->decryptionKeys as $key) {
            $this->input = $this->makeDecorator(DecryptingInputStream::class, $key)($this->input);
        }

        if ($args->compress) {
            $this->output = $this->makeDecorator(CompressingOutputStream::class)($this->output);
        }

        if ($args->decompress) {
            $this->input = $this->makeDecorator(DecompressingInputStream::class)($this->input);
        }
    }

    private function makeDecorator(string $decoratorClass, ...$args): callable
    {
        return function ($component) use ($decoratorClass, $args) {
            return new $decoratorClass($component, ...$args);
        };
    }
}
