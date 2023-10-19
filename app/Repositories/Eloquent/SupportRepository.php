<?php

namespace App\Repositories\Eloquent;

use App\Dtos\Supports\CreateSupportDTO;
use App\Dtos\Supports\UpdateSupportDTO;
use App\Enums\SupportStatusEnum;
use App\Models\Support;
use App\Repositories\Contracts\PaginationInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use stdClass;

class SupportRepository implements SupportRepositoryInterface
{
    public function __construct(
        protected Support $supportModel
    ) {
    }

    public function paginate(int $page, int $totalPerPage, ?string $filter): PaginationInterface
    {
        $result = $this->supportModel
            ->with(['replies' => function ($query) {
                $query->limit(4);
                $query->latest();
            }])
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like', "%{$filter}%");
                }
            })->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($result);
    }

    public function getAll(?string $filter): array
    {
        return $this->supportModel->whit('user')
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like', "%{$filter}%");
                }
            })->get()->toArray();
    }

    public function findOne(string $id): ?stdClass
    {
        $support = $this->supportModel->with('user')->find($id);
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
        $support = $this->supportModel->find($dto->id);
        if (! $support) {
            return null;
        }
        if (Gate::denies('owner', $support->user->id)) {
            abort(403, 'Not Authorized');
        }
        $support->update((array) $dto);

        return (object) $support->toArray();
    }

    public function delete(string $id): void
    {
        $support = $this->supportModel->findOrFail($id);
        if (Gate::denies('owner', $support->user->id)) {
            abort(403, 'Not Authorized');
        }
        $support->delete();
    }

    public function updateStatus(string $id, SupportStatusEnum $status): void
    {
        $this->supportModel->where('id', $id)->update([
            'status' => $status->name,
        ]);
    }
}
