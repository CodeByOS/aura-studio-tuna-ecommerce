{{-- resources/views/errors/403.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — Forbidden</title>

    {{-- Iconoir Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css">
    {{-- DM Sans Font --}}
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-base: #F5F4F0;
            --bg-surface: #FFFFFF;
            --text-primary: #1A1A18;
            --text-secondary: #6B6A66;
            --border-subtle: #E8E6E0;
            --font-family: 'DM Sans', sans-serif;
            --radius-md: 4px;
            --transition-smooth: all 0.15s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-family);
            background-color: var(--bg-base);
            color: var(--text-primary);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            position: relative;
        }

        .status-code-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 35vw;
            font-weight: 300;
            color: var(--text-primary);
            opacity: 0.03;
            z-index: 0;
            pointer-events: none;
            letter-spacing: -0.05em;
        }

        .error-container {
            position: relative;
            z-index: 10;
            max-width: 500px;
            padding: 40px 24px;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 32px;
            font-weight: 400;
            letter-spacing: -0.02em;
            margin-bottom: 16px;
        }

        p {
            font-size: 15px;
            color: var(--text-secondary);
            font-weight: 300;
            line-height: 1.6;
            margin-bottom: 8px;
        }

        .joke-text {
            font-style: italic;
            color: #8C7B5D;
            margin-bottom: 40px;
        }

        .illustration-wrapper {
            margin-bottom: 32px;
            display: flex;
            justify-content: center;
        }

        .organic-svg {
            width: 80px;
            height: 80px;
        }

        .organic-path {
            fill: none;
            stroke: var(--text-primary);
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .actions {
            display: flex;
            gap: 16px;
            justify-content: center;
            margin-bottom: 48px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 48px;
            padding: 0 32px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            text-decoration: none;
            border-radius: var(--radius-md);
            transition: var(--transition-smooth);
            cursor: pointer;
        }

        .btn-primary {
            background-color: var(--text-primary);
            color: var(--bg-surface);
            border: 1px solid var(--text-primary);
        }

        .btn-primary:hover { background-color: #333330; }

        .btn-ghost {
            background-color: transparent;
            color: var(--text-primary);
            border: 1px solid var(--text-primary);
        }

        .btn-ghost:hover {
            background-color: var(--text-primary);
            color: var(--bg-surface);
        }
    </style>
</head>
<body>

    <div class="status-code-bg">403</div>

    <div class="error-container">
        <!-- Minimalist Lock / Shield Illustration -->
        <div class="illustration-wrapper">
            <svg class="organic-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <!-- Lock body -->
                <rect class="organic-path" x="30" y="45" width="40" height="35" rx="4" />
                <!-- Lock shackle -->
                <path class="organic-path" d="M35,45 C35,30 50,30 50,30 C65,30 65,45 65,45" />
                <!-- Keyhole -->
                <circle class="organic-path" cx="50" cy="60" r="5" />
                <path class="organic-path" d="M50,60 L50,68" />
            </svg>
        </div>

        <h1>Access denied</h1>
        <p>You don’t have permission to view this page.</p>
        <p class="joke-text">This can is sealed — no entry for unauthorized personnel.</p>

        <div class="actions">
            <a href="{{ url('/') }}" class="btn btn-primary">Back to Homepage</a>
            <a href="{{ route('shop.catalog') }}" class="btn btn-ghost">Browse the Shop</a>
        </div>
    </div>

</body>
</html>