<?php

namespace App\Repositories;

use App\Dtos\CreateSupportDTO;
use App\Dtos\UpdateSupportDTO;
use stdClass;

interface SupportRepositoryInterface
{
    public function paginate(int $page, int $totalPerPage, ?string $filter): PaginationInterface;

    public function getAll(?string $filter): array;

    public function findOne(string $id): ?stdClass;

    public function save(CreateSupportDTO $dto): stdClass;

    public function update(UpdateSupportDTO $dto): ?stdClass;

    public function delete(string $id): void;
}
