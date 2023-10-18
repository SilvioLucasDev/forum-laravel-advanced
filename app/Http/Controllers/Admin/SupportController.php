<?php

namespace App\Http\Controllers\Admin;

use App\Dtos\Supports\CreateSupportDTO;
use App\Dtos\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $supportService
    ) {
    }

    public function index(Request $request): View
    {
        $supports = $this->supportService->paginate(
            $request->get('page', 1),
            $request->get('per_page', 10),
            $request->get('filter', null),
        );
        $filters = ['filter' => $request->get('filter', null)];

        return view('admin.supports.index', [
            'supports' => $supports,
            'filters' => $filters,
        ]);
    }

    public function create(): View
    {
        return view('admin.supports.create');
    }

    public function store(StoreUpdateSupportRequest $request): RedirectResponse
    {
        $this->supportService->create(CreateSupportDTO::makeFromRequest($request));

        return redirect()->route('supports.index')->with('message', 'Cadastrado com sucesso!');
    }

    // public function show(string $id): RedirectResponse|View
    // {
    //     if (! $support = $this->supportService->findOne($id)) {
    //         return back();
    //     }

    //     return view('admin.supports.show', [
    //         'support' => $support,
    //     ]);
    // }

    public function edit(string $id): View
    {
        if (! $support = $this->supportService->findOne($id)) {
            return back();
        }

        return view('admin.supports.edit', [
            'support' => $support,
        ]);
    }

    public function update(StoreUpdateSupportRequest $request, Support $support, string $id): RedirectResponse
    {
        $support = $this->supportService->update(UpdateSupportDTO::makeFromRequest($request));
        if (! $support) {
            return back();
        }

        return redirect()->route('supports.index')->with('message', 'Atualizado com sucesso!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->supportService->delete($id);

        return redirect()->route('supports.index')->with('message', 'Deletado com sucesso!');
    }
}
