<?php

declare(strict_types=1);

namespace Convertor;

use Entity\Job;

class JsonFileConvertor implements ConvertorInterface
{
    public function __construct(private readonly string $filePath) {}

    public function convert(): array
    {
        $json = json_decode(file_get_contents($this->filePath), true);

        if ($json === false) {
            throw new \RuntimeException("Impossible de charger le fichier JSON: " . $this->filePath);
        }

        $jobs = [];
        foreach ($json['offers'] as $item) {
            $job = new Job(
                (string)$item["reference"],
                (string)$item["title"],
                (string)$item["description"],
                (string)$item["urlPath"],
                (string)$item["companyname"],
                new \DateTimeImmutable($item["publishedDate"])
            );
            $jobs[] = $job->toArray();
        }
        return $jobs;
    }
}
