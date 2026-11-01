<?php

namespace App\Modules\Committees\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Committees\Models\Committee;
use App\Modules\Membership\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommitteeMembersController extends Controller
{
    public function store(Request $request, Committee $committee): RedirectResponse
    {
        $data = $request->validate([
            'member_id' => [
                'required',
                'integer',
                Rule::exists('members', 'id'),
                Rule::unique('committee_member', 'member_id')->where('committee_id', $committee->id),
            ],
            'role' => ['required', Rule::in(Committee::ROLES)],
            'joined_at' => ['nullable', 'date'],
        ]);

        $committee->members()->attach($data['member_id'], [
            'role' => $data['role'],
            'joined_at' => $data['joined_at'] ?? now()->toDateString(),
        ]);

        return redirect()
            ->route('admin.committees.show', $committee)
            ->with('status', 'Member added to committee.');
    }

    public function update(Request $request, Committee $committee, Member $member): RedirectResponse
    {
        $data = $request->validate([
            'role' => ['required', Rule::in(Committee::ROLES)],
        ]);

        $committee->members()->updateExistingPivot($member->id, [
            'role' => $data['role'],
        ]);

        return redirect()
            ->route('admin.committees.show', $committee)
            ->with('status', 'Role updated.');
    }

    public function destroy(Committee $committee, Member $member): RedirectResponse
    {
        $committee->members()->detach($member->id);

        return redirect()
            ->route('admin.committees.show', $committee)
            ->with('status', 'Member removed from committee.');
    }
}
