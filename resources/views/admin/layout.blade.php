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
    </style>
</head>
<body>
    @auth('admin')
        <header>
            <div class="brand">{{ config('app.name') }} · Admin</div>
            <nav>
                <span style="margin-right:12px;font-size:14px;color:#9ca3af;">{{ auth('admin')->user()->name }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit">Log out</button>
                </form>
            </nav>
        </header>
    @endauth
    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>
</body>
</html>
