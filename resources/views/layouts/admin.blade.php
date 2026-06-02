<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel — Voting EC')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            font-family: 'Baloo 2', Arial, Helvetica, sans-serif;
            box-sizing: border-box;
        }

        body {
            background: #f0f4f8;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #0097b2 0%, #007a93 100%);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            padding-top: 0;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar-brand {
            padding: 24px 20px;
            font-size: 1.4rem;
            font-weight: 800;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand i {
            font-size: 1.6rem;
        }

        .sidebar-nav {
            list-style: none;
            padding: 15px 0;
            margin: 0;
        }

        .sidebar-nav li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-nav li a:hover,
        .sidebar-nav li a.active {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-left-color: #fff;
        }

        .sidebar-nav li a i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .sidebar-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 10px 20px;
        }

        /* Main content */
        .main-content {
            margin-left: 260px;
            padding: 0;
            min-height: 100vh;
        }

        /* Top navbar */
        .top-navbar {
            background: #fff;
            padding: 16px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .top-navbar h4 {
            font-weight: 700;
            color: #2d3748;
            margin: 0;
        }

        .content-area {
            padding: 30px;
        }

        /* Stats Card */
        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s ease;
            border: 1px solid #e8eef3;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: #fff;
        }

        .stat-card .stat-icon.bg-teal { background: linear-gradient(135deg, #0097b2, #00abc9); }
        .stat-card .stat-icon.bg-amber { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .stat-card .stat-icon.bg-rose { background: linear-gradient(135deg, #f43f5e, #e11d48); }
        .stat-card .stat-icon.bg-emerald { background: linear-gradient(135deg, #10b981, #059669); }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: #1a202c;
            line-height: 1;
        }

        .stat-card .stat-label {
            color: #718096;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Table styles */
        .data-table {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            border: 1px solid #e8eef3;
        }

        .data-table .table {
            margin-bottom: 0;
        }

        .data-table .table thead th {
            background: #f7fafc;
            border-bottom: 2px solid #e2e8f0;
            color: #4a5568;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 18px;
        }

        .data-table .table tbody td {
            padding: 14px 18px;
            vertical-align: middle;
            color: #2d3748;
            border-bottom: 1px solid #f0f4f8;
        }

        .data-table .table tbody tr:hover {
            background: #f7fafc;
        }

        .data-table .candidate-img {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #e2e8f0;
        }

        /* Form styles */
        .form-card {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            border: 1px solid #e8eef3;
        }

        .form-card .form-label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 6px;
        }

        .form-card .form-control {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding: 10px 16px;
            font-size: 0.95rem;
            transition: border-color 0.2s ease;
        }

        .form-card .form-control:focus {
            border-color: #0097b2;
            box-shadow: 0 0 0 3px rgba(0, 151, 178, 0.1);
        }

        /* Buttons */
        .btn-teal {
            background: linear-gradient(135deg, #0097b2, #00abc9);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-teal:hover {
            background: linear-gradient(135deg, #007a93, #0097b2);
            color: #fff;
            transform: translateY(-1px);
        }

        /* Status controls */
        .status-control {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            border: 1px solid #e8eef3;
        }

        .status-btn {
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            border: 2px solid;
            transition: all 0.2s ease;
        }

        .status-btn:hover {
            transform: translateY(-1px);
        }

        .status-btn.active-status {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Alert styles */
        .alert {
            border-radius: 12px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    {{-- Sidebar --}}
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-check2-circle"></i>
            <span>Voting EC</span>
        </div>
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.candidates.index') }}" class="{{ request()->routeIs('admin.candidates.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    Kelola Kandidat
                </a>
            </li>
            <div class="sidebar-divider"></div>
            <li>
                <a href="{{ route('home') }}" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i>
                    Lihat Halaman Voting
                </a>
            </li>
        </ul>
    </div>

    {{-- Main Content --}}
    <div class="main-content">
        <div class="top-navbar">
            <h4>@yield('page-title', 'Dashboard')</h4>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted" style="font-size: 0.9rem;">
                    <i class="bi bi-person-circle me-1"></i>
                    {{ Auth::user()->name }}
                </span>
                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm" style="border-radius: 8px;">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="content-area">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    @yield('scripts')
</body>

</html>
