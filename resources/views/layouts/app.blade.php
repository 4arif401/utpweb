<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="UTP Scholars Hub - Directory of Expert Academics and Scholars at Universiti Teknologi PETRONAS">
    <title>@yield('title', 'UTP Scholars Hub')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ── Root Variables ──────────────────────────────────────── */
        :root {
            --navy:        #0a1628;
            --navy-mid:    #152241;
            --navy-light:  #1e3260;
            --gold:        #c9a227;
            --gold-light:  #e8bc36;
            --gold-pale:   #fdf6e3;
            --surface:     #f5f7fc;
            --card:        #ffffff;
            --border:      #e4e9f2;
            --text-main:   #0f172a;
            --text-muted:  #64748b;
            --text-light:  #94a3b8;
            --shadow-sm:   0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
            --shadow-md:   0 4px 16px rgba(0,0,0,.08), 0 2px 4px rgba(0,0,0,.04);
            --shadow-lg:   0 10px 40px rgba(0,0,0,.12), 0 4px 12px rgba(0,0,0,.06);
            --radius:      12px;
            --radius-sm:   8px;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--surface);
            color: var(--text-main);
            margin: 0;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Navbar ──────────────────────────────────────────────── */
        .main-nav {
            background: rgba(10, 22, 40, 0.97);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(201,162,39,.25);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: box-shadow .3s;
        }
        .main-nav.scrolled {
            box-shadow: 0 4px 24px rgba(0,0,0,.3);
        }
        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .9rem 1.5rem;
            max-width: 1320px;
            margin: 0 auto;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .brand-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: .9rem; font-weight: 800; color: var(--navy);
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(201,162,39,.4);
        }
        .brand-text {
            font-size: 1.15rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -.3px;
        }
        .brand-text span { color: var(--gold); }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
        }
        .nav-link-item {
            color: rgba(255,255,255,.7) !important;
            font-weight: 500;
            font-size: .875rem;
            padding: .5rem .9rem !important;
            border-radius: 6px;
            text-decoration: none;
            transition: color .2s, background .2s;
            letter-spacing: .1px;
        }
        .nav-link-item:hover { color: #fff !important; background: rgba(255,255,255,.07); }
        .nav-link-item.active { color: var(--gold-light) !important; }

        .nav-cta {
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: var(--navy) !important;
            font-weight: 700;
            font-size: .82rem;
            padding: .45rem 1.1rem !important;
            border-radius: 6px;
            text-decoration: none;
            letter-spacing: .2px;
            transition: opacity .2s, transform .15s;
            box-shadow: 0 2px 8px rgba(201,162,39,.35);
        }
        .nav-cta:hover { opacity: .92; transform: translateY(-1px); color: var(--navy) !important; }

        .nav-logout-btn {
            background: rgba(255,255,255,.08);
            color: rgba(255,255,255,.7) !important;
            font-weight: 500;
            font-size: .82rem;
            padding: .45rem .9rem !important;
            border-radius: 6px;
            border: 1px solid rgba(255,255,255,.12);
            cursor: pointer;
            transition: background .2s, color .2s;
        }
        .nav-logout-btn:hover { background: rgba(255,255,255,.15); color: #fff !important; }

        /* ── Flash Messages ───────────────────────────────────────── */
        .flash-wrap { max-width: 1320px; margin: 0 auto; padding: 0 1.5rem; }
        .alert-success { border-left: 4px solid var(--gold); background: var(--gold-pale); color: var(--navy); }

        /* ── Footer ──────────────────────────────────────────────── */
        .site-footer {
            background: var(--navy);
            color: rgba(255,255,255,.45);
            padding: 2rem 0;
            font-size: .8rem;
            margin-top: 5rem;
            border-top: 1px solid rgba(255,255,255,.06);
        }
        .footer-inner {
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .footer-brand {
            font-size: .95rem;
            font-weight: 700;
            color: #fff;
        }
        .footer-brand span { color: var(--gold); }
        .footer-links a {
            color: rgba(255,255,255,.45);
            text-decoration: none;
            transition: color .2s;
        }
        .footer-links a:hover { color: var(--gold-light); }

        /* ── Utility ─────────────────────────────────────────────── */
        .text-gold { color: var(--gold) !important; }
        .bg-navy   { background: var(--navy) !important; }
        .text-navy { color: var(--navy) !important; }

        .card-base {
            background: var(--card);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
        }

        /* ── Animations ──────────────────────────────────────────── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp .4s ease both; }

        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* ── DataTable overrides ─────────────────────────────────── */
        .dataTables_wrapper .dataTables_filter input {
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: .4rem .85rem;
            font-size: .85rem;
            font-family: 'Inter', sans-serif;
            transition: border-color .2s, box-shadow .2s;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,162,39,.12);
            outline: none;
        }
        .dataTables_wrapper .dataTables_length select {
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: .35rem .6rem;
            font-family: 'Inter', sans-serif;
            font-size: .85rem;
        }
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate { font-size: .83rem; color: var(--text-muted); }
        .page-item.active .page-link { background: var(--navy); border-color: var(--navy); }
        .page-link { color: var(--navy); }

        table.dataTable {
            border-collapse: separate !important;
            border-spacing: 0;
        }
        table.dataTable thead tr th,
        table.dataTable thead tr td {
            background: var(--navy) !important;
            color: rgba(255,255,255,.9) !important;
            font-weight: 600 !important;
            font-size: .78rem;
            letter-spacing: .4px;
            text-transform: uppercase;
            border: none !important;
            padding: .9rem 2rem .9rem 1rem !important;
        }
        table.dataTable thead tr th:first-child { border-radius: var(--radius-sm) 0 0 0; }
        table.dataTable thead tr th:last-child  { border-radius: 0 var(--radius-sm) 0 0; }
        table.dataTable thead .dt-column-title { color: rgba(255,255,255,.9) !important; }
        table.dataTable thead .sorting::after,
        table.dataTable thead .sorting_asc::after,
        table.dataTable thead .sorting_desc::after { opacity: .6; }

        table.dataTable tbody tr {
            transition: background .15s;
        }
        table.dataTable tbody tr:hover { background: #f0f5ff !important; }
        table.dataTable tbody td {
            font-size: .875rem;
            padding: .85rem 1rem;
            border-bottom: 1px solid var(--border) !important;
            border-top: none !important;
            vertical-align: middle;
        }
        table.dataTable tbody tr:last-child td { border-bottom: none !important; }
    </style>

    @yield('styles')
</head>
<body>

    @hasSection('navbar')
        @yield('navbar')
    @else
    <!-- ── Navbar ──────────────────────────────────────────────── -->
    <nav class="main-nav" id="mainNav">
        <div class="nav-inner">
            <a class="navbar-brand" href="{{ route('home') }}">
                <div class="brand-icon">U</div>
                <div class="brand-text"><span>UTP</span>Web</div>
            </a>

            <div class="nav-links">
                <a class="nav-link-item {{ request()->routeIs('home') ? 'active' : '' }}"
                   href="{{ route('home') }}">Home</a>
                <a class="nav-link-item {{ request()->routeIs('academics.*') ? 'active' : '' }}"
                   href="{{ route('academics.index') }}">Profiles</a>

                @auth
                    <a class="nav-link-item {{ request()->routeIs('admin.*') ? 'active' : '' }}"
                       href="{{ route('admin.academics.index') }}">Admin</a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="d-inline ms-1">
                        @csrf
                        <button type="submit" class="nav-logout-btn">
                            <i class="fa fa-sign-out-alt me-1"></i>Logout
                        </button>
                    </form>
                @else
                    <a class="nav-cta ms-2" href="{{ route('admin.login') }}">
                        <i class="fa fa-lock me-1"></i>Admin Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>
    @endif

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="flash-wrap mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2 text-gold"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="flash-wrap mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    @yield('content')

    <!-- ── Footer ─────────────────────────────────────────────── -->
    <footer class="site-footer">
        <div class="footer-inner">
            <div>
                <div class="footer-brand"><span>UTP</span>Web</div>
                <div class="mt-1">© {{ date('Y') }} Universiti Teknologi PETRONAS. All rights reserved.</div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery + DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Sticky nav shadow on scroll
        window.addEventListener('scroll', () => {
            document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 10);
        });
    </script>

    @yield('scripts')
</body>
</html>
