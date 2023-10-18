<?php

namespace App\Repositories\Eloquent;

use App\Dtos\Replies\CreateReplyDTO;
use App\Models\ReplySupport;
use App\Repositories\Contracts\ReplySupportRepositoryInterface;
use stdClass;

class ReplySupportRepository implements ReplySupportRepositoryInterface
{
    public function __construct(
        protected ReplySupport $replySupportModel
    ) {
    }

    public function getAllBySupportId(string $id): array
    {
        $replies = $this->replySupportModel->with('user', 'support')->where('support_id', $id)->get();

        return $replies->toArray();
    }

    public function save(CreateReplyDTO $dto): stdClass
    {
        $reply = $this->replySupportModel->create((array) $dto);

        return (object) $reply->toArray();
    }

    public function delete(string $id): void
    {
        $this->replySupportModel->findOrFail($id)->delete();
    }
}
