<?php

declare(strict_types=1);

namespace Utils;

class DbConnect
{

    private \PDO $db;

    public function __construct(
        private readonly string $host,
        private readonly string $username,
        private readonly string $password,
        private readonly string $databaseName
    ) {}


    public function getConnection()
    {
        try {
            $this->db = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->databaseName, $this->username, $this->password);
            return $this->db;
        } catch (\Exception $e) {
            die('DB error: ' . $e->getMessage() . "\n");
        }
    }
}
