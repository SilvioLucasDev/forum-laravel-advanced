<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SupportController extends Controller
{
    public function index(Support $support): View
    {
        $supports = $support->all();

        return view('admin.supports.index', [
            'supports' => $supports,
        ]);
    }

    public function create(): View
    {
        return view('admin.supports.create');
    }

    public function store(StoreUpdateSupportRequest $request, Support $support): RedirectResponse
    {
        $data = $request->validated();
        $data['status'] = 'a';
        $support->create($data);

        return redirect()->route('supports.index');
    }

    public function show(Support $support, string|int $id): RedirectResponse|View
    {
        if (! $support = $support->find($id)) {
            return back();
        }

        return view('admin.supports.show', [
            'support' => $support,
        ]);
    }

    public function edit(Support $support, string|int $id): View
    {
        if (! $support = $support->find($id)) {
            return back();
        }

        return view('admin.supports.edit', [
            'support' => $support,
        ]);
    }

    public function update(StoreUpdateSupportRequest $request, Support $support, string|int $id): RedirectResponse
    {
        if (! $support = $support->find($id)) {
            return back();
        }
        $data = $request->validated();
        $support->update($data);

        return redirect()->route('supports.index');
    }

    public function destroy(Support $support, string|int $id): RedirectResponse
    {
        if (! $support = $support->find($id)) {
            return back();
        }
        $support->delete();

        return redirect()->route('supports.index');
    }
}
