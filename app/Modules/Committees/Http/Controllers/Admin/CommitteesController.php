<?php

namespace App\Modules\Committees\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Committees\Models\Committee;
use App\Modules\Membership\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CommitteesController extends Controller
{
    public function index(Request $request): View
    {
        $committees = Committee::query()
            ->withCount('members')
            ->when($request->string('q')->trim()->toString(), function ($query, $term) {
                $query->where('name', 'like', "%{$term}%");
            })
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('committees::admin.committees.index', [
            'committees' => $committees,
            'filters' => ['q' => $request->string('q')->toString()],
        ]);
    }

    public function create(): View
    {
        return view('committees::admin.committees.create', [
            'committee' => new Committee(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateCommittee($request);
        $committee = Committee::create($data);

        return redirect()
            ->route('admin.committees.show', $committee)
            ->with('status', "Committee \"{$committee->name}\" created.");
    }

    public function show(Committee $committee): View
    {
        $committee->load('members');

        $assignedIds = $committee->members->pluck('id');
        $available = Member::query()
            ->whereNotIn('id', $assignedIds)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get(['id', 'first_name', 'last_name', 'email']);

        return view('committees::admin.committees.show', [
            'committee' => $committee,
            'available' => $available,
            'roles' => Committee::ROLES,
        ]);
    }

    public function edit(Committee $committee): View
    {
        return view('committees::admin.committees.edit', [
            'committee' => $committee,
        ]);
    }

    public function update(Request $request, Committee $committee): RedirectResponse
    {
        $data = $this->validateCommittee($request, $committee);
        $committee->update($data);

        return redirect()
            ->route('admin.committees.show', $committee)
            ->with('status', 'Committee updated.');
    }

    public function destroy(Committee $committee): RedirectResponse
    {
        $committee->delete();

        return redirect()
            ->route('admin.committees.index')
            ->with('status', 'Committee deleted.');
    }

    private function validateCommittee(Request $request, ?Committee $committee = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150', Rule::unique('committees', 'name')->ignore($committee?->id)],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
    }
}
