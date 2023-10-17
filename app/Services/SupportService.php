<?php

namespace App\Services;

use App\Dtos\CreateSupportDTO;
use App\Dtos\UpdateSupportDTO;
use App\Repositories\PaginationInterface;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportService
{
    public function __construct(
        protected SupportRepositoryInterface $repository
    ) {
    }

    public function paginate(
        int $page,
        int $totalPerPage,
        ?string $filter
    ): PaginationInterface {
        return $this->repository->paginate(
            $page,
            $totalPerPage,
            $filter
        );
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
