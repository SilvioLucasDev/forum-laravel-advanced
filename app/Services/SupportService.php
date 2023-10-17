<?php

namespace App\Services;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use stdClass;

class SupportService
{
    protected $repository;

    public function __construct()
    {
    }

    public function getAll(?string $filter): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): ?stdClass
    {
        return $this->repository->findOne($id);
    }

    public function create(CreateSupportDTO $dto): stdClass
    {
        return $this->repository->save($dto);
    }

    public function update(UpdateSupportDTO $dto): ?stdClass
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }
}
