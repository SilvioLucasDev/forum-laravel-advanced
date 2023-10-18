<?php

namespace App\Repositories\Contracts;

use App\Dtos\Supports\CreateSupportDTO;
use App\Dtos\Supports\UpdateSupportDTO;
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
