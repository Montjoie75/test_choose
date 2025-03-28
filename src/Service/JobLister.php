<?php

declare(strict_types=1);

namespace Service;

use Hydrator\JobHydrator;
use Repository\JobRepository;

class JobLister
{

    public function listJobs(
        JobRepository $jobRepository,
        JobHydrator $jobHydrator
    ): array {
        $data = $jobRepository->findAll();
        $result = $jobHydrator->hydrate($data);
        return $result;
    }
}
