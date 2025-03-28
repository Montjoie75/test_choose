<?php

declare(strict_types=1);

namespace Entity;

use \DateTimeImmutable;

class Job
{
    private string $ref;
    private string $title;
    private string $description;
    private string $url;
    private string $company;
    private \DateTimeImmutable $pubDate;
    private ?int $id;

    public function __construct(
        string $ref,
        string $title,
        string $description,
        string $url,
        string $company,
        \DateTimeImmutable $pubDate
    ) {
        $this->ref = $ref;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->company = $company;
        $this->pubDate = $pubDate;
        $this->id = 0;
    }

    public function getRef()
    {
        return $this->ref;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function toArray()
    {
        $dateToString = $this->pubDate->format(("Y-m-d"));

        $jobToArray = [
            'reference' => $this->ref,
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'company_name' => $this->company,
            'publication' => $dateToString
        ];
        isset($this->id) ? $jobToArray['id'] = $this->id : null;
        return $jobToArray;
    }
}
