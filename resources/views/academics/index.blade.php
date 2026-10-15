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

    /* ── Toolbar ─────────────────────────────────────────────── */
    .scholars-toolbar {
        display: flex;
        align-items: center;
        gap: .75rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }
    .search-box {
        position: relative;
        flex: 1;
        min-width: 200px;
    }
    .search-box i {
        position: absolute;
        left: .9rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: .82rem;
        pointer-events: none;
    }
    .search-box input {
        width: 100%;
        padding: .55rem .9rem .55rem 2.2rem;
        border-radius: 8px;
        border: 1px solid var(--border);
        background: var(--card);
        color: var(--text);
        font-size: .88rem;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }
    .search-box input:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201,162,39,.12);
    }
    .filter-select {
        padding: .55rem .9rem;
        border-radius: 8px;
        border: 1px solid var(--border);
        background: var(--card);
        color: var(--text);
        font-size: .85rem;
        outline: none;
        cursor: pointer;
        transition: border-color .2s;
        min-width: 180px;
    }
    .filter-select:focus { border-color: var(--gold); }
    .scholars-meta {
        font-size: .8rem;
        color: var(--text-muted);
        margin-left: auto;
        white-space: nowrap;
    }
    .scholars-meta span {
        font-weight: 700;
        color: var(--navy);
    }

    /* ── Staff Card Grid ─────────────────────────────────────── */
    .staff-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    @media (max-width: 900px) { .staff-grid { grid-template-columns: 1fr; } }

    .staff-card {
        display: flex;
        align-items: stretch;
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        transition: transform .2s, box-shadow .2s, border-color .2s;
        cursor: default;
    }
    .staff-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(10,25,60,.12);
        border-color: rgba(201,162,39,.4);
    }

    /* Photo column */
    .staff-card {
        min-height: 140px;
    }
    .staff-photo-col {
        flex-shrink: 0;
        width: 110px;
        min-height: 140px;
        background: linear-gradient(160deg, #0d2447 0%, #1e3a6e 100%);
        position: relative;
        overflow: hidden;
        align-self: stretch;
    }
    .staff-photo-col img {
        width: 100%;
        height: 100%;
        min-height: 140px;
        object-fit: cover;
        object-position: top center;
        display: block;
        transition: transform .35s;
    }
    .staff-card:hover .staff-photo-col img { transform: scale(1.04); }
    .staff-photo-placeholder {
        width: 100%;
        height: 100%;
        min-height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.4rem;
        color: rgba(201,162,39,.45);
    }
    /* gold accent bar on photo left edge */
    .staff-photo-col::before {
        content: '';
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 3px;
        background: linear-gradient(180deg, var(--gold), rgba(201,162,39,.3));
        z-index: 1;
    }

    /* Info column */
    .staff-info {
        padding: 1rem 1.1rem;
        display: flex;
        flex-direction: column;
        gap: .25rem;
        flex: 1;
        min-width: 0;
    }
    .staff-name {
        font-size: .97rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.3;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .staff-position {
        font-size: .8rem;
        color: var(--text-muted);
        font-weight: 500;
        line-height: 1.4;
    }
    .staff-dept {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: .78rem;
        color: var(--text-muted);
        margin-top: .1rem;
    }
    .staff-dept i { color: var(--gold); font-size: .72rem; }
    .staff-email {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: .78rem;
        color: var(--gold);
        text-decoration: none;
        margin-top: .15rem;
        word-break: break-all;
        transition: color .15s;
    }
    .staff-email:hover { color: var(--navy); text-decoration: underline; }
    .staff-email i { font-size: .72rem; flex-shrink: 0; }
    .staff-footer {
        margin-top: auto;
        padding-top: .5rem;
    }
    .profile-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: .75rem;
        font-weight: 600;
        color: var(--navy);
        background: var(--gold-pale);
        border: 1px solid rgba(201,162,39,.35);
        border-radius: 6px;
        padding: .3rem .75rem;
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
    .profile-btn i { font-size: .68rem; }

    /* ── No results ──────────────────────────────────────────── */
    .no-results {
        grid-column: 1/-1;
        text-align: center;
        padding: 4rem 1rem;
        color: var(--text-muted);
    }
    .no-results i { font-size: 2.5rem; color: var(--border); display: block; margin-bottom: .75rem; }

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

<!-- ── Staff Directory Section ────────────────────────────── -->
<div class="content-wrap">

    @if($academics->isEmpty())
        <div class="empty-state fade-up">
            <div class="empty-icon"><i class="fa fa-users"></i></div>
            <p>No scholars found. <a href="{{ route('admin.login') }}" class="text-gold">Add the first scholar →</a></p>
        </div>
    @else

    {{-- Toolbar --}}
    <div class="scholars-toolbar fade-up" style="animation-delay:.05s">
        <div class="search-box">
            <i class="fa fa-search"></i>
            <input type="text" id="staffSearch" placeholder="Search by name, department, institute…" autocomplete="off">
        </div>
        @php
            $deptCounts  = $academics->countBy('department');
            $titleCounts = $academics->countBy('title');
        @endphp
        <select id="deptFilter" class="filter-select">
            <option value="">All Departments ({{ $academics->count() }})</option>
            @foreach($academics->pluck('department')->unique()->filter()->sort()->values() as $dept)
                <option value="{{ $dept }}">{{ $dept }} ({{ $deptCounts[$dept] ?? 0 }})</option>
            @endforeach
        </select>
        <select id="titleFilter" class="filter-select">
            <option value="">All Positions ({{ $academics->count() }})</option>
            @foreach($academics->pluck('title')->unique()->filter()->sort()->values() as $pos)
                <option value="{{ $pos }}">{{ $pos }} ({{ $titleCounts[$pos] ?? 0 }})</option>
            @endforeach
        </select>
        <div class="scholars-meta">Showing <span id="visibleCount">{{ $academics->count() }}</span> of {{ $academics->count() }} scholars</div>
    </div>

    {{-- Staff Card Grid --}}
    <div class="staff-grid fade-up" id="staffGrid" style="animation-delay:.1s">
        @foreach($academics as $academic)
        <div class="staff-card"
             data-name="{{ strtolower($academic->name) }}"
             data-dept="{{ $academic->department }}"
             data-institute="{{ strtolower($academic->institute ?? '') }}"
             data-title="{{ strtolower($academic->title ?? '') }}">

            {{-- Photo --}}
            <div class="staff-photo-col">
                @if($academic->photo)
                    <img src="{{ asset('storage/' . $academic->photo) }}" alt="{{ $academic->name }}" loading="lazy">
                @else
                    <div class="staff-photo-placeholder">
                        <i class="fa fa-user"></i>
                    </div>
                @endif
            </div>

            {{-- Info --}}
            <div class="staff-info">
                <div class="staff-name">{{ $academic->name }}</div>

                @if($academic->title)
                    <div class="staff-position">{{ $academic->title }}</div>
                @endif

                @if($academic->department)
                    <div class="staff-dept">
                        <i class="fa fa-building"></i>
                        {{ $academic->department }}
                    </div>
                @endif

                @if($academic->institute)
                    <div class="staff-dept">
                        <i class="fa fa-university"></i>
                        {{ $academic->institute }}
                    </div>
                @endif

                @if($academic->email)
                    <a href="mailto:{{ $academic->email }}" class="staff-email">
                        <i class="fa fa-envelope"></i>
                        {{ $academic->email }}
                    </a>
                @endif

                <div class="staff-footer">
                    <a href="{{ route('academics.show', $academic->slug) }}" class="profile-btn">
                        View Profile <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach

        <div class="no-results" id="noResults" style="display:none;">
            <i class="fa fa-search"></i>
            No scholars match your search. Try a different keyword.
        </div>
    </div>
    @endif

</div>

@endsection

@section('scripts')
<script>
(function () {
    const searchInput = document.getElementById('staffSearch');
    const deptSelect  = document.getElementById('deptFilter');
    const titleSelect = document.getElementById('titleFilter');
    const grid        = document.getElementById('staffGrid');
    const noResults   = document.getElementById('noResults');
    const counter     = document.getElementById('visibleCount');
    if (!searchInput) return;

    function filter() {
        const q     = searchInput.value.toLowerCase().trim();
        const dept  = deptSelect.value;
        const title = titleSelect.value;
        let shown   = 0;

        grid.querySelectorAll('.staff-card').forEach(card => {
            const matchQ = !q ||
                card.dataset.name.includes(q) ||
                card.dataset.dept.toLowerCase().includes(q) ||
                card.dataset.institute.includes(q) ||
                card.dataset.title.includes(q);
            const matchDept  = !dept  || card.dataset.dept  === dept;
            const matchTitle = !title || card.dataset.title === title;

            if (matchQ && matchDept && matchTitle) {
                card.style.display = '';
                shown++;
            } else {
                card.style.display = 'none';
            }
        });

        if (counter) counter.textContent = shown;
        noResults.style.display = shown === 0 ? 'block' : 'none';
    }

    searchInput.addEventListener('input', filter);
    deptSelect.addEventListener('change', filter);
    titleSelect.addEventListener('change', filter);
})();
</script>
@endsection
