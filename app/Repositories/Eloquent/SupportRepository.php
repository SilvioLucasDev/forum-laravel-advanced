<?php

namespace App\Repositories\Eloquent;

use App\Dtos\CreateSupportDTO;
use App\Dtos\UpdateSupportDTO;
use App\Models\Support;
use App\Repositories\PaginationInterface;
use App\Repositories\PaginationPresenter;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportRepository implements SupportRepositoryInterface
{
    public function __construct(
        protected Support $SupportModel
    ) {
    }

    public function paginate(int $page, int $totalPerPage, ?string $filter): PaginationInterface
    {
        $result = $this->SupportModel->where(function ($query) use ($filter) {
            if ($filter) {
                $query->where('subject', $filter);
                $query->orWhere('body', 'like', "%{$filter}%");
            }
        })->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($result);
    }

    public function getAll(?string $filter): array
    {
        return $this->SupportModel->where(function ($query) use ($filter) {
            if ($filter) {
                $query->where('subject', $filter);
                $query->orWhere('body', 'like', "%{$filter}%");
            }
        })->get()->toArray();
    }

    public function findOne(string $id): ?stdClass
    {
        $support = $this->SupportModel->find($id);
        if (! $support) {
            return null;
        }

        return (object) $support->toArray();

    }

    public function save(CreateSupportDTO $dto): stdClass
    {
        $support = $this->SupportModel->create((array) $dto);

        return (object) $support->toArray();
    }

    public function update(UpdateSupportDTO $dto): ?stdClass
    {
        if (! $support = $this->SupportModel->find($dto->id)) {
            return null;
        }
        $support->update((array) $dto);

        return (object) $support->toArray();
    }

    public function delete(string $id): void
    {
        $this->SupportModel->findOrFail($id)->delete();
    }
}
