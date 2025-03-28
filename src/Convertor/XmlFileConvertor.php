<?php

declare(strict_types=1);

namespace Convertor;

use DateTimeImmutable;
use Entity\Job;

class XmlFileConvertor implements ConvertorInterface
{
    public function __construct(private readonly string $filePath) {}

    public function convert(): array
    {
        $xml = simplexml_load_file($this->filePath);
        if ($xml === false) {
            throw new \RuntimeException("Impossible de charger le fichier XML: " . $this->filePath);
        }
        $jobs = [];
        foreach ($xml->item as $item) {
            $job = new Job(
                (string)$item->ref,
                (string)$item->title,
                (string)$item->description,
                (string)$item->url,
                (string)$item->company,
                new DateTimeImmutable((string)$item->pubDate)
            );
            $jobs[] = $job->toArray();
        }

        return $jobs;
    }
}
