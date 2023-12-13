<?php

namespace App\Exporter;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag()]
interface ExporterInterface
{
    public static function getFormat(): string;

    public function export(): string;
}