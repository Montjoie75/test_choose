<?php

declare(strict_types=1);

namespace Convertor;

class FileConvertorBuilder
{

    const XML_FORMAT = 'xml';
    const JSON_FORMAT = 'json';

    public function buildFile(string $resourcesDirectory): array
    {

        $files = $this->GetFilesFromDirectory($resourcesDirectory);
        $filesToConvert = [];

        foreach ($files as $fileName) {
            if (pathinfo($fileName, PATHINFO_EXTENSION) === self::JSON_FORMAT) {
                $filesToConvert[] = new JsonFileConvertor($resourcesDirectory . $fileName);
            } elseif (pathinfo($fileName, PATHINFO_EXTENSION) === self::XML_FORMAT) {
                $filesToConvert[] = new XmlFileConvertor($resourcesDirectory . $fileName);
            } else {
                throw new \Exception('This file exension is not correct: ' . $fileName);
            }
        }

        return $filesToConvert;
    }


    private function GetFilesFromDirectory($resourcesDirectory): array
    {
        $files = [];
        $directory = new \DirectoryIterator($resourcesDirectory);

        foreach ($directory as $fileInfo) {
            if ($fileInfo->isFile()) {
                $files[] = $fileInfo->getBasename();
            }
        }
        return $files;
    }
}
