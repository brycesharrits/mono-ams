<?php

namespace App\Modules\Membership\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Membership\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MembersController extends Controller
{
    private const STATUSES = ['active', 'pending', 'expired'];

    public function index(Request $request): View
    {
        $members = Member::query()
            ->when($request->string('q')->trim()->toString(), function ($query, $term) {
                $query->where(function ($q) use ($term) {
                    $q->where('first_name', 'like', "%{$term}%")
                        ->orWhere('last_name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%")
                        ->orWhere('member_number', 'like', "%{$term}%");
                });
            })
            ->when(in_array($request->string('status')->toString(), self::STATUSES, true), function ($query) use ($request) {
                $query->where('status', $request->string('status')->toString());
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(20)
            ->withQueryString();

        return view('membership::admin.members.index', [
            'members' => $members,
            'statuses' => self::STATUSES,
            'filters' => [
                'q' => $request->string('q')->toString(),
                'status' => $request->string('status')->toString(),
            ],
        ]);
    }

    public function create(): View
    {
        return view('membership::admin.members.create', [
            'member' => new Member(['status' => 'active']),
            'statuses' => self::STATUSES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateMember($request);
        $member = Member::create($data);

        return redirect()
            ->route('admin.members.show', $member)
            ->with('status', "Member {$member->first_name} {$member->last_name} created.");
    }

    public function show(Member $member): View
    {
        return view('membership::admin.members.show', ['member' => $member]);
    }

    public function edit(Member $member): View
    {
        return view('membership::admin.members.edit', [
            'member' => $member,
            'statuses' => self::STATUSES,
        ]);
    }

    public function update(Request $request, Member $member): RedirectResponse
    {
        $data = $this->validateMember($request, $member);
        $member->update($data);

        return redirect()
            ->route('admin.members.show', $member)
            ->with('status', 'Member updated.');
    }

    public function destroy(Member $member): RedirectResponse
    {
        $member->delete();

        return redirect()
            ->route('admin.members.index')
            ->with('status', 'Member deleted.');
    }

    private function validateMember(Request $request, ?Member $member = null): array
    {
        return $request->validate([
            'member_number' => ['nullable', 'string', 'max:50', Rule::unique('members', 'member_number')->ignore($member?->id)],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('members', 'email')->ignore($member?->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'status' => ['required', Rule::in(self::STATUSES)],
            'joined_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:joined_at'],
        ]);
    }
}
