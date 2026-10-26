@extends('layouts.app')

@section('title', $academic->name . ' — UTP KnowledgeHub')

@section('styles')
<style>
    /* ── Profile Hero ───────────────────────────────────────── */
    .profile-hero {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 100%);
        padding: 3rem 0 6rem;
        position: relative;
        overflow: hidden;
    }
    .profile-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse 50% 80% at 85% 50%, rgba(201,162,39,.1) 0%, transparent 70%);
        pointer-events: none;
    }
    .profile-hero-inner {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 1.5rem;
        position: relative;
        z-index: 1;
    }
    .breadcrumb-nav {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: .78rem;
        color: rgba(255,255,255,.45);
        margin-bottom: 1.5rem;
    }
    .breadcrumb-nav a {
        color: rgba(255,255,255,.45);
        text-decoration: none;
        transition: color .2s;
    }
    .breadcrumb-nav a:hover { color: var(--gold-light); }
    .breadcrumb-nav .sep { font-size: .65rem; }
    .breadcrumb-nav .current { color: var(--gold-light); }

    .hero-profile-row {
        display: flex;
        align-items: flex-end;
        gap: 2rem;
    }
    .hero-photo-wrap {
        flex-shrink: 0;
    }
    .hero-photo {
        width: 110px; height: 130px;
        object-fit: cover;
        border-radius: var(--radius);
        border: 3px solid rgba(201,162,39,.6);
        box-shadow: 0 8px 32px rgba(0,0,0,.3);
    }
    .hero-photo-placeholder {
        width: 110px; height: 130px;
        border-radius: var(--radius);
        border: 3px solid rgba(201,162,39,.4);
        background: rgba(255,255,255,.06);
        display: flex; align-items: center; justify-content: center;
        color: rgba(255,255,255,.3);
        font-size: 3rem;
    }
    .hero-info { flex: 1; }
    .hero-label {
        font-size: .72rem;
        font-weight: 600;
        letter-spacing: .8px;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: .4rem;
    }
    .hero-name {
        font-size: 2rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: -.5px;
        line-height: 1.15;
        margin-bottom: .6rem;
    }
    .hero-meta {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
    }
    .hero-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: .78rem;
        color: rgba(255,255,255,.65);
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 100px;
        padding: .25rem .75rem;
    }
    .hero-chip i { font-size: .7rem; color: var(--gold); }

    /* ── Body Layout ─────────────────────────────────────────── */
    .profile-body {
        max-width: 1320px;
        margin: -3.5rem auto 0;
        padding: 0 1.5rem 2rem;
        position: relative;
        z-index: 2;
    }
    .profile-grid {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 1.5rem;
        align-items: start;
    }

    /* ── Sidebar Cards ───────────────────────────────────────── */
    .side-card {
        background: var(--card);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        margin-bottom: 1rem;
    }
    .side-card-header {
        background: var(--navy);
        color: rgba(255,255,255,.9);
        padding: .65rem 1rem;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .5px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .side-card-header i { color: var(--gold); font-size: .75rem; }
    .side-card-body { padding: 1rem; }

    /* Contact block */
    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: .7rem;
        padding: .55rem 0;
        border-bottom: 1px solid var(--border);
        font-size: .84rem;
    }
    .contact-item:last-child { border: none; padding-bottom: 0; }
    .contact-item .ci-icon {
        width: 28px; height: 28px;
        background: var(--gold-pale);
        border-radius: 6px;
        display: flex; align-items: center; justify-content: center;
        color: var(--gold);
        font-size: .72rem;
        flex-shrink: 0;
        margin-top: 1px;
    }
    .contact-item .ci-label { font-size: .7rem; color: var(--text-light); font-weight: 500; margin-bottom: 1px; }
    .contact-item .ci-value { color: var(--text-main); line-height: 1.45; }
    .contact-item a { color: var(--gold); text-decoration: none; }
    .contact-item a:hover { text-decoration: underline; }

    /* Metric rows */
    .metric-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: .5rem 0;
        border-bottom: 1px dashed var(--border);
        font-size: .82rem;
    }
    .metric-row:last-child { border: none; padding-bottom: 0; }
    .metric-row .m-label { color: var(--text-muted); }
    .metric-row .m-val {
        font-weight: 700;
        color: var(--navy);
        font-variant-numeric: tabular-nums;
    }
    .metric-row .m-link { color: var(--gold); font-size: .78rem; text-decoration: none; }
    .metric-row .m-link:hover { text-decoration: underline; }

    /* List items */
    .list-items { list-style: none; margin: 0; padding: 0; }
    .list-item {
        display: flex;
        gap: .6rem;
        align-items: flex-start;
        padding: .45rem 0;
        border-bottom: 1px solid var(--border);
        font-size: .82rem;
        color: var(--text-main);
        line-height: 1.4;
    }
    .list-item:last-child { border: none; }
    .list-item i { color: var(--gold); font-size: .7rem; margin-top: .22rem; flex-shrink: 0; }

    /* ── Right Column ────────────────────────────────────────── */
    .info-card {
        background: var(--card);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        margin-bottom: 1rem;
    }
    .info-card-header {
        padding: .8rem 1.2rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .info-card-title {
        font-weight: 700;
        font-size: .88rem;
        color: var(--navy);
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .info-card-title i { color: var(--gold); font-size: .85rem; }

    .info-table { width: 100%; }
    .info-row {
        display: flex;
        padding: .7rem 1.2rem;
        border-bottom: 1px solid var(--border);
        align-items: flex-start;
        gap: 1rem;
    }
    .info-row:last-child { border: none; }
    .info-label {
        font-weight: 600;
        color: var(--text-muted);
        font-size: .78rem;
        text-transform: uppercase;
        letter-spacing: .3px;
        min-width: 130px;
        padding-top: .1rem;
        flex-shrink: 0;
    }
    .info-value { font-size: .88rem; flex: 1; color: var(--text-main); line-height: 1.55; }
    .info-value.highlighted { color: var(--navy); font-weight: 600; font-size: .95rem; }

    /* Specialization pills */
    .spec-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #f0f3fc;
        border: 1px solid #dde3f5;
        color: var(--navy-mid);
        font-size: .75rem;
        font-weight: 500;
        padding: .25rem .7rem;
        border-radius: 100px;
        margin: .2rem .2rem .2rem 0;
    }
    .spec-pill::before {
        content: '';
        width: 5px; height: 5px;
        border-radius: 50%;
        background: var(--gold);
    }

    /* Qualifications */
    .qual-item {
        display: flex;
        gap: .7rem;
        align-items: flex-start;
        padding: .35rem 0;
    }
    .qual-icon {
        width: 18px; height: 18px;
        background: var(--navy);
        border-radius: 4px;
        display: flex; align-items: center; justify-content: center;
        color: #fff;
        font-size: .55rem;
        flex-shrink: 0;
        margin-top: .1rem;
    }
    .qual-text { font-size: .84rem; color: var(--text-main); line-height: 1.4; }

    /* Biography */
    .bio-text { font-size: .88rem; color: var(--text-muted); line-height: 1.7; padding: 1rem 1.2rem; }
    #bioFull { display: none; }
    .see-more-btn {
        display: inline-flex; align-items: center; gap: 4px;
        color: var(--gold); font-size: .8rem; font-weight: 600;
        background: none; border: none; cursor: pointer; padding: 0;
        margin-top: .3rem;
        transition: color .2s;
    }
    .see-more-btn:hover { color: var(--navy); }

    /* Publications */
    .pub-item {
        padding: .9rem 1.2rem;
        border-bottom: 1px solid var(--border);
        transition: background .15s;
    }
    .pub-item:last-child { border: none; }
    .pub-item:hover { background: #fafbff; }
    .pub-title { font-weight: 600; font-size: .87rem; color: var(--navy); margin-bottom: .3rem; }
    .pub-title a { color: inherit; text-decoration: none; }
    .pub-title a:hover { color: var(--gold); }
    .pub-meta { display: flex; flex-wrap: wrap; gap: .5rem; align-items: center; }
    .pub-year {
        background: var(--navy);
        color: #fff;
        font-size: .7rem;
        font-weight: 700;
        padding: .15rem .55rem;
        border-radius: 100px;
    }
    .pub-tag {
        font-size: .75rem;
        color: var(--text-muted);
    }
    .pub-type-badge {
        background: var(--gold-pale);
        color: var(--gold);
        border: 1px solid rgba(201,162,39,.3);
        font-size: .68rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .3px;
        padding: .1rem .5rem;
        border-radius: 100px;
    }

    /* Collapse toggle */
    .collapse-btn {
        background: none; border: none; cursor: pointer;
        color: var(--text-muted); font-size: .8rem;
        display: flex; align-items: center; gap: 4px;
        transition: color .2s;
    }
    .collapse-btn:hover { color: var(--navy); }

    /* Other links */
    .other-link {
        display: inline-flex; align-items: center; gap: 6px;
        color: var(--gold); font-size: .85rem; text-decoration: none;
        border-bottom: 1px solid rgba(201,162,39,.3);
        padding-bottom: 1px;
        transition: color .2s;
    }
    .other-link:hover { color: var(--navy-mid); }

    /* Edit admin button */
    .edit-fab {
        position: fixed;
        bottom: 1.5rem; right: 1.5rem;
        background: var(--navy);
        color: #fff;
        border: none;
        border-radius: 100px;
        padding: .7rem 1.3rem;
        font-size: .84rem;
        font-weight: 600;
        text-decoration: none;
        box-shadow: var(--shadow-lg);
        display: flex; align-items: center; gap: .5rem;
        transition: background .2s, transform .15s;
        z-index: 500;
    }
    .edit-fab:hover { background: var(--gold); color: var(--navy); transform: translateY(-2px); }
    .edit-fab i { font-size: .8rem; }

    /* Awards / Recognition */
    .award-item {
        display: flex;
        gap: .7rem;
        align-items: flex-start;
        padding: .35rem 0;
    }
    .award-icon {
        width: 20px; height: 20px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #fff;
        font-size: .58rem;
        flex-shrink: 0;
        margin-top: .1rem;
    }
    .award-icon.gold   { background: linear-gradient(135deg, #c9a227, #e5c252); }
    .award-icon.silver { background: linear-gradient(135deg, #7a7a8a, #afafc0); }
    .award-text { font-size: .84rem; color: var(--text-main); line-height: 1.4; }

    /* Data tables inside cards */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: .82rem;
    }
    .data-table thead th {
        background: var(--navy);
        color: rgba(255,255,255,.85);
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .4px;
        text-transform: uppercase;
        padding: .5rem .8rem;
        white-space: nowrap;
    }
    .data-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background .12s;
    }
    .data-table tbody tr:last-child { border: none; }
    .data-table tbody tr:hover { background: #fafbff; }
    .data-table td {
        padding: .6rem .8rem;
        color: var(--text-main);
        vertical-align: middle;
        line-height: 1.4;
    }
    .data-table .year-cell {
        font-weight: 700;
        color: var(--navy);
        font-size: .8rem;
        white-space: nowrap;
    }
    .status-badge {
        display: inline-block;
        font-size: .68rem;
        font-weight: 700;
        letter-spacing: .3px;
        text-transform: uppercase;
        padding: .18rem .55rem;
        border-radius: 100px;
    }
    .status-badge.granted   { background: #e6f9ef; color: #1a7a42; border: 1px solid #b0e8c8; }
    .status-badge.pending   { background: #fff8e1; color: #8a6500; border: 1px solid #f5d97a; }
    .status-badge.filed     { background: #e8f0fe; color: #2a4ab5; border: 1px solid #b0c4f8; }
    .status-badge.completed { background: #e6f9ef; color: #1a7a42; border: 1px solid #b0e8c8; }
    .status-badge.ongoing   { background: #fff8e1; color: #8a6500; border: 1px solid #f5d97a; }
    .status-badge.default   { background: #f0f3fc; color: var(--navy-mid); border: 1px solid #dde3f5; }
    .ip-type-badge {
        display: inline-block;
        font-size: .68rem;
        font-weight: 600;
        padding: .15rem .55rem;
        border-radius: 100px;
        background: var(--gold-pale);
        color: var(--gold);
        border: 1px solid rgba(201,162,39,.3);
    }
    .repo-link {
        color: var(--gold);
        font-size: .78rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }
    .repo-link:hover { text-decoration: underline; }

    @media (max-width: 900px) {
        .profile-grid { grid-template-columns: 1fr; }
        .hero-name { font-size: 1.5rem; }
        .hero-photo, .hero-photo-placeholder { width: 85px; height: 100px; }
        .data-table { font-size: .75rem; }
    }

    /* ── Citation Trend Image ──────────────────────────────────── */
    .citation-trend-wrap {
        position: relative;
        display: inline-block;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0,0,0,.12);
        transition: box-shadow .25s;
        width: 100%;
    }
    .citation-trend-wrap:hover {
        box-shadow: 0 6px 24px rgba(0,0,0,.22);
    }
    .citation-trend-img {
        display: block;
        width: 100%;
        height: auto;
        border-radius: 8px;
        transform: scale(1);
        transition: transform .35s cubic-bezier(.25,.8,.25,1);
        transform-origin: center center;
    }
    .citation-trend-wrap:hover .citation-trend-img {
        transform: scale(1.06);
    }
    .citation-trend-overlay {
        position: absolute;
        inset: 0;
        background: rgba(15,25,55,.45);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
        opacity: 0;
        transition: opacity .25s;
        border-radius: 8px;
        color: #fff;
        font-size: 1.4rem;
    }
    .citation-trend-overlay span {
        font-size: .72rem;
        font-weight: 600;
        letter-spacing: .4px;
        text-transform: uppercase;
        opacity: .9;
    }
    .citation-trend-wrap:hover .citation-trend-overlay {
        opacity: 1;
    }
    /* Native dialog lightbox */
    #citationLightbox::backdrop {
        background: rgba(5,12,35,.82);
        backdrop-filter: blur(4px);
    }
    #citationLightbox {
        animation: lightboxIn .2s ease;
    }
    @keyframes lightboxIn {
        from { opacity: 0; transform: scale(.92); }
        to   { opacity: 1; transform: scale(1); }
    }
</style>
@endsection


@section('content')

<!-- ── Profile Hero ────────────────────────────────────────── -->
<div class="profile-hero">
    <div class="profile-hero-inner fade-up">
        <div class="breadcrumb-nav">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep"><i class="fa fa-chevron-right"></i></span>
            <a href="{{ route('academics.index') }}">Profiles</a>
            <span class="sep"><i class="fa fa-chevron-right"></i></span>
            <span class="current">{{ $academic->name }}</span>
        </div>

        <div class="hero-profile-row">
            <div class="hero-photo-wrap">
                @if($academic->photo)
                    <img src="{{ asset('storage/' . $academic->photo) }}" alt="{{ $academic->name }}" class="hero-photo">
                @else
                    <div class="hero-photo-placeholder"><i class="fa fa-user"></i></div>
                @endif
            </div>
            <div class="hero-info">
                <div class="hero-label"><i class="fa fa-star me-1"></i> UTP Scholars</div>
                <div class="hero-name">{{ $academic->name }}</div>
                <div class="hero-meta">
                    @if($academic->title)
                        <div class="hero-chip"><i class="fa fa-id-badge"></i> {{ $academic->title }}</div>
                    @endif
                    @if($academic->department)
                        <div class="hero-chip"><i class="fa fa-building"></i> {{ $academic->department }}</div>
                    @endif
                    @if($academic->email)
                        <div class="hero-chip"><i class="fa fa-envelope"></i> {{ $academic->email }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ── Profile Body ────────────────────────────────────────── -->
<div class="profile-body">
    <div class="profile-grid fade-up" style="animation-delay:.1s">

        <!-- ── LEFT: Sidebar ─────────────────────────────── -->
        <div>

            <!-- Contact -->
            <div class="side-card">
                <div class="side-card-header"><i class="fa fa-address-card"></i> Contact & Location</div>
                <div class="side-card-body">
                    @if($academic->office_address)
                        <div class="contact-item">
                            <div class="ci-icon"><i class="fa fa-map-marker-alt"></i></div>
                            <div>
                                <div class="ci-label">Office Address</div>
                                <div class="ci-value">{!! nl2br(e($academic->office_address)) !!}</div>
                            </div>
                        </div>
                    @endif
                    @if($academic->phone)
                        <div class="contact-item">
                            <div class="ci-icon"><i class="fa fa-phone"></i></div>
                            <div>
                                <div class="ci-label">Phone</div>
                                <div class="ci-value">{{ $academic->phone }}</div>
                            </div>
                        </div>
                    @endif
                    @if($academic->email)
                        <div class="contact-item">
                            <div class="ci-icon"><i class="fa fa-envelope"></i></div>
                            <div>
                                <div class="ci-label">Email</div>
                                <div class="ci-value">
                                    <a href="mailto:{{ $academic->email }}">{{ $academic->email }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(!$academic->office_address && !$academic->phone && !$academic->email)
                        <p class="text-muted mb-0" style="font-size:.83rem;">No contact info provided.</p>
                    @endif
                </div>
            </div>

            <!-- Scopus -->
            @if($academic->scopus_author_id || $academic->scopus_documents || $academic->scopus_citation_image)
            <div class="side-card">
                <div class="side-card-header"><i class="fa fa-chart-bar"></i> Scopus</div>
                <div class="side-card-body">
                    @if($academic->scopus_author_id)
                        <div class="metric-row">
                            <span class="m-label">Author ID</span>
                            <a href="https://www.scopus.com/authid/detail.uri?authorId={{ $academic->scopus_author_id }}"
                               target="_blank" class="m-link" style="font-size:.78rem;font-family:monospace;">
                                {{ $academic->scopus_author_id }}
                                <i class="fa fa-external-link-alt ms-1" style="font-size:.65rem;"></i>
                            </a>
                        </div>
                    @endif
                    @if($academic->scopus_documents !== null)
                        <div class="metric-row">
                            <span class="m-label">Documents</span>
                            <span class="m-val">{{ number_format($academic->scopus_documents) }}</span>
                        </div>
                    @endif
                    @if($academic->scopus_citations !== null)
                        <div class="metric-row">
                            <span class="m-label">Total Citations</span>
                            <span class="m-val">{{ number_format($academic->scopus_citations) }}</span>
                        </div>
                    @endif
                    @if($academic->scopus_hindex !== null)
                        <div class="metric-row">
                            <span class="m-label">h-Index</span>
                            <span class="m-val">{{ $academic->scopus_hindex }}</span>
                        </div>
                    @endif
                    @if($academic->scopus_coauthors !== null)
                        <div class="metric-row">
                            <span class="m-label">Co-authors</span>
                            <span class="m-val">{{ number_format($academic->scopus_coauthors) }}</span>
                        </div>
                    @endif

                    @if($academic->scopus_citation_image)
                    <div style="margin-top:.9rem;">
                        <div style="font-size:.7rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;color:var(--text-muted);margin-bottom:.5rem;">
                            Citation Trend
                            @if($academic->scopus_citation_image_updated_at)
                            <span style="font-weight:400;text-transform:none;letter-spacing:0;margin-left:.4rem;color:#b0b8c9;">
                                · {{ $academic->scopus_citation_image_updated_at->format('M Y') }}
                            </span>
                            @endif
                        </div>
                        <div class="citation-trend-wrap" onclick="document.getElementById('citationLightbox').showModal()">
                            <img src="{{ Storage::url($academic->scopus_citation_image) }}"
                                 alt="Scopus Citation Trend"
                                 class="citation-trend-img"
                                 id="citationThumb">
                            <div class="citation-trend-overlay"><i class="fa fa-search-plus"></i><span>Click to enlarge</span></div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- Citation Trend Lightbox --}}
            @if($academic->scopus_citation_image)
            <dialog id="citationLightbox" style="padding:0;border:none;border-radius:12px;background:transparent;max-width:95vw;max-height:95vh;box-shadow:0 24px 80px rgba(0,0,0,.55);" onclick="this.close()">
                <img src="{{ Storage::url($academic->scopus_citation_image) }}"
                     alt="Scopus Citation Trend"
                     style="display:block;max-width:90vw;max-height:88vh;border-radius:12px;object-fit:contain;">
                @if($academic->scopus_citation_image_updated_at)
                <div style="position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,.55);color:#fff;font-size:.75rem;padding:.45rem .8rem;border-radius:0 0 12px 12px;text-align:center;">
                    Last updated: {{ $academic->scopus_citation_image_updated_at->format('d F Y, H:i') }}
                </div>
                @endif
            </dialog>
            @endif


            <!-- Google Scholar -->
            @if($academic->gscholar_profile || $academic->gscholar_citations)
            <div class="side-card">
                <div class="side-card-header"><i class="fab fa-google"></i> Google Scholar</div>
                <div class="side-card-body">
                    @if($academic->gscholar_profile)
                        <div class="metric-row">
                            <span class="m-label">Profile</span>
                            <a href="https://scholar.google.com/citations?user={{ $academic->gscholar_profile }}"
                               target="_blank" class="m-link" style="font-size:.75rem;word-break:break-all;">
                                {{ $academic->gscholar_profile }}
                                <i class="fa fa-external-link-alt ms-1" style="font-size:.65rem;"></i>
                            </a>
                        </div>
                    @endif
                    @if($academic->gscholar_citations !== null)
                        <div class="metric-row">
                            <span class="m-label">Citations</span>
                            <span class="m-val">{{ number_format($academic->gscholar_citations) }}</span>
                        </div>
                    @endif
                    @if($academic->gscholar_hindex !== null)
                        <div class="metric-row">
                            <span class="m-label">h-Index</span>
                            <span class="m-val">{{ $academic->gscholar_hindex }}</span>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- ResearchGate -->
            @if($academic->researchgate_profile || $academic->rg_publications)
            <div class="side-card">
                <div class="side-card-header"><i class="fab fa-researchgate"></i> ResearchGate</div>
                <div class="side-card-body">
                    @if($academic->researchgate_profile)
                        <div class="metric-row">
                            <span class="m-label">Profile</span>
                            <a href="https://www.researchgate.net/profile/{{ $academic->researchgate_profile }}"
                               target="_blank" class="m-link" style="font-size:.75rem;word-break:break-all;">
                                {{ $academic->researchgate_profile }}
                                <i class="fa fa-external-link-alt ms-1" style="font-size:.65rem;"></i>
                            </a>
                        </div>
                    @endif
                    @if($academic->rg_publications !== null)
                        <div class="metric-row"><span class="m-label">Publications</span><span class="m-val">{{ number_format($academic->rg_publications) }}</span></div>
                    @endif
                    @if($academic->rg_citations !== null)
                        <div class="metric-row"><span class="m-label">Citations</span><span class="m-val">{{ number_format($academic->rg_citations) }}</span></div>
                    @endif
                    @if($academic->rg_hindex !== null)
                        <div class="metric-row"><span class="m-label">h-Index</span><span class="m-val">{{ $academic->rg_hindex }}</span></div>
                    @endif
                    @if($academic->rg_reads !== null)
                        <div class="metric-row"><span class="m-label">Reads</span><span class="m-val">{{ number_format($academic->rg_reads) }}</span></div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Research Projects -->
            @if($academic->research_projects && count($academic->research_projects))
            <div class="side-card">
                <div class="side-card-header"><i class="fa fa-flask"></i> Research Projects</div>
                <div class="side-card-body">
                    <ul class="list-items">
                        @foreach($academic->research_projects as $proj)
                            <li class="list-item"><i class="fa fa-caret-right"></i>{{ $proj }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <!-- Memberships -->
            @if($academic->memberships && count($academic->memberships))
            <div class="side-card">
                <div class="side-card-header"><i class="fa fa-id-card"></i> Professional Memberships</div>
                <div class="side-card-body">
                    <ul class="list-items">
                        @foreach($academic->memberships as $mem)
                            <li class="list-item"><i class="fa fa-check"></i>{{ $mem }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

        </div>

        <!-- ── RIGHT: Main Info ───────────────────────────── -->
        <div>

            <!-- Core Information -->
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-title"><i class="fa fa-user-circle"></i> Academic Profile</div>
                </div>

                @if($academic->title)
                <div class="info-row">
                    <div class="info-label">Title</div>
                    <div class="info-value highlighted">{{ $academic->title }}</div>
                </div>
                @endif

                @if($academic->department)
                <div class="info-row">
                    <div class="info-label">Department</div>
                    <div class="info-value" style="color:var(--gold);font-weight:600;">{{ $academic->department }}</div>
                </div>
                @endif

                @if($academic->institute)
                <div class="info-row">
                    <div class="info-label">Institute</div>
                    <div class="info-value">{{ $academic->institute }}</div>
                </div>
                @endif

                @if($academic->centre)
                <div class="info-row">
                    <div class="info-label">Centre</div>
                    <div class="info-value">{{ $academic->centre }}</div>
                </div>
                @endif

                @if($academic->specializations && count($academic->specializations))
                <div class="info-row">
                    <div class="info-label">Specializations</div>
                    <div class="info-value">
                        @foreach($academic->specializations as $spec)
                            <span class="spec-pill">{{ $spec }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($academic->qualifications && count($academic->qualifications))
                <div class="info-row">
                    <div class="info-label">Qualifications</div>
                    <div class="info-value">
                        @foreach($academic->qualifications as $qual)
                            <div class="qual-item">
                                <div class="qual-icon"><i class="fa fa-check"></i></div>
                                <div class="qual-text">{{ $qual }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($academic->awards && count($academic->awards))
                <div class="info-row">
                    <div class="info-label">Awards</div>
                    <div class="info-value">
                        @foreach($academic->awards as $award)
                            <div class="award-item">
                                <div class="award-icon gold"><i class="fa fa-trophy"></i></div>
                                <div class="award-text">{{ $award }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($academic->recognition && count($academic->recognition))
                <div class="info-row">
                    <div class="info-label">Recognition</div>
                    <div class="info-value">
                        @foreach($academic->recognition as $rec)
                            <div class="award-item">
                                <div class="award-icon silver"><i class="fa fa-ribbon"></i></div>
                                <div class="award-text">{{ $rec }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($academic->other_links && count($academic->other_links))
                <div class="info-row">
                    <div class="info-label">Links</div>
                    <div class="info-value">
                        <div class="d-flex flex-wrap gap-2">
                        @foreach($academic->other_links as $link)
                            @if(is_array($link))
                                <a href="{{ $link['url'] ?? '#' }}" target="_blank" class="other-link">
                                    <i class="fa fa-external-link-alt" style="font-size:.7rem;"></i>
                                    {{ $link['label'] ?? $link['url'] }}
                                </a>
                            @else
                                <span>{{ $link }}</span>
                            @endif
                        @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Biography -->
            @if($academic->biography)
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-title"><i class="fa fa-align-left"></i> Biography</div>
                </div>
                <div class="bio-text">
                    @php
                        $bio = $academic->biography;
                        $isLong = strlen($bio) > 350;
                        $shortBio = $isLong ? Str::limit($bio, 350) : $bio;
                    @endphp
                    <span id="bioShort">{{ $shortBio }}</span>
                    @if($isLong)
                        <span id="bioFull">{{ $bio }}</span>
                        <br>
                        <button class="see-more-btn" id="seeMoreBtn" onclick="toggleBio()">
                            See More <i class="fa fa-chevron-down" id="seeMoreIcon"></i>
                        </button>
                    @endif
                </div>
            </div>
            @endif

            <!-- University Activities -->
            @if($academic->university_activities && count($academic->university_activities))
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-title"><i class="fa fa-university"></i> University Activities</div>
                </div>
                <ul class="list-items" style="padding:.4rem 1.2rem;">
                    @foreach($academic->university_activities as $act)
                        <li class="list-item"><i class="fa fa-angle-right"></i>{{ $act }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Courses -->
            @if($academic->courses_teaching && count($academic->courses_teaching))
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-title"><i class="fa fa-chalkboard-teacher"></i> Courses Teaching</div>
                    <span style="font-size:.72rem;color:var(--text-muted);font-weight:500;">{{ count($academic->courses_teaching) }} {{ Str::plural('course', count($academic->courses_teaching)) }}</span>
                </div>
                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="width:90px">Year</th>
                                <th style="width:160px">Course Code</th>
                                <th>Course Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($academic->courses_teaching as $course)
                            <tr>
                                @if(is_array($course))
                                    <td class="year-cell">{{ $course['year'] ?? '—' }}</td>
                                    <td>
                                        <span style="font-family:monospace;font-size:.8rem;background:#f0f3fc;border:1px solid #dde3f5;color:var(--navy-mid);padding:.15rem .5rem;border-radius:4px;font-weight:600;">
                                            {{ $course['course_code'] ?? '—' }}
                                        </span>
                                    </td>
                                    <td>{{ $course['course_name'] ?? '—' }}</td>
                                @else
                                    <td class="year-cell">—</td>
                                    <td>—</td>
                                    <td>{{ $course }}</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- Industrial Experience -->
            @if($academic->industrial_experience)
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-title"><i class="fa fa-industry"></i> Industrial Experience</div>
                </div>
                <div class="bio-text">{!! nl2br(e($academic->industrial_experience)) !!}</div>
            </div>
            @endif

            <!-- Supervision (legacy plain text) -->
            @if($academic->supervision_info && !($academic->supervision && count($academic->supervision)))
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-title"><i class="fa fa-user-graduate"></i> Supervision Notes</div>
                </div>
                <div class="bio-text">{!! nl2br(e($academic->supervision_info)) !!}</div>
            </div>
            @endif

            <!-- Consultation Complete -->
            @if($academic->consultation_complete && count($academic->consultation_complete))
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-title"><i class="fa fa-handshake"></i> Consultation Complete</div>
                    <span style="font-size:.72rem;color:var(--text-muted);font-weight:500;">{{ count($academic->consultation_complete) }} {{ Str::plural('record', count($academic->consultation_complete)) }}</span>
                </div>
                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>Title</th>
                                <th>Membership</th>
                                <th>Funder</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($academic->consultation_complete as $cc)
                            <tr>
                                <td class="year-cell">{{ $cc['year'] ?? '—' }}</td>
                                <td>{{ $cc['title'] ?? '—' }}</td>
                                <td>{{ $cc['membership'] ?? '—' }}</td>
                                <td>{{ $cc['funder'] ?? '—' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- Intellectual Properties -->
            @if($academic->intellectual_properties && count($academic->intellectual_properties))
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-title"><i class="fa fa-lightbulb"></i> Intellectual Properties</div>
                    <span style="font-size:.72rem;color:var(--text-muted);font-weight:500;">{{ count($academic->intellectual_properties) }} {{ Str::plural('record', count($academic->intellectual_properties)) }}</span>
                </div>
                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>Reference No.</th>
                                <th>IP Type</th>
                                <th>Title</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($academic->intellectual_properties as $ip)
                            @php
                                $ipStatus = strtolower($ip['status_ip'] ?? '');
                                $statusClass = in_array($ipStatus, ['granted','pending','filed','completed','ongoing']) ? $ipStatus : 'default';
                            @endphp
                            <tr>
                                <td class="year-cell">{{ $ip['year'] ?? '—' }}</td>
                                <td style="font-family:monospace;font-size:.78rem;">{{ $ip['reference_no'] ?? '—' }}</td>
                                <td><span class="ip-type-badge">{{ $ip['ip_type'] ?? '—' }}</span></td>
                                <td>{{ $ip['title'] ?? '—' }}</td>
                                <td><span class="status-badge {{ $statusClass }}">{{ $ip['status_ip'] ?? '—' }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- Supervision (structured) -->
            @if($academic->supervision && count($academic->supervision))
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-title"><i class="fa fa-user-graduate"></i> Supervision</div>
                    <span style="font-size:.72rem;color:var(--text-muted);font-weight:500;">{{ count($academic->supervision) }} {{ Str::plural('student', count($academic->supervision)) }}</span>
                </div>
                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>Student Name</th>
                                <th>Level</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Repository</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($academic->supervision as $sup)
                            @php
                                $supStatus = strtolower($sup['status'] ?? '');
                                $supClass = in_array($supStatus, ['completed','ongoing','pending']) ? $supStatus : 'default';
                            @endphp
                            <tr>
                                <td class="year-cell">{{ $sup['year'] ?? '—' }}</td>
                                <td style="font-weight:600;">{{ $sup['student_name'] ?? '—' }}</td>
                                <td>
                                    <span class="ip-type-badge">{{ $sup['level'] ?? '—' }}</span>
                                </td>
                                <td>{{ $sup['title'] ?? '—' }}</td>
                                <td><span class="status-badge {{ $supClass }}">{{ $sup['status'] ?? '—' }}</span></td>
                                <td>
                                    @if(!empty($sup['repository_url']))
                                        <a href="{{ $sup['repository_url'] }}" target="_blank" class="repo-link">
                                            <i class="fa fa-external-link-alt"></i> View
                                        </a>
                                    @else
                                        <span style="color:var(--text-muted);font-size:.78rem;">—</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- Publications -->
            @if($academic->publications->count())
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-title">
                        <i class="fa fa-book-open"></i>
                        Publications
                        <span style="background:var(--navy);color:#fff;font-size:.7rem;font-weight:700;padding:.15rem .55rem;border-radius:100px;margin-left:.3rem;">
                            {{ $academic->publications->count() }}
                        </span>
                    </div>
                    <button class="collapse-btn" onclick="togglePubs(this)">
                        <i class="fa fa-chevron-up" id="pubChevron"></i>
                    </button>
                </div>
                <div id="pubList">
                    @foreach($academic->publications->sortByDesc('year') as $pub)
                        <div class="pub-item">
                            <div class="pub-title">
                                @if($pub->url)
                                    <a href="{{ $pub->url }}" target="_blank">{{ $pub->title }}</a>
                                @else
                                    {{ $pub->title }}
                                @endif
                            </div>
                            <div class="pub-meta">
                                @if($pub->year) <span class="pub-year">{{ $pub->year }}</span> @endif
                                <span class="pub-type-badge">{{ $pub->type }}</span>
                                @if($pub->authors) <span class="pub-tag">{{ $pub->authors }}</span> @endif
                                @if($pub->journal)
                                    <span class="pub-tag">
                                        <i class="fa fa-file-alt me-1" style="font-size:.65rem;"></i>
                                        <em>{{ $pub->journal }}</em>
                                        @if($pub->volume) vol. {{ $pub->volume }} @endif
                                        @if($pub->pages) pp. {{ $pub->pages }} @endif
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

@auth
    <a href="{{ route('admin.academics.edit', $academic) }}" class="edit-fab">
        <i class="fa fa-edit"></i> Edit Profile
    </a>
@endauth

@endsection

@section('scripts')
<script>
function toggleBio() {
    const full  = document.getElementById('bioFull');
    const short = document.getElementById('bioShort');
    const btn   = document.getElementById('seeMoreBtn');
    const icon  = document.getElementById('seeMoreIcon');
    const showing = full.style.display !== 'none' && full.style.display !== '';
    full.style.display  = showing ? 'none'   : 'inline';
    short.style.display = showing ? 'inline' : 'none';
    btn.innerHTML = showing
        ? 'See More <i class="fa fa-chevron-down" id="seeMoreIcon"></i>'
        : 'See Less <i class="fa fa-chevron-up" id="seeMoreIcon"></i>';
}

function togglePubs(btn) {
    const list    = document.getElementById('pubList');
    const chevron = document.getElementById('pubChevron');
    const hidden  = list.style.display === 'none';
    list.style.display = hidden ? 'block' : 'none';
    chevron.className  = hidden ? 'fa fa-chevron-up' : 'fa fa-chevron-down';
}
</script>
@endsection
