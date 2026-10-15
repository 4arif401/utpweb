@extends('layouts.admin')

@section('title', 'Scholars Management')
@section('page-title', 'Scholars Management')

@section('styles')
<style>
/* Force DataTables v2 column headers to show correctly */
#adminTable thead th,
#adminTable thead td,
table.dataTable thead th,
table.dataTable thead td {
    background-color: #0d1b3e !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    font-size: .78rem !important;
    text-transform: uppercase !important;
    letter-spacing: .3px !important;
    padding: .85rem 2rem .85rem 1rem !important;
    border: none !important;
}
.dt-column-title { color: #ffffff !important; }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h5 class="mb-0" style="color:var(--navy);font-weight:700;">All Scholars</h5>
        <small class="text-muted">{{ $academics->count() }} scholar(s) in database</small>
    </div>
    <a href="{{ route('admin.academics.create') }}" class="btn-primary-custom btn">
        <i class="fa fa-plus me-1"></i> Add New Scholar
    </a>
</div>

<div class="section-card">
    <div class="table-responsive">
        <table id="adminTable" class="table table-hover align-middle mb-0" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 40px;">#</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Department</th>
                    <th>Institute</th>
                    <th>Email</th>
                    <th>Publications</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($academics as $i => $academic)
                <tr>
                    <td class="text-muted" style="font-size:.78rem;">{{ $i + 1 }}</td>
                    <td>
                        <div class="fw-600" style="color:var(--navy);">{{ $academic->name }}</div>
                        <small class="text-muted">{{ $academic->slug }}</small>
                    </td>
                    <td>{{ $academic->title ?? '—' }}</td>
                    <td>{{ $academic->department ?? '—' }}</td>
                    <td style="font-size:.8rem;">{{ $academic->institute ?? '—' }}</td>
                    <td>
                        @if($academic->email)
                            <a href="mailto:{{ $academic->email }}" class="text-gold" style="font-size:.82rem;">{{ $academic->email }}</a>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-secondary">{{ $academic->publications_count ?? 0 }}</span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('academics.show', $academic->slug) }}" target="_blank"
                               class="btn btn-sm btn-outline-secondary" title="View public profile">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.academics.edit', $academic) }}"
                               class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.academics.destroy', $academic) }}"
                                  onsubmit="return confirm('Delete {{ addslashes($academic->name) }}? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
    $('#adminTable').DataTable({
        pageLength: 15,
        columnDefs: [{ orderable: false, targets: 7 }]
    });
});
</script>
@endsection
