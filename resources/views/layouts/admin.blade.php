<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — UTPWeb</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --navy: #0d1b3e; --navy-mid: #1a2f5a;
            --gold: #c9a227; --gold-light: #e6bb41;
            --sidebar-w: 240px;
        }
        body { font-family: 'Inter', sans-serif; background: #f0f3fa; }
        .admin-sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--navy);
            position: fixed; top: 0; left: 0;
            z-index: 100;
            display: flex; flex-direction: column;
        }
        .sidebar-brand {
            padding: 1.3rem 1.2rem;
            border-bottom: 1px solid rgba(255,255,255,.08);
            font-size: 1.2rem; font-weight: 700; color: #fff;
            text-decoration: none;
        }
        .sidebar-brand span { color: var(--gold); }
        .sidebar-label {
            font-size: .68rem;
            color: rgba(255,255,255,.35);
            text-transform: uppercase;
            letter-spacing: .8px;
            padding: .9rem 1.2rem .3rem;
        }
        .sidebar-link {
            display: flex; align-items: center; gap: 10px;
            padding: .6rem 1.2rem;
            color: rgba(255,255,255,.7);
            text-decoration: none;
            font-size: .87rem;
            border-left: 3px solid transparent;
            transition: all .2s;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background: rgba(255,255,255,.06);
            color: var(--gold-light);
            border-left-color: var(--gold);
        }
        .sidebar-link i { width: 16px; text-align: center; }
        .sidebar-footer {
            margin-top: auto;
            padding: 1rem 1.2rem;
            border-top: 1px solid rgba(255,255,255,.08);
            font-size: .78rem;
            color: rgba(255,255,255,.4);
        }
        .admin-main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
        }
        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid #e5e9f0;
            padding: .8rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
        .admin-topbar .page-title { font-weight: 700; color: var(--navy); font-size: 1.05rem; }
        .admin-topbar .user-pill {
            display: flex; align-items: center; gap: 8px;
            font-size: .84rem; color: var(--navy);
        }
        .admin-topbar .user-pill .avatar {
            width: 32px; height: 32px;
            background: var(--navy);
            color: #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .8rem; font-weight: 600;
        }
        .admin-content { padding: 1.5rem; }

        /* Table */
        table.dataTable thead th,
        table.dataTable thead td {
            background: var(--navy) !important;
            color: #fff !important;
            font-size: .78rem;
            font-weight: 600 !important;
            letter-spacing: .3px;
            text-transform: uppercase;
            padding: .85rem 1rem !important;
            border: none !important;
        }
        table.dataTable thead .dt-column-title { color: #fff !important; }
        table.dataTable tbody tr:hover { background: #f0f4ff; }
        table.dataTable td { font-size: .86rem; vertical-align: middle; }


        /* Form */
        .section-card {
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
            margin-bottom: 1.25rem;
        }
        .section-card .card-header {
            background: var(--navy);
            color: #fff;
            padding: .65rem 1rem;
            border-radius: 8px 8px 0 0;
            font-weight: 600;
            font-size: .84rem;
        }
        .section-card .card-body { padding: 1.2rem; }
        .form-label { font-weight: 500; font-size: .85rem; color: var(--navy); }
        .form-control, .form-select {
            border-radius: 7px;
            border-color: #dde3ee;
            font-size: .87rem;
            padding: .5rem .8rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,162,39,.15);
        }
        .form-text { font-size: .75rem; }
        .btn-primary-custom {
            background: var(--navy); color: #fff;
            border: none; border-radius: 7px;
            padding: .5rem 1.2rem; font-weight: 600;
            font-size: .88rem; transition: background .2s;
        }
        .btn-primary-custom:hover { background: var(--gold); color: #fff; }
        .text-gold { color: var(--gold) !important; }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    <div class="admin-sidebar">
        <a class="sidebar-brand" href="{{ route('admin.academics.index') }}">
            <span>UTP</span>Web Admin
        </a>
        <div class="sidebar-label">Management</div>
        <a class="sidebar-link {{ request()->routeIs('admin.academics.index') ? 'active' : '' }}"
           href="{{ route('admin.academics.index') }}">
            <i class="fa fa-users"></i> Scholars
        </a>
        <a class="sidebar-link {{ request()->routeIs('admin.academics.create') ? 'active' : '' }}"
           href="{{ route('admin.academics.create') }}">
            <i class="fa fa-plus-circle"></i> Add Scholar
        </a>
        <div class="sidebar-label">Public Site</div>
        <a class="sidebar-link" href="{{ route('academics.index') }}" target="_blank">
            <i class="fa fa-external-link-alt"></i> View Directory
        </a>
        <div class="sidebar-footer">
            <div class="d-flex align-items-center justify-content-between">
                <span><i class="fa fa-user-circle me-1"></i> {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:rgba(255,255,255,.4);font-size:.75rem;cursor:pointer;">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main -->
    <div class="admin-main">
        <div class="admin-topbar">
            <div class="page-title">@yield('page-title', 'Dashboard')</div>
            <div class="user-pill">
                <div class="avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                {{ auth()->user()->name }}
            </div>
        </div>

        <div class="admin-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-left:4px solid var(--gold);">
                    <i class="fa fa-check-circle me-1"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-1"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
    @yield('scripts')
</body>
</html>
