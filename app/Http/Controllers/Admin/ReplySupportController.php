<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\Replies\CreateReplyDTO;
use App\Http\Controllers\Controller;
use App\Services\ReplySupportService;
use App\Services\SupportService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReplySupportController extends Controller
{
    public function __construct(
        protected SupportService $supportService,
        protected ReplySupportService $replySupportService
    ) {
    }

    public function index(string $id): View
    {
        if (! $support = $this->supportService->findOne($id)) {
            return back();
        }
        $replies = $this->replySupportService->getAllBySupportId($id);

        return view('admin.supports.replies.index', [
            'support' => $support,
            'replies' => $replies,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->replySupportService->create(CreateReplyDTO::makeFromRequest($request));

        return redirect()->route('replies.index', $request->route('id'))->with('message', 'Cadastrado com sucesso!');
    }

    public function destroy(string $supportId, string $replyId): RedirectResponse
    {
        $this->replySupportService->delete($replyId);

        return redirect()->route('replies.index', $supportId)->with('message', 'Deletado com sucesso!');
    }
}
