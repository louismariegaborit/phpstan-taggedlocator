<?php

namespace App\Exporter;

class JsonExporter implements ExporterInterface
{
    public static function getFormat(): string
    {
        return 'json';
    }

    public function export(): string
    {
        return 'jsonexport';
    }
}