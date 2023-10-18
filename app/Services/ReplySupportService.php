<?php

namespace App\Services;

use App\Dtos\Replies\CreateReplyDTO;
use App\Repositories\Contracts\ReplySupportRepositoryInterface;
use stdClass;

class ReplySupportService
{
    public function __construct(
        protected ReplySupportRepositoryInterface $repository
    ) {
    }

    public function getAllBySupportId(string $id): array
    {
        return $this->repository->getAllBySupportId($id);
    }

    public function create(CreateReplyDTO $dto): stdClass
    {
        return $this->repository->save($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }
}
