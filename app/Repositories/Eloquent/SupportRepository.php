<?php

namespace App\Repositories\Eloquent;

use App\Dtos\Supports\CreateSupportDTO;
use App\Dtos\Supports\UpdateSupportDTO;
use App\Models\Support;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;
use stdClass;

class SupportRepository implements SupportRepositoryInterface
{
    public function __construct(
        protected Support $supportModel
    ) {
    }

    public function paginate(int $page, int $totalPerPage, ?string $filter): PaginationInterface
    {
        $result = $this->supportModel->where(function ($query) use ($filter) {
            if ($filter) {
                $query->where('subject', $filter);
                $query->orWhere('body', 'like', "%{$filter}%");
            }
        })->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($result);
    }

    public function getAll(?string $filter): array
    {
        return $this->supportModel->where(function ($query) use ($filter) {
            if ($filter) {
                $query->where('subject', $filter);
                $query->orWhere('body', 'like', "%{$filter}%");
            }
        })->get()->toArray();
    }

    public function findOne(string $id): ?stdClass
    {
        $support = $this->supportModel->find($id);
        if (! $support) {
            return null;
        }

        return (object) $support->toArray();
    }

    public function save(CreateSupportDTO $dto): stdClass
    {
        $support = $this->supportModel->create((array) $dto);

        return (object) $support->toArray();
    }

    public function update(UpdateSupportDTO $dto): ?stdClass
    {
        if (! $support = $this->supportModel->find($dto->id)) {
            return null;
        }
        $support->update((array) $dto);

        return (object) $support->toArray();
    }

    public function delete(string $id): void
    {
        $this->supportModel->findOrFail($id)->delete();
    }
}
