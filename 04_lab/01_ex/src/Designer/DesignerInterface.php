<?php
declare(strict_types=1);

//инетрфейс должен использоваться
interface DesignerInterface
{
    public function createDraft(string $input): PictureDraft;
}