<?php

declare(strict_types=1);

namespace Controller;

use Convertor\FileConvertorBuilder;
use Hydrator\JobHydrator;
use Service\JobLister;
use Repository\JobRepository;
use Service\JobImporter;

class JobController
{

    private JobRepository $jobRepository;
    private JobImporter $jobImporter;
    private JobLister $jobLister;
    private JobHydrator $jobHydrator;
    private FileConvertorBuilder $fileConvertor;

    public function __construct(
        JobRepository $jobRepository,
        JobImporter $jobImporter,
        JobLister $jobLister,
        JobHydrator $jobHydrator,
        FileConvertorBuilder $fileConvertor,
        private readonly string $resourcesDirectory,
    ) {
        $this->jobRepository = $jobRepository;
        $this->jobImporter = $jobImporter;
        $this->jobLister = $jobLister;
        $this->jobHydrator = $jobHydrator;
        $this->fileConvertor = $fileConvertor;
    }


    public function importJobs(): int
    {
        try {
            $filesToConvert = $this->fileConvertor->buildFile($this->resourcesDirectory);

            return $this->jobImporter->import(
                $this->jobRepository,
                $filesToConvert
            );
        } catch (\Exception $e) {
            die('Import Job error: ' . $e->getMessage() . "\n");
        }
    }



    public function listJobs(): array
    {
        try {
            return $this->jobLister->listJobs($this->jobRepository, $this->jobHydrator);
        } catch (\Exception $e) {
            die('Jobs retrieval error: ' . $e->getMessage() . "\n");
        }
    }
}
