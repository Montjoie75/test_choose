<?php

declare(strict_types=1);

namespace Hydrator;

use Entity\Job;

class JobHydrator
{

    public function hydrate($data): array
    {
        $jobs = [];
        foreach ($data as $item) {
            $job = new Job(
                $item['reference'],
                $item['title'],
                $item['description'],
                $item['url'],
                $item['company_name'],
                new \DateTimeImmutable($item['publication'])
            );
            $job->setId($item['id']);
            $jobs[] = $job->toArray();
        }
        return $jobs;
    }
}
