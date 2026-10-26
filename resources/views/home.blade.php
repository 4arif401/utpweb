@extends('layouts.app')

@section('title', 'Universiti Teknologi PETRONAS - Pure Research Portal')

@section('styles')
<style>
    /* ── Pure Portal Specific Theme ────────────────────────────── */
    :root {
        --pure-blue: #005691;
        --pure-blue-hover: #003b64;
        --pure-text-main: #222222;
        --pure-text-muted: #555555;
        --pure-bg-light: #f8fafc;
        --pure-border: #e2e8f0;
        --utp-teal: #008075;
        --utp-teal-light: #00a39d;
    }

    body {
        background: #ffffff;
        color: var(--pure-text-main);
    }

    /* ── Pure Portal White Header ──────────────────────────────── */
    .portal-header {
        background: #ffffff;
        border-bottom: 1px solid #e5e9f0;
        padding: 1rem 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .portal-header-inner {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
    }

    .portal-logo-link {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        transition: opacity 0.2s;
    }
    .portal-logo-link:hover {
        opacity: 0.9;
    }

    .portal-logo-img {
        height: 64px;
        width: auto;
        display: block;
    }

    .portal-nav-actions {
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }

    .portal-nav-link {
        color: #334155;
        font-weight: 600;
        font-size: 0.92rem;
        text-decoration: none;
        padding: 0.45rem 0.85rem;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .portal-nav-link:hover {
        color: var(--pure-blue);
        background: #f1f5f9;
    }
    .portal-nav-link.active {
        color: var(--pure-blue);
        background: #e0f2fe;
    }

    .portal-admin-btn {
        background: #0f172a;
        color: #ffffff !important;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 0.5rem 1.15rem;
        border-radius: 6px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background 0.2s, transform 0.15s;
    }
    .portal-admin-btn:hover {
        background: var(--pure-blue);
        transform: translateY(-1px);
        color: #ffffff;
    }

    /* ── Panoramic Campus Hero ─────────────────────────────────── */
    .portal-hero {
        position: relative;
        width: 100%;
        min-height: 480px;
        background-color: #0b1a2d;
        background-image: url('{{ asset('assets/img/utp-campus-banner.jpg') }}');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3.5rem 1.5rem;
    }

    .portal-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(10, 20, 35, 0.25) 0%, rgba(10, 20, 35, 0.45) 100%);
        pointer-events: none;
    }

    /* Floating Translucent Search Card (Pure Portal style) */
    .hero-search-card {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 660px;
        background: rgba(22, 30, 44, 0.78);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(255, 255, 255, 0.16);
        border-radius: 14px;
        padding: 2.25rem 2.5rem;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.45);
        color: #ffffff;
    }

    .hero-search-title {
        color: #ffffff;
        font-size: 1.7rem;
        font-weight: 400;
        text-align: center;
        margin-bottom: 1.4rem;
        letter-spacing: -0.3px;
        font-family: 'Inter', -apple-system, sans-serif;
    }

    /* Concept & Matching text Tabs */
    .search-mode-tabs {
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.94);
        border-radius: 6px 6px 0 0;
        overflow: hidden;
        margin-bottom: 0;
        border-bottom: 1px solid #cbd5e1;
    }

    .search-tab-btn {
        flex: 1;
        padding: 0.65rem 1rem;
        font-size: 0.88rem;
        font-weight: 600;
        color: #475569;
        background: #f1f5f9;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.2s;
        text-align: center;
    }

    .search-tab-btn:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    .search-tab-btn.active {
        background: #ffffff;
        color: #0f172a;
        box-shadow: inset 0 -2px 0 var(--pure-blue);
    }

    .tab-info-icon {
        font-size: 0.82rem;
        color: #64748b;
        cursor: help;
        transition: color 0.15s;
    }
    .tab-info-icon:hover {
        color: var(--pure-blue);
    }

    /* Input container */
    .search-form-wrap {
        background: #ffffff;
        border-radius: 0 0 6px 6px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .search-input-group {
        display: flex;
        align-items: center;
        position: relative;
        background: #ffffff;
    }

    .search-input-group input {
        width: 100%;
        border: none;
        outline: none;
        padding: 0.9rem 3.2rem 0.9rem 1.25rem;
        font-size: 0.98rem;
        color: #1e293b;
        background: transparent;
        font-family: inherit;
    }

    .search-input-group input::placeholder {
        color: #64748b;
        font-size: 0.92rem;
    }

    .search-submit-btn {
        position: absolute;
        right: 0.5rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #475569;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        cursor: pointer;
        border-radius: 50%;
        transition: color 0.2s, background 0.2s;
    }

    .search-submit-btn:hover {
        color: var(--pure-blue);
        background: #f1f5f9;
    }

    /* Advanced search link */
    .advanced-search-link {
        display: block;
        text-align: right;
        margin-top: 0.75rem;
        font-size: 0.82rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.88);
        text-decoration: underline;
        text-underline-offset: 3px;
        transition: color 0.2s;
    }
    .advanced-search-link:hover {
        color: #ffffff;
    }

    /* ── Horizontal Icons Bar (Pure Portal Style) ─────────────── */
    .portal-stats-bar {
        background: #ffffff;
        border-bottom: 1px solid #eef2f6;
        padding: 2.2rem 1.5rem 1.8rem;
    }

    .portal-stats-inner {
        max-width: 1320px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 3.5rem;
        flex-wrap: wrap;
    }

    /* Stat Item (Profiles) */
    .portal-stat-item {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        position: relative;
        group: hover;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        transition: transform 0.2s, background-color 0.2s;
    }

    .portal-stat-item:hover {
        transform: translateY(-3px);
        background-color: #f8fafc;
    }

    .stat-icon-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    .stat-main-icon {
        font-size: 2.3rem;
        color: #5c6779;
        transition: color 0.2s;
    }
    .portal-stat-item:hover .stat-main-icon {
        color: var(--pure-blue);
    }

    /* Dark badge displaying count */
    .stat-count-badge {
        position: absolute;
        top: -6px;
        right: -16px;
        background: #39424e;
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.15rem 0.45rem;
        border-radius: 4px;
        line-height: 1.1;
        letter-spacing: 0.3px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .stat-item-label {
        font-size: 0.92rem;
        font-weight: 600;
        color: var(--pure-blue);
        text-align: center;
        transition: color 0.2s;
    }
    .portal-stat-item:hover .stat-item-label {
        color: var(--pure-blue-hover);
        text-decoration: underline;
    }

    /* ── Main Portal Description Section ──────────────────────── */
    .portal-content-section {
        max-width: 1320px;
        margin: 0 auto;
        padding: 3rem 1.5rem 4rem;
    }

    .portal-title-block {
        margin-bottom: 2.5rem;
    }

    .portal-heading {
        font-size: 1.9rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1rem;
        letter-spacing: -0.4px;
    }

    .portal-lead-text {
        font-size: 1.05rem;
        line-height: 1.75;
        color: #475569;
        max-width: 1080px;
    }

    /* ── Research Domains Grid ────────────────────────────────── */
    .domains-section-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .domains-section-title i {
        color: var(--utp-teal);
    }

    .domains-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.25rem;
        margin-bottom: 3.5rem;
    }

    .domain-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1.5rem;
        transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
    }
    .domain-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 86, 145, 0.08);
        border-color: #94a3b8;
    }

    .domain-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        background: #e0f2fe;
        color: var(--pure-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }

    .domain-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.5rem;
    }

    .domain-desc {
        font-size: 0.85rem;
        color: #64748b;
        line-height: 1.5;
        margin-bottom: 1rem;
        flex: 1;
    }

    .domain-action {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--pure-blue);
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    /* ── Featured Scholars Section ────────────────────────────── */
    .scholars-preview-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .view-all-link {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--pure-blue);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .view-all-link:hover {
        text-decoration: underline;
    }

    .scholars-mini-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.25rem;
    }

    .scholar-mini-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.25rem;
        display: flex;
        gap: 1rem;
        align-items: center;
        text-decoration: none;
        color: inherit;
        transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    }
    .scholar-mini-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        border-color: #cbd5e1;
    }

    .scholar-mini-avatar {
        width: 68px;
        height: 68px;
        border-radius: 10px;
        object-fit: cover;
        background: #0f274a;
        flex-shrink: 0;
    }

    .scholar-mini-placeholder {
        width: 68px;
        height: 68px;
        border-radius: 10px;
        background: linear-gradient(135deg, #0e2a47, #1e3a6e);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .scholar-mini-info {
        flex: 1;
        min-width: 0;
    }

    .scholar-mini-name {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 0.2rem;
    }

    .scholar-mini-title {
        font-size: 0.78rem;
        color: #64748b;
        margin-bottom: 0.25rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .scholar-mini-dept {
        font-size: 0.76rem;
        color: var(--utp-teal);
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (max-width: 768px) {
        .portal-header-inner {
            flex-direction: column;
            align-items: flex-start;
        }
        .portal-nav-actions {
            width: 100%;
            justify-content: space-between;
        }
        .hero-search-card {
            padding: 1.5rem;
        }
        .hero-search-title {
            font-size: 1.35rem;
        }
        .portal-stats-inner {
            gap: 2rem;
        }
    }
</style>
@endsection

@section('navbar')
<!-- ── Custom Pure Portal Header ──────────────────────────────── -->
<header class="portal-header">
    <div class="portal-header-inner">
        <a href="{{ route('home') }}" class="portal-logo-link" title="Universiti Teknologi PETRONAS Pure Portal">
            <img src="{{ asset('assets/img/utp-logo.svg') }}" alt="Universiti Teknologi PETRONAS" class="portal-logo-img">
        </a>

        <div class="portal-nav-actions">
            <a href="{{ route('home') }}" class="portal-nav-link active">Home</a>
            <a href="{{ route('academics.index') }}" class="portal-nav-link">Profiles</a>

            @auth
                <a href="{{ route('admin.academics.index') }}" class="portal-nav-link">
                    <i class="fa fa-tachometer-alt me-1"></i>Admin Dashboard
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="portal-admin-btn">
                        <i class="fa fa-sign-out-alt"></i>Logout
                    </button>
                </form>
            @else
                <a href="{{ route('admin.login') }}" class="portal-admin-btn">
                    <i class="fa fa-lock"></i>Admin Login
                </a>
            @endauth
        </div>
    </div>
</header>
@endsection

@section('content')

<!-- ── Panoramic Campus Hero with Floating Search ─────────────── -->
<section class="portal-hero">
    <div class="hero-search-card fade-up">
        <h1 class="hero-search-title">Welcome to Universiti Teknologi PETRONAS</h1>

        <!-- Search Mode Tabs (Concept / Matching text) -->
        <div class="search-mode-tabs" role="tablist">
            <button type="button" 
                    class="search-tab-btn active" 
                    id="tabConcept" 
                    onclick="switchSearchMode('concept')"
                    title="Search by research concepts, fingerprint tags, and subject terms">
                Concept 
                <span class="tab-info-icon" data-bs-toggle="tooltip" title="Search by indexed scientific concepts, fingerprint topics, and expertise terms">
                    <i class="fa fa-info-circle"></i>
                </span>
            </button>
            <button type="button" 
                    class="search-tab-btn" 
                    id="tabMatching" 
                    onclick="switchSearchMode('matching')"
                    title="Search by matching keyword text in names, departments, and titles">
                Matching text 
                <span class="tab-info-icon" data-bs-toggle="tooltip" title="Search by exact keyword text in scholar names, departments, publications, and profiles">
                    <i class="fa fa-info-circle"></i>
                </span>
            </button>
        </div>

        <!-- Search Input Bar -->
        <div class="search-form-wrap">
            <form action="{{ route('academics.index') }}" method="GET" id="portalSearchForm">
                <div class="search-input-group">
                    <input type="text" 
                           name="q" 
                           id="portalSearchInput" 
                           placeholder="Search in concepts at Universiti Teknologi PETRONAS" 
                           autocomplete="off"
                           required>
                    <button type="submit" class="search-submit-btn" aria-label="Search">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Advanced Search Link -->
        <a href="{{ route('academics.index') }}" class="advanced-search-link">
            Advanced search
        </a>
    </div>
</section>

<!-- ── Horizontal Stats Bar (Profiles only as requested) ─────── -->
<section class="portal-stats-bar">
    <div class="portal-stats-inner">
        <!-- Profiles Link (Direct to current home page / academics directory) -->
        <a href="{{ route('academics.index') }}" class="portal-stat-item" title="Browse academic and researcher profiles">
            <div class="stat-icon-wrapper">
                <i class="fa-solid fa-user-group stat-main-icon"></i>
                <span class="stat-count-badge">{{ $profilesCount }}</span>
            </div>
            <span class="stat-item-label">Profiles</span>
        </a>
    </div>
</section>

<!-- ── Pure Portal Content & Overview ────────────────────────── -->
<main class="portal-content-section">
    <div class="portal-title-block">
        <h2 class="portal-heading">Universiti Teknologi PETRONAS's Pure Portal</h2>
        <p class="portal-lead-text">
            Universiti Teknologi PETRONAS's research initiatives are founded on our dedication to solving real-world problems, 
            advancing knowledge, and promoting the well-being of local, regional, and global populations. Through collaboration 
            in domains such as energy transition, sustainable engineering, smart technologies, advanced materials, and 
            digital innovation, our researchers aspire to generate breakthrough discoveries that foster long-term, beneficial change.
        </p>
    </div>

    <!-- Research Focus & Domains -->
    <h3 class="domains-section-title">
        <i class="fa-solid fa-microscope"></i>
        Key Research Domains &amp; Institutes
    </h3>
    <div class="domains-grid">
        <a href="{{ route('academics.index', ['q' => 'Energy']) }}" class="domain-card">
            <div class="domain-icon-box">
                <i class="fa-solid fa-bolt-lightning"></i>
            </div>
            <div class="domain-title">Energy Transition &amp; Net Zero</div>
            <div class="domain-desc">
                Leading innovations in renewable energy, carbon capture, hydrogen systems, and sustainable power technologies.
            </div>
            <div class="domain-action">Explore Experts <i class="fa fa-arrow-right ms-1"></i></div>
        </a>

        <a href="{{ route('academics.index', ['q' => 'Nanotechnology']) }}" class="domain-card">
            <div class="domain-icon-box" style="background:#e0f7f6; color:var(--utp-teal);">
                <i class="fa-solid fa-atom"></i>
            </div>
            <div class="domain-title">Nanotechnology &amp; Advanced Materials</div>
            <div class="domain-desc">
                Pioneering nanoscale semiconductors, thin-film devices, smart catalysts, and functional polymeric materials.
            </div>
            <div class="domain-action">Explore Experts <i class="fa fa-arrow-right ms-1"></i></div>
        </a>

        <a href="{{ route('academics.index', ['q' => 'Smart']) }}" class="domain-card">
            <div class="domain-icon-box" style="background:#fef3c7; color:#b45309;">
                <i class="fa-solid fa-brain"></i>
            </div>
            <div class="domain-title">Smart Engineering &amp; AI Systems</div>
            <div class="domain-desc">
                Integrating digital twin intelligence, autonomous robotic systems, machine learning, and IoT sensor networks.
            </div>
            <div class="domain-action">Explore Experts <i class="fa fa-arrow-right ms-1"></i></div>
        </a>

        <a href="{{ route('academics.index', ['q' => 'Sustainable']) }}" class="domain-card">
            <div class="domain-icon-box" style="background:#ecfdf5; color:#059669;">
                <i class="fa-solid fa-leaf"></i>
            </div>
            <div class="domain-title">Sustainable Living &amp; Environment</div>
            <div class="domain-desc">
                Advancing green infrastructure, water resource preservation, environmental remediation, and circular economy.
            </div>
            <div class="domain-action">Explore Experts <i class="fa fa-arrow-right ms-1"></i></div>
        </a>
    </div>

    <!-- Featured Scholars Preview -->
    @if($featuredScholars->isNotEmpty())
    <div class="scholars-preview-header">
        <div>
            <h3 class="domains-section-title mb-1">
                <i class="fa-solid fa-users"></i>
                Featured UTP Researchers
            </h3>
            <p class="text-muted small mb-0">Discover leading faculty members and experts making a global scientific impact</p>
        </div>
        <a href="{{ route('academics.index') }}" class="view-all-link">
            View All {{ $profilesCount }} Profiles <i class="fa fa-arrow-right"></i>
        </a>
    </div>

    <div class="scholars-mini-grid">
        @foreach($featuredScholars as $scholar)
        <a href="{{ route('academics.show', $scholar->slug) }}" class="scholar-mini-card">
            @if($scholar->photo)
                <img src="{{ asset('storage/' . $scholar->photo) }}" alt="{{ $scholar->name }}" class="scholar-mini-avatar">
            @else
                <div class="scholar-mini-placeholder">
                    <i class="fa fa-user"></i>
                </div>
            @endif
            <div class="scholar-mini-info">
                <div class="scholar-mini-name">{{ $scholar->name }}</div>
                @if($scholar->title)
                    <div class="scholar-mini-title">{{ $scholar->title }}</div>
                @endif
                <div class="scholar-mini-dept">
                    {{ $scholar->department ?? $scholar->institute ?? 'Universiti Teknologi PETRONAS' }}
                </div>
                @if($scholar->scopus_citations)
                    <div class="text-muted mt-1" style="font-size:0.75rem;">
                        <i class="fa fa-quote-right me-1 text-secondary"></i> {{ number_format($scholar->scopus_citations) }} Citations
                    </div>
                @endif
            </div>
        </a>
        @endforeach
    </div>
    @endif
</main>

@endsection

@section('scripts')
<script>
    // Tab mode switcher for Concept vs Matching text
    function switchSearchMode(mode) {
        const btnConcept = document.getElementById('tabConcept');
        const btnMatching = document.getElementById('tabMatching');
        const searchInput = document.getElementById('portalSearchInput');

        if (mode === 'concept') {
            btnConcept.classList.add('active');
            btnMatching.classList.remove('active');
            searchInput.placeholder = 'Search in concepts at Universiti Teknologi PETRONAS';
        } else {
            btnMatching.classList.add('active');
            btnConcept.classList.remove('active');
            searchInput.placeholder = 'Search in names, departments, publications at UTP';
        }
        searchInput.focus();
    }

    // Initialize Bootstrap tooltips
    document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection
