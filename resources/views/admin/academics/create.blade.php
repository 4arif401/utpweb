@extends('layouts.admin')

@section('title', 'Add New Scholar')
@section('page-title', 'Add New Scholar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <a href="{{ route('admin.academics.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-arrow-left me-1"></i> Back to Scholars
        </a>
    </div>
</div>

<form method="POST" action="{{ route('admin.academics.store') }}" enctype="multipart/form-data">
    @csrf

    @include('admin.academics._form')

    <div class="d-flex gap-2 mt-2 mb-4">
        <button type="submit" class="btn-primary-custom btn">
            <i class="fa fa-save me-1"></i> Create Scholar
        </button>
        <a href="{{ route('admin.academics.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</form>
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
