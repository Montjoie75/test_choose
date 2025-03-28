<?php

declare(strict_types=1);

namespace Entity;

use DateTimeImmutable;

class Job
{
    private string $ref;
    private string $title;
    private string $description;
    private string $url;
    private string $company;
    private \DateTimeImmutable $pubDate;

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
    }

    public function getRef() {}
    public function getTitle() {}
    public function getDescription() {}
    public function getUrl() {}
    public function getCompany() {}
    public function getPubDate() {}

    public function setRef() {}
    public function setTitle() {}
    public function setDescription() {}
    public function setUrl() {}
    public function setCompany() {}
    public function setPubDate() {}


    public function toArray()
    {
        $dateToString = $this->pubDate->format(("Y-m-d"));

        return [
            'reference' => $this->ref,
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'company_name' => $this->company,
            'publication' => $dateToString,

        ];
    }
}
