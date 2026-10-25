<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }} — {{ config('app.name') }}</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; margin: 0; background: #f5f6f8; color: #1a1a1a; }
        header { background: #111827; color: #f9fafb; padding: 14px 24px; display: flex; justify-content: space-between; align-items: center; }
        header .brand { font-weight: 600; letter-spacing: 0.3px; }
        header nav form { display: inline; margin: 0; }
        header nav button { background: transparent; color: #f9fafb; border: 1px solid #374151; padding: 6px 12px; border-radius: 6px; cursor: pointer; font: inherit; }
        header nav button:hover { background: #1f2937; }
        main { max-width: 960px; margin: 32px auto; padding: 0 24px; }
        .card { background: #fff; border: 1px solid #e5e7eb; border-radius: 10px; padding: 24px; box-shadow: 0 1px 2px rgba(0,0,0,0.04); }
        .card h1 { margin: 0 0 8px; font-size: 20px; }
        .card p { margin: 0; color: #4b5563; }
        .stat { display: inline-block; margin-top: 16px; padding: 10px 16px; background: #eef2ff; color: #3730a3; border-radius: 8px; font-weight: 500; }
        form.auth { max-width: 380px; margin: 64px auto 0; background: #fff; border: 1px solid #e5e7eb; border-radius: 10px; padding: 28px; }
        form.auth h1 { margin: 0 0 20px; font-size: 20px; }
        form.auth label { display: block; font-size: 13px; margin-bottom: 4px; color: #374151; }
        form.auth input[type=email], form.auth input[type=password] { width: 100%; padding: 9px 11px; border: 1px solid #d1d5db; border-radius: 6px; font: inherit; margin-bottom: 14px; }
        form.auth .remember { display: flex; align-items: center; gap: 8px; margin-bottom: 18px; font-size: 14px; color: #374151; }
        form.auth button { width: 100%; padding: 10px; background: #111827; color: #f9fafb; border: 0; border-radius: 6px; cursor: pointer; font: inherit; font-weight: 500; }
        form.auth button:hover { background: #1f2937; }
        .error { color: #b91c1c; font-size: 13px; margin: -10px 0 10px; }
        .flash { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; padding: 10px 14px; border-radius: 8px; margin-bottom: 16px; font-size: 14px; }
        .toolbar { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 16px; flex-wrap: wrap; }
        .toolbar h1 { margin: 0; font-size: 20px; }
        .toolbar form { display: flex; gap: 8px; align-items: center; }
        .toolbar input[type=search], .toolbar select { padding: 7px 10px; border: 1px solid #d1d5db; border-radius: 6px; font: inherit; }
        .btn { display: inline-block; padding: 8px 14px; background: #111827; color: #f9fafb; border: 0; border-radius: 6px; font: inherit; cursor: pointer; text-decoration: none; }
        .btn:hover { background: #1f2937; }
        .btn.secondary { background: #e5e7eb; color: #111827; }
        .btn.secondary:hover { background: #d1d5db; }
        .btn.danger { background: #b91c1c; }
        .btn.danger:hover { background: #991b1b; }
        .btn.sm { padding: 5px 10px; font-size: 13px; }
        table.list { width: 100%; border-collapse: collapse; background: #fff; border: 1px solid #e5e7eb; border-radius: 10px; overflow: hidden; }
        table.list th, table.list td { padding: 10px 14px; text-align: left; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
        table.list th { background: #f9fafb; font-weight: 600; color: #374151; }
        table.list tr:last-child td { border-bottom: 0; }
        table.list a { color: #1d4ed8; text-decoration: none; }
        table.list a:hover { text-decoration: underline; }
        .pill { display: inline-block; padding: 2px 8px; border-radius: 999px; font-size: 12px; font-weight: 500; }
        .pill.active { background: #d1fae5; color: #065f46; }
        .pill.pending { background: #fef3c7; color: #92400e; }
        .pill.expired { background: #fee2e2; color: #991b1b; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px 20px; }
        .form-grid .full { grid-column: 1 / -1; }
        .form-grid label { display: block; font-size: 13px; margin-bottom: 4px; color: #374151; }
        .form-grid input, .form-grid select { width: 100%; padding: 8px 11px; border: 1px solid #d1d5db; border-radius: 6px; font: inherit; }
        .form-actions { display: flex; gap: 10px; margin-top: 20px; }
        dl.detail { display: grid; grid-template-columns: 150px 1fr; gap: 8px 20px; margin: 0; }
        dl.detail dt { color: #6b7280; font-size: 13px; }
        dl.detail dd { margin: 0; font-size: 14px; }
        .empty { padding: 40px; text-align: center; color: #6b7280; background: #fff; border: 1px dashed #d1d5db; border-radius: 10px; }
        .pagination { margin-top: 16px; display: flex; gap: 6px; justify-content: center; font-size: 14px; }
        .pagination a, .pagination span { padding: 6px 10px; border-radius: 6px; text-decoration: none; color: #374151; }
        .pagination a:hover { background: #e5e7eb; }
        .pagination .active span { background: #111827; color: #f9fafb; }
        .pagination .disabled span { color: #9ca3af; }
    </style>
</head>
<body>
    @auth('admin')
        <header>
            <div class="brand">{{ config('app.name') }} · Admin</div>
            <nav>
                <a href="{{ route('admin.dashboard') }}" style="color:#f9fafb;text-decoration:none;margin-right:16px;font-size:14px;">Dashboard</a>
                <a href="{{ route('admin.members.index') }}" style="color:#f9fafb;text-decoration:none;margin-right:16px;font-size:14px;">Members</a>
                <span style="margin-right:12px;font-size:14px;color:#9ca3af;">{{ auth('admin')->user()->name }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit">Log out</button>
                </form>
            </nav>
        </header>
    @endauth
    <main>
        @if (session('status'))
            <div class="flash">{{ session('status') }}</div>
        @endif
        {{ $slot ?? '' }}
        @yield('content')
    </main>
</body>
</html>
