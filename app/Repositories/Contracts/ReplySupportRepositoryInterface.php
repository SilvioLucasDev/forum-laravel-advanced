<?php

namespace App\Repositories\Contracts;

use App\Dtos\Replies\CreateReplyDTO;
use stdClass;

interface ReplySupportRepositoryInterface
{
    public function getAllBySupportId(string $id): array;

    public function save(CreateReplyDTO $dto): stdClass;

    public function delete(string $id): bool;
}
