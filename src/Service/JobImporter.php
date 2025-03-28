<?php

declare(strict_types=1);

namespace Service;

use Repository\JobRepository;

class JobImporter
{
    public function import(
        JobRepository $jobRepository,
        array $filesToConvert
    ) {

        $jobs = [];
        foreach ($filesToConvert as $file) {
            $jobs[] = $file->convert();
        }

        $data = array_merge(...array_values($jobs));

        $jobRepository->saveJobs($data);
        die();
    }
}
