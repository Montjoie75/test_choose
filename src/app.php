<?php

/************************************
Entry point of the project.
To be run from the command line.
 ************************************/

use Controller\JobController;
use Convertor\FileConvertorBuilder;
use Hydrator\JobHydrator;
use Repository\JobRepository;
use Service\JobImporter;
use Service\JobLister;
use Utils\DbConnect;

include_once(__DIR__ . '/utils.php');
include_once(__DIR__ . '/config.php');


printMessage("Starting...");

$jobImporter = new JobImporter();
$dbConnect = new DbConnect(SQL_HOST, SQL_USER, SQL_PWD, SQL_DB);
$fileConvertor = new FileConvertorBuilder();
$jobLister = new JobLister();
$jobHydrator = new JobHydrator;
$jobRepository = new JobRepository($dbConnect->getConnection());


$jobController = new JobController(
	$jobRepository,
	$jobImporter,
	$jobLister,
	$jobHydrator,
	$fileConvertor,
	RESSOURCES_DIR,
);

/* import jobs */
$count = $jobController->importJobs();

printMessage("> {count} jobs imported.", ['{count}' => $count]);

/* list jobs */
$jobs = $jobController->listJobs();


printMessage("> all jobs ({count}):", ['{count}' => count($jobs)]);
foreach ($jobs as $job) {
	printMessage(" {id}: {reference} - {title} - {publication}", [
		'{id}' => $job['id'],
		'{reference}' => $job['reference'],
		'{title}' => $job['title'],
		'{publication}' => $job['publication']
	]);
}

printMessage("Terminating...");
