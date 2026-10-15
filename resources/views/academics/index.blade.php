@extends('layouts.app')

@section('title', 'UTP Expert & Scholars Directory')

@section('styles')
<style>
    /* ── Hero ────────────────────────────────────────────────── */
    .hero {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 60%, #1a3d6e 100%);
        padding: 4rem 0 3.5rem;
        position: relative;
        overflow: hidden;
    }
    .hero::before {
        content: '';
        position: absolute; inset: 0;
        background:
            radial-gradient(ellipse 60% 70% at 80% 50%, rgba(201,162,39,.12) 0%, transparent 70%),
            radial-gradient(ellipse 40% 60% at 10% 80%, rgba(30,50,96,.6) 0%, transparent 60%);
        pointer-events: none;
    }
    .hero::after {
        content: '';
        position: absolute; bottom: 0; left: 0; right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(201,162,39,.4), transparent);
    }
    .hero-inner {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 1.5rem;
        position: relative;
        z-index: 1;
    }
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(201,162,39,.15);
        border: 1px solid rgba(201,162,39,.3);
        color: var(--gold-light);
        font-size: .75rem;
        font-weight: 600;
        letter-spacing: .5px;
        text-transform: uppercase;
        padding: .35rem .8rem;
        border-radius: 100px;
        margin-bottom: 1.2rem;
    }
    .hero-title {
        font-size: 2.6rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: -.5px;
        line-height: 1.15;
        margin-bottom: .8rem;
    }
    .hero-title span { color: var(--gold); }
    .hero-subtitle {
        color: rgba(255,255,255,.55);
        font-size: 1rem;
        max-width: 520px;
        line-height: 1.65;
        margin-bottom: 2rem;
    }
    .hero-stats {
        display: flex;
        gap: 2.5rem;
    }
    .hero-stat-num {
        font-size: 1.8rem;
        font-weight: 800;
        color: #fff;
        line-height: 1;
    }
    .hero-stat-label {
        font-size: .75rem;
        color: rgba(255,255,255,.45);
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-top: .25rem;
    }
    .hero-divider {
        width: 1px;
        background: rgba(255,255,255,.12);
        align-self: stretch;
    }

    /* ── Main Content ────────────────────────────────────────── */
    .content-wrap {
        max-width: 1320px;
        margin: 0 auto;
        padding: 2.5rem 1.5rem 1rem;
    }

    /* ── Table Card ──────────────────────────────────────────── */
    .table-card {
        background: var(--card);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-md);
        overflow: hidden;
    }
    .table-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.1rem 1.4rem;
        border-bottom: 1px solid var(--border);
        background: #fafbff;
    }
    .table-card-title {
        font-weight: 700;
        font-size: .92rem;
        color: var(--navy);
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .table-card-title .icon-dot {
        width: 8px; height: 8px;
        background: var(--gold);
        border-radius: 50%;
    }
    .table-count {
        background: var(--navy);
        color: #fff;
        font-size: .72rem;
        font-weight: 700;
        padding: .2rem .6rem;
        border-radius: 100px;
        letter-spacing: .3px;
    }

    /* ── Scholar Name Link ───────────────────────────────────── */
    .scholar-name {
        font-weight: 600;
        color: var(--navy);
        font-size: .9rem;
    }
    .scholar-title-badge {
        color: var(--navy);
        font-size: .83rem;
        font-weight: 500;
    }

    .dept-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: .8rem;
        color: var(--text-muted);
    }

    .profile-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: .78rem;
        font-weight: 600;
        color: var(--navy);
        background: var(--gold-pale);
        border: 1px solid rgba(201,162,39,.35);
        border-radius: 6px;
        padding: .35rem .8rem;
        text-decoration: none;
        transition: background .2s, color .2s, border-color .2s, transform .15s;
        white-space: nowrap;
    }
    .profile-btn:hover {
        background: var(--gold);
        color: var(--navy);
        border-color: var(--gold);
        transform: translateY(-1px);
    }
    .profile-btn i { font-size: .7rem; }

    /* ── Empty state ─────────────────────────────────────────── */
    .empty-state {
        text-align: center;
        padding: 4rem 1rem;
        color: var(--text-muted);
    }
    .empty-state .empty-icon {
        font-size: 3rem;
        color: var(--border);
        margin-bottom: 1rem;
    }
    .empty-state p { font-size: .9rem; margin: 0; }
</style>
@endsection

@section('content')

<!-- ── Hero Section ────────────────────────────────────────── -->
<div class="hero">
    <div class="hero-inner fade-up">
        <div class="hero-badge">
            <i class="fa fa-graduation-cap"></i>
            Academic Directory
        </div>
        <h1 class="hero-title">UTP <span>Expert</span> &amp;<br>Scholars Directory</h1>
        <p class="hero-subtitle">Browse and discover our academic experts and researchers at Universiti Teknologi PETRONAS.</p>
        <div class="hero-stats">
            <div>
                <div class="hero-stat-num">{{ $academics->count() }}</div>
                <div class="hero-stat-label">Scholars</div>
            </div>
            <div class="hero-divider"></div>
            <div>
                <div class="hero-stat-num">{{ $academics->pluck('department')->unique()->filter()->count() }}</div>
                <div class="hero-stat-label">Departments</div>
            </div>
            <div class="hero-divider"></div>
            <div>
                <div class="hero-stat-num">{{ $academics->pluck('institute')->unique()->filter()->count() }}</div>
                <div class="hero-stat-label">Institutes</div>
            </div>
        </div>
    </div>
</div>

<!-- ── Table Section ───────────────────────────────────────── -->
<div class="content-wrap">
    <div class="table-card fade-up" style="animation-delay:.1s">
        <div class="table-card-header">
            <div class="table-card-title">
                <div class="icon-dot"></div>
                All Scholars
                <span class="table-count">{{ $academics->count() }}</span>
            </div>
        </div>

        @if($academics->isEmpty())
            <div class="empty-state">
                <div class="empty-icon"><i class="fa fa-users"></i></div>
                <p>No scholars found. <a href="{{ route('admin.login') }}" class="text-gold">Add the first scholar →</a></p>
            </div>
        @else
        <div class="table-responsive">
            <table id="academicsTable" class="table mb-0" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 40px;">#</th>
                        <th>Name</th>
                        <th>Position / Title</th>
                        <th>Department</th>
                        <th>Institute</th>
                        <th>Centre</th>
                        <th style="width:120px;">Profile</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($academics as $i => $academic)
                        <tr>
                            <td class="text-muted" style="font-size:.78rem;">{{ $i + 1 }}</td>
                            <td>
                                <div class="scholar-name">{{ $academic->name }}</div>
                            </td>
                            <td>
                                @if($academic->title)
                                    <span class="scholar-title-badge">{{ $academic->title }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @if($academic->department)
                                    <span class="dept-chip">{{ $academic->department }}</span>
                                @else
                                    <span class="text-muted" style="font-size:.82rem;">—</span>
                                @endif
                            </td>
                            <td style="font-size:.83rem; color:var(--text-muted);">{{ $academic->institute ?? '—' }}</td>
                            <td style="font-size:.83rem; color:var(--text-muted);">{{ $academic->centre ?? '—' }}</td>
                            <td>
                                <a href="{{ route('academics.show', $academic->slug) }}" class="profile-btn">
                                    View Profile <i class="fa fa-arrow-right"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('#academicsTable').DataTable({
        pageLength: 15,
        language: {
            search: '',
            searchPlaceholder: 'Search scholars...',
            lengthMenu: 'Show _MENU_',
        },
        columnDefs: [
            { orderable: false, targets: 5 }
        ],
        dom: "<'d-flex align-items-center justify-content-between px-3 py-2'lf>" +
             "<'table-responsive't>" +
             "<'d-flex align-items-center justify-content-between px-3 py-2'ip>",
    });
});
</script>
@endsection
