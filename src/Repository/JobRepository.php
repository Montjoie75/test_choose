<?php

declare(strict_types=1);

namespace Repository;

class JobRepository
{

    private \PDO $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function saveJobs(array $dataList): int
    {
        $this->db->exec('DELETE FROM job');

        $count = 0;

        $sql = 'INSERT INTO job (reference, title, description, url, company_name, publication) VALUES (:reference, :title, :description, :url, :company_name, :publication)';
        $stmt = $this->db->prepare($sql);

        $count = 0;
        foreach ($dataList as $data) {
            $stmt->execute([
                ':reference' => $data['reference'],
                ':title' => $data['title'],
                ':description' => $data['description'],
                ':url' => $data['url'],
                ':company_name' => $data['company_name'],
                ':publication' => $data['publication'],
            ]);
            $count++;
        }
        return $count;
    }

    public function findAll(): array
    {
        return $this->db->query('SELECT id, reference, title, description, url, company_name, publication FROM job')->fetchAll(\PDO::FETCH_ASSOC);
    }
}
