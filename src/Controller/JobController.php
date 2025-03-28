<?php

declare(strict_types=1);

namespace Controller;

use Convertor\FileConvertorBuilder;
use Repository\JobRepository;
use Service\JobImporter;
use Utils\DbConnect;

class JobController
{

    private JobRepository $jobRepository;
    private JobImporter $jobImporter;
    private DbConnect $dbConnect;
    private FileConvertorBuilder $fileConvertor;

    public function __construct(
        JobRepository $jobRepository,
        JobImporter $jobImporter,
        DbConnect $dbConnect,
        FileConvertorBuilder $fileConvertor,
        private readonly string $resourcesDirectory,
    ) {
        $this->jobRepository = $jobRepository;
        $this->jobImporter = $jobImporter;
        $this->fileConvertor = $fileConvertor;
        $this->dbConnect = $dbConnect;
    }


    public function importJobs()
    {
        try {
            $filesToConvert = $this->fileConvertor->buildFile($this->resourcesDirectory);

            $this->jobImporter->import(
                $this->jobRepository,
                $filesToConvert
            );
        } catch (\Exception $e) {
            die('Import Job error: ' . $e->getMessage() . "\n");
        }
    }
}
