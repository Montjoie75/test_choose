<?php

/************************************
Entry point of the project.
To be run from the command line.
 ************************************/

use Controller\JobController;
use Convertor\FileConvertorBuilder;
use Repository\JobRepository;
use Service\JobImporter;
use Utils\DbConnect;

include_once(__DIR__ . '/utils.php');
include_once(__DIR__ . '/config.php');


printMessage("Starting...");

$jobImporter = new JobImporter();
$dbConnect = new DbConnect(SQL_HOST, SQL_USER, SQL_PWD, SQL_DB);
$fileConvertor = new FileConvertorBuilder;
$jobRepository = new JobRepository($dbConnect->getConnection());


$jobController = new JobController(
	$jobRepository,
	$jobImporter,
	$dbConnect,
	$fileConvertor,
	RESSOURCES_DIR,
);

$jobController->ImportJobs();
die();

/* import jobs from regionsjob.xml */
$jobsImporter = new JobsImporter(SQL_HOST, SQL_USER, SQL_PWD, SQL_DB, RESSOURCES_DIR . 'regionsjob.xml');
$count = $jobsImporter->importJobs();

printMessage("> {count} jobs imported.", ['{count}' => $count]);


/* list jobs */
$jobsLister = new JobsLister(SQL_HOST, SQL_USER, SQL_PWD, SQL_DB);
$jobs = $jobsLister->listJobs();

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
