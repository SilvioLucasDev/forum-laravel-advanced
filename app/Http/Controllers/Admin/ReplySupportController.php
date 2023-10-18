<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupportService;
use Illuminate\Contracts\View\View;

class ReplySupportController extends Controller
{
    public function __construct(
        protected SupportService $supportService
    ) {
    }

    public function index(string $id): View
    {
        if (! $support = $this->supportService->findOne($id)) {
            return back();
        }

        return view('admin.supports.replies.index', [
            'support' => $support,
        ]);
    }
}
