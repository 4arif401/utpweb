@extends('layouts.admin')

@section('title', 'Edit Scholar — ' . $academic->name)
@section('page-title', 'Edit: ' . $academic->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div class="d-flex gap-2">
        <a href="{{ route('admin.academics.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-arrow-left me-1"></i> Back
        </a>
        <a href="{{ route('academics.show', $academic->slug) }}" target="_blank" class="btn btn-sm btn-outline-primary">
            <i class="fa fa-eye me-1"></i> View Public Profile
        </a>
    </div>
    <form method="POST" action="{{ route('admin.academics.destroy', $academic) }}"
          onsubmit="return confirm('Permanently delete {{ addslashes($academic->name) }}?');">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger">
            <i class="fa fa-trash me-1"></i> Delete Scholar
        </button>
    </form>
</div>

<form method="POST" action="{{ route('admin.academics.update', $academic) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('admin.academics._form')

    <div class="d-flex gap-2 mt-2">
        <button type="submit" class="btn-primary-custom btn">
            <i class="fa fa-save me-1"></i> Save Changes
        </button>
        <a href="{{ route('admin.academics.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</form>

{{-- ── Publications Section ─────────────────────────────────── --}}
<div class="section-card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fa fa-book-open me-1"></i> Publications ({{ $academic->publications->count() }})</span>
    </div>
    <div class="card-body">

        {{-- Add Publication Form --}}
        <form method="POST" action="{{ route('admin.academics.publications.store', $academic) }}" class="border rounded p-3 mb-3 bg-light">
            @csrf
            <h6 class="mb-3" style="color:var(--navy);font-weight:700;font-size:.9rem;">Add Publication</h6>
            <div class="row g-2">
                <div class="col-12">
                    <input type="text" class="form-control" name="title" placeholder="Publication Title *" required>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="authors" placeholder="Authors">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="year" placeholder="Year" min="1900" max="2099">
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="type">
                        <option value="journal">Journal</option>
                        <option value="conference">Conference</option>
                        <option value="book">Book</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="journal" placeholder="Journal / Venue">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="volume" placeholder="Volume">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="pages" placeholder="Pages">
                </div>
                <div class="col-md-3">
                    <input type="url" class="form-control" name="url" placeholder="DOI / URL">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-sm btn-primary-custom">
                        <i class="fa fa-plus me-1"></i> Add Publication
                    </button>
                </div>
            </div>
        </form>

        {{-- Existing Publications --}}
        @if($academic->publications->count())
        <div class="table-responsive">
            <table class="table table-sm align-middle" style="font-size:.82rem;">
                <thead>
                    <tr style="background:#f8f9fb;">
                        <th>Title</th>
                        <th>Authors</th>
                        <th>Year</th>
                        <th>Journal</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($academic->publications->sortByDesc('year') as $pub)
                    <tr>
                        <td>
                            @if($pub->url)
                                <a href="{{ $pub->url }}" target="_blank" class="text-gold" style="text-decoration:none;">{{ Str::limit($pub->title, 60) }}</a>
                            @else
                                {{ Str::limit($pub->title, 60) }}
                            @endif
                        </td>
                        <td>{{ Str::limit($pub->authors ?? '', 40) }}</td>
                        <td>{{ $pub->year ?? '—' }}</td>
                        <td>{{ Str::limit($pub->journal ?? '', 30) }}</td>
                        <td><span class="badge bg-secondary">{{ $pub->type }}</span></td>
                        <td>
                            <form method="POST" action="{{ route('admin.academics.publications.destroy', [$academic, $pub]) }}"
                                  onsubmit="return confirm('Delete this publication?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-outline-danger" style="padding:.1rem .4rem;font-size:.75rem;">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p class="text-muted mb-0" style="font-size:.84rem;">No publications yet. Use the form above to add one.</p>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
function addLinkRow() {
    const container = document.getElementById('otherLinksContainer');
    const div = document.createElement('div');
    div.className = 'd-flex gap-2 mb-2 other-link-row';
    div.innerHTML = `
        <input type="text" class="form-control" name="other_links_label[]" placeholder="Label">
        <input type="text" class="form-control" name="other_links_url[]" placeholder="URL (https://...)">
        <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.other-link-row').remove()">
            <i class="fa fa-times"></i>
        </button>
    `;
    container.appendChild(div);
}
</script>
@endsection
