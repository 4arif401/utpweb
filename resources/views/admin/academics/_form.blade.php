{{-- Shared form fields for create and edit academic views --}}

{{-- ── Basic Information ─────────────────────────────────────────── --}}
<div class="section-card">
    <div class="card-header"><i class="fa fa-user me-1"></i> Basic Information</div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-8">
                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       id="name" name="name" value="{{ old('name', $academic->name ?? '') }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4">
                <label for="title" class="form-label">Position / Title</label>
                <input type="text" class="form-control" id="title" name="title"
                       value="{{ old('title', $academic->title ?? '') }}"
                       placeholder="e.g. Associate Professor">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email', $academic->email ?? '') }}">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone"
                       value="{{ old('phone', $academic->phone ?? '') }}">
            </div>
            <div class="col-md-4">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department"
                       value="{{ old('department', $academic->department ?? '') }}">
            </div>
            <div class="col-md-4">
                <label for="institute" class="form-label">Institute</label>
                <input type="text" class="form-control" id="institute" name="institute"
                       value="{{ old('institute', $academic->institute ?? '') }}">
            </div>
            <div class="col-md-4">
                <label for="centre" class="form-label">Centre</label>
                <input type="text" class="form-control" id="centre" name="centre"
                       value="{{ old('centre', $academic->centre ?? '') }}">
            </div>
            <div class="col-md-6">
                <label for="office_address" class="form-label">Office Address</label>
                <textarea class="form-control" id="office_address" name="office_address" rows="3">{{ old('office_address', $academic->office_address ?? '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label for="photo" class="form-label">Profile Photo</label>
                @if(!empty($academic->photo))
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $academic->photo) }}" alt="Current photo"
                             style="width:80px;height:100px;object-fit:cover;border-radius:6px;border:2px solid var(--gold);">
                        <small class="d-block text-muted mt-1">Current photo. Upload a new one to replace.</small>
                    </div>
                @endif
                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                <div class="form-text">Max 2MB. JPG, PNG, or GIF.</div>
            </div>
        </div>
    </div>
</div>

{{-- ── Biography ─────────────────────────────────────────────────── --}}
<div class="section-card">
    <div class="card-header"><i class="fa fa-align-left me-1"></i> Biography</div>
    <div class="card-body">
        <textarea class="form-control" id="biography" name="biography" rows="5"
                  placeholder="Short biography...">{{ old('biography', $academic->biography ?? '') }}</textarea>
    </div>
</div>

{{-- ── Specializations & Qualifications ────────────────────────── --}}
<div class="section-card">
    <div class="card-header"><i class="fa fa-graduation-cap me-1"></i> Specializations & Qualifications</div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="specializations" class="form-label">Specializations</label>
                <textarea class="form-control" id="specializations" name="specializations" rows="5"
                          placeholder="One specialization per line">{{ old('specializations', isset($academic) && $academic->specializations ? implode("\n", $academic->specializations) : '') }}</textarea>
                <div class="form-text">Enter one item per line.</div>
            </div>
            <div class="col-md-6">
                <label for="qualifications" class="form-label">Qualifications</label>
                <textarea class="form-control" id="qualifications" name="qualifications" rows="5"
                          placeholder="One qualification per line, e.g.: 2007, PhD in Nanotechnology by ...">{{ old('qualifications', isset($academic) && $academic->qualifications ? implode("\n", $academic->qualifications) : '') }}</textarea>
                <div class="form-text">Enter one item per line.</div>
            </div>
        </div>
    </div>
</div>

{{-- ── Awards & Recognition ──────────────────────────────────────── --}}
<div class="section-card">
    <div class="card-header"><i class="fa fa-trophy me-1"></i> Awards & Recognition</div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="awards" class="form-label">Awards</label>
                <textarea class="form-control" id="awards" name="awards" rows="5"
                          placeholder="One award per line">{{ old('awards', isset($academic) && $academic->awards ? implode("\n", $academic->awards) : '') }}</textarea>
                <div class="form-text">Enter one award per line. Each new line is a separate entry.</div>
            </div>
            <div class="col-md-6">
                <label for="recognition" class="form-label">Recognition</label>
                <textarea class="form-control" id="recognition" name="recognition" rows="5"
                          placeholder="One recognition per line">{{ old('recognition', isset($academic) && $academic->recognition ? implode("\n", $academic->recognition) : '') }}</textarea>
                <div class="form-text">Enter one recognition per line. Each new line is a separate entry.</div>
            </div>
        </div>
    </div>
</div>

{{-- ── Scopus Metrics ─────────────────────────────────────────── --}}
<div class="section-card">
    <div class="card-header"><i class="fa fa-chart-bar me-1"></i> Scopus Metrics</div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Scopus Author ID</label>
                <input type="text" class="form-control" name="scopus_author_id"
                       value="{{ old('scopus_author_id', $academic->scopus_author_id ?? '') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Documents</label>
                <input type="number" class="form-control" name="scopus_documents"
                       value="{{ old('scopus_documents', $academic->scopus_documents ?? '') }}" min="0">
            </div>
            <div class="col-md-2">
                <label class="form-label">Citations</label>
                <input type="number" class="form-control" name="scopus_citations"
                       value="{{ old('scopus_citations', $academic->scopus_citations ?? '') }}" min="0">
            </div>
            <div class="col-md-2">
                <label class="form-label">h-Index</label>
                <input type="number" class="form-control" name="scopus_hindex"
                       value="{{ old('scopus_hindex', $academic->scopus_hindex ?? '') }}" min="0">
            </div>
            <div class="col-md-2">
                <label class="form-label">Co-authors</label>
                <input type="number" class="form-control" name="scopus_coauthors"
                       value="{{ old('scopus_coauthors', $academic->scopus_coauthors ?? '') }}" min="0">
            </div>
            <div class="col-12">
                <label class="form-label">Citation Trend Image</label>
                <div class="d-flex align-items-start gap-3 flex-wrap">
                    @if(isset($academic) && $academic->scopus_citation_image)
                    <div style="position:relative;">
                        <img src="{{ Storage::url($academic->scopus_citation_image) }}"
                             alt="Citation Trend"
                             style="height:90px;border-radius:6px;border:1px solid #dde3f5;object-fit:cover;cursor:pointer;"
                             onclick="window.open('{{ Storage::url($academic->scopus_citation_image) }}','_blank')">
                        <div style="font-size:.72rem;color:var(--text-muted);margin-top:.3rem;">
                            <i class="fa fa-clock me-1"></i>
                            Updated {{ $academic->scopus_citation_image_updated_at?->format('d M Y, H:i') ?? '—' }}
                        </div>
                    </div>
                    @endif
                    <div>
                        <input type="file" class="form-control form-control-sm" name="scopus_citation_image"
                               accept="image/*" style="max-width:320px;">
                        <div class="form-text">PNG/JPG/WEBP, max 4 MB. Upload a screenshot of your Scopus citation trend chart.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- ── Google Scholar ──────────────────────────────────────────── --}}
<div class="section-card">
    <div class="card-header"><i class="fab fa-google me-1"></i> Google Scholar</div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Author Profile URL Key</label>
                <input type="text" class="form-control" name="gscholar_profile"
                       value="{{ old('gscholar_profile', $academic->gscholar_profile ?? '') }}"
                       placeholder="e.g. 6zYQw0AAAAJ&hl">
                <div class="form-text">The part after <code>citations?user=</code> in the Scholar URL.</div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Citations</label>
                <input type="number" class="form-control" name="gscholar_citations"
                       value="{{ old('gscholar_citations', $academic->gscholar_citations ?? '') }}" min="0">
            </div>
            <div class="col-md-3">
                <label class="form-label">h-Index</label>
                <input type="number" class="form-control" name="gscholar_hindex"
                       value="{{ old('gscholar_hindex', $academic->gscholar_hindex ?? '') }}" min="0">
            </div>
        </div>
    </div>
</div>

{{-- ── ResearchGate ─────────────────────────────────────────────── --}}
<div class="section-card">
    <div class="card-header"><i class="fab fa-researchgate me-1"></i> ResearchGate</div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Profile Username</label>
                <input type="text" class="form-control" name="researchgate_profile"
                       value="{{ old('researchgate_profile', $academic->researchgate_profile ?? '') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Publications</label>
                <input type="number" class="form-control" name="rg_publications"
                       value="{{ old('rg_publications', $academic->rg_publications ?? '') }}" min="0">
            </div>
            <div class="col-md-2">
                <label class="form-label">Citations</label>
                <input type="number" class="form-control" name="rg_citations"
                       value="{{ old('rg_citations', $academic->rg_citations ?? '') }}" min="0">
            </div>
            <div class="col-md-2">
                <label class="form-label">h-Index</label>
                <input type="number" class="form-control" name="rg_hindex"
                       value="{{ old('rg_hindex', $academic->rg_hindex ?? '') }}" min="0">
            </div>
            <div class="col-md-2">
                <label class="form-label">Reads</label>
                <input type="number" class="form-control" name="rg_reads"
                       value="{{ old('rg_reads', $academic->rg_reads ?? '') }}" min="0">
            </div>
        </div>
    </div>
</div>

{{-- ── Additional Info ──────────────────────────────────────────── --}}
<div class="section-card">
    <div class="card-header"><i class="fa fa-info-circle me-1"></i> Additional Information</div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Research Projects</label>
                <textarea class="form-control" name="research_projects" rows="4"
                          placeholder="One project per line">{{ old('research_projects', isset($academic) && $academic->research_projects ? implode("\n", $academic->research_projects) : '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Professional Memberships</label>
                <textarea class="form-control" name="memberships" rows="4"
                          placeholder="One membership per line">{{ old('memberships', isset($academic) && $academic->memberships ? implode("\n", $academic->memberships) : '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">University Activities</label>
                <textarea class="form-control" name="university_activities" rows="3"
                          placeholder="One activity per line">{{ old('university_activities', isset($academic) && $academic->university_activities ? implode("\n", $academic->university_activities) : '') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Courses Teaching</label>
                <div class="table-responsive">
                    <table class="table table-sm align-middle" id="coursesTeachingTable">
                        <thead class="table-light">
                            <tr>
                                <th style="width:90px">Year</th>
                                <th style="width:160px">Course Code</th>
                                <th>Course Name</th>
                                <th style="width:50px"></th>
                            </tr>
                        </thead>
                        <tbody id="coursesTeachingBody">
                            @php
                                $ctRows = old('courses_teaching', isset($academic) ? ($academic->courses_teaching ?? []) : []);
                            @endphp
                            @forelse($ctRows as $ctIdx => $row)
                                @if(is_array($row))
                                <tr class="ct-row">
                                    <td><input type="text" class="form-control form-control-sm" name="courses_teaching[{{ $ctIdx }}][year]" value="{{ $row['year'] ?? '' }}" placeholder="2024"></td>
                                    <td><input type="text" class="form-control form-control-sm" name="courses_teaching[{{ $ctIdx }}][course_code]" value="{{ $row['course_code'] ?? '' }}" placeholder="EEE 3123"></td>
                                    <td><input type="text" class="form-control form-control-sm" name="courses_teaching[{{ $ctIdx }}][course_name]" value="{{ $row['course_name'] ?? '' }}" placeholder="Course name"></td>
                                    <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></td>
                                </tr>
                                @else
                                <tr class="ct-row">
                                    <td><input type="text" class="form-control form-control-sm" name="courses_teaching[{{ $ctIdx }}][year]" value="" placeholder="2024"></td>
                                    <td><input type="text" class="form-control form-control-sm" name="courses_teaching[{{ $ctIdx }}][course_code]" value="" placeholder="EEE 3123"></td>
                                    <td><input type="text" class="form-control form-control-sm" name="courses_teaching[{{ $ctIdx }}][course_name]" value="{{ $row }}" placeholder="Course name"></td>
                                    <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></td>
                                </tr>
                                @endif
                            @empty
                                <tr class="ct-row-placeholder"><td colspan="4" class="text-center text-muted" style="font-size:.82rem;padding:.5rem;">No entries yet. Click "Add Row" to begin.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addCTRow()">
                    <i class="fa fa-plus me-1"></i> Add Row
                </button>
                <div class="form-text">Year refers to the academic year (e.g. 2024/2025).</div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Consultations</label>
                <textarea class="form-control" name="consultations" rows="3"
                          placeholder="One item per line">{{ old('consultations', isset($academic) && $academic->consultations ? implode("\n", $academic->consultations) : '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Grant Evaluations</label>
                <textarea class="form-control" name="grant_evaluations" rows="3"
                          placeholder="One item per line">{{ old('grant_evaluations', isset($academic) && $academic->grant_evaluations ? implode("\n", $academic->grant_evaluations) : '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Industrial Experience</label>
                <textarea class="form-control" name="industrial_experience" rows="3">{{ old('industrial_experience', $academic->industrial_experience ?? '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Legacy Supervision Notes</label>
                <textarea class="form-control" name="supervision_info" rows="3" placeholder="Free-text supervision notes (legacy field)">{{ old('supervision_info', $academic->supervision_info ?? '') }}</textarea>
                <div class="form-text">Use the structured Supervision table below for new entries.</div>
            </div>
            <div class="col-12">
                <label class="form-label">Other Links</label>
                <div id="otherLinksContainer">
                    @php
                        $otherLinks = old('other_links_label')
                            ? null
                            : ($academic->other_links ?? []);
                    @endphp
                    @if($otherLinks)
                        @foreach($otherLinks as $link)
                        <div class="d-flex gap-2 mb-2 other-link-row">
                            <input type="text" class="form-control" name="other_links_label[]"
                                   placeholder="Label" value="{{ is_array($link) ? ($link['label'] ?? '') : $link }}">
                            <input type="text" class="form-control" name="other_links_url[]"
                                   placeholder="URL (https://...)" value="{{ is_array($link) ? ($link['url'] ?? '') : '' }}">
                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.other-link-row').remove()">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary mt-1" onclick="addLinkRow()">
                    <i class="fa fa-plus me-1"></i> Add Link
                </button>
                <div class="form-text">Each link needs a label and a URL.</div>
            </div>
        </div>
    </div>
</div>

{{-- ── Consultation Complete ──────────────────────────────────────── --}}
<div class="section-card">
    <div class="card-header"><i class="fa fa-handshake me-1"></i> Consultation Complete</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm align-middle" id="consultationCompleteTable">
                <thead class="table-light">
                    <tr>
                        <th style="width:80px">Year</th>
                        <th>Title</th>
                        <th style="width:180px">Membership</th>
                        <th style="width:180px">Funder</th>
                        <th style="width:50px"></th>
                    </tr>
                </thead>
                <tbody id="consultationCompleteBody">
                    @php
                        $ccRows = old('consultation_complete', isset($academic) ? ($academic->consultation_complete ?? []) : []);
                    @endphp
                    @forelse($ccRows as $ccIdx => $row)
                        <tr class="cc-row">
                            <td><input type="text" class="form-control form-control-sm" name="consultation_complete[{{ $ccIdx }}][year]" value="{{ is_array($row) ? ($row['year'] ?? '') : '' }}" placeholder="2023"></td>
                            <td><input type="text" class="form-control form-control-sm" name="consultation_complete[{{ $ccIdx }}][title]" value="{{ is_array($row) ? ($row['title'] ?? '') : '' }}" placeholder="Consultation title"></td>
                            <td><input type="text" class="form-control form-control-sm" name="consultation_complete[{{ $ccIdx }}][membership]" value="{{ is_array($row) ? ($row['membership'] ?? '') : '' }}" placeholder="Organisation"></td>
                            <td><input type="text" class="form-control form-control-sm" name="consultation_complete[{{ $ccIdx }}][funder]" value="{{ is_array($row) ? ($row['funder'] ?? '') : '' }}" placeholder="Funder"></td>
                            <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></td>
                        </tr>
                    @empty
                        <tr class="cc-row-placeholder"><td colspan="5" class="text-center text-muted" style="font-size:.82rem;padding:.5rem;">No entries yet. Click "Add Row" to begin.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addCCRow()">
            <i class="fa fa-plus me-1"></i> Add Row
        </button>
    </div>
</div>

{{-- ── Intellectual Properties ───────────────────────────────────── --}}
<div class="section-card">
    <div class="card-header"><i class="fa fa-lightbulb me-1"></i> Intellectual Properties</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm align-middle" id="ipTable">
                <thead class="table-light">
                    <tr>
                        <th style="width:80px">Year</th>
                        <th style="width:130px">Reference No.</th>
                        <th style="width:130px">IP Type</th>
                        <th>Title</th>
                        <th style="width:120px">Status</th>
                        <th style="width:50px"></th>
                    </tr>
                </thead>
                <tbody id="ipBody">
                    @php
                        $ipRows = old('intellectual_properties', isset($academic) ? ($academic->intellectual_properties ?? []) : []);
                    @endphp
                    @forelse($ipRows as $ipIdx => $row)
                        <tr class="ip-row">
                            <td><input type="text" class="form-control form-control-sm" name="intellectual_properties[{{ $ipIdx }}][year]" value="{{ is_array($row) ? ($row['year'] ?? '') : '' }}" placeholder="2023"></td>
                            <td><input type="text" class="form-control form-control-sm" name="intellectual_properties[{{ $ipIdx }}][reference_no]" value="{{ is_array($row) ? ($row['reference_no'] ?? '') : '' }}" placeholder="PI2023001234"></td>
                            <td><input type="text" class="form-control form-control-sm" name="intellectual_properties[{{ $ipIdx }}][ip_type]" value="{{ is_array($row) ? ($row['ip_type'] ?? '') : '' }}" placeholder="Patent / Copyright"></td>
                            <td><input type="text" class="form-control form-control-sm" name="intellectual_properties[{{ $ipIdx }}][title]" value="{{ is_array($row) ? ($row['title'] ?? '') : '' }}" placeholder="IP title"></td>
                            <td><input type="text" class="form-control form-control-sm" name="intellectual_properties[{{ $ipIdx }}][status_ip]" value="{{ is_array($row) ? ($row['status_ip'] ?? '') : '' }}" placeholder="Granted"></td>
                            <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></td>
                        </tr>
                    @empty
                        <tr class="ip-row-placeholder"><td colspan="6" class="text-center text-muted" style="font-size:.82rem;padding:.5rem;">No entries yet. Click "Add Row" to begin.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addIPRow()">
            <i class="fa fa-plus me-1"></i> Add Row
        </button>
    </div>
</div>

{{-- ── Supervision (Structured) ──────────────────────────────────── --}}
<div class="section-card">
    <div class="card-header"><i class="fa fa-user-graduate me-1"></i> Supervision</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm align-middle" id="supervisionTable">
                <thead class="table-light">
                    <tr>
                        <th style="width:75px">Year</th>
                        <th style="width:160px">Student Name</th>
                        <th style="width:100px">Level</th>
                        <th>Title</th>
                        <th style="width:110px">Status</th>
                        <th style="width:130px">Repository URL</th>
                        <th style="width:50px"></th>
                    </tr>
                </thead>
                <tbody id="supervisionBody">
                    @php
                        $supRows = old('supervision', isset($academic) ? ($academic->supervision ?? []) : []);
                    @endphp
                    @forelse($supRows as $supIdx => $row)
                        <tr class="sup-row">
                            <td><input type="text" class="form-control form-control-sm" name="supervision[{{ $supIdx }}][year]" value="{{ is_array($row) ? ($row['year'] ?? '') : '' }}" placeholder="2023"></td>
                            <td><input type="text" class="form-control form-control-sm" name="supervision[{{ $supIdx }}][student_name]" value="{{ is_array($row) ? ($row['student_name'] ?? '') : '' }}" placeholder="Student name"></td>
                            <td><input type="text" class="form-control form-control-sm" name="supervision[{{ $supIdx }}][level]" value="{{ is_array($row) ? ($row['level'] ?? '') : '' }}" placeholder="PhD / MSc"></td>
                            <td><input type="text" class="form-control form-control-sm" name="supervision[{{ $supIdx }}][title]" value="{{ is_array($row) ? ($row['title'] ?? '') : '' }}" placeholder="Thesis title"></td>
                            <td><input type="text" class="form-control form-control-sm" name="supervision[{{ $supIdx }}][status]" value="{{ is_array($row) ? ($row['status'] ?? '') : '' }}" placeholder="Completed"></td>
                            <td><input type="url" class="form-control form-control-sm" name="supervision[{{ $supIdx }}][repository_url]" value="{{ is_array($row) ? ($row['repository_url'] ?? '') : '' }}" placeholder="https://..."></td>
                            <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></td>
                        </tr>
                    @empty
                        <tr class="sup-row-placeholder"><td colspan="7" class="text-center text-muted" style="font-size:.82rem;padding:.5rem;">No entries yet. Click "Add Row" to begin.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSupRow()">
            <i class="fa fa-plus me-1"></i> Add Row
        </button>
    </div>
</div>

<script>
function addCCRow() {
    document.querySelector('.cc-row-placeholder')?.remove();
    const tbody = document.getElementById('consultationCompleteBody');
    const idx = tbody.querySelectorAll('tr.cc-row').length;
    const tr = document.createElement('tr');
    tr.className = 'cc-row';
    tr.innerHTML = `
        <td><input type="text" class="form-control form-control-sm" name="consultation_complete[${idx}][year]" placeholder="2023"></td>
        <td><input type="text" class="form-control form-control-sm" name="consultation_complete[${idx}][title]" placeholder="Consultation title"></td>
        <td><input type="text" class="form-control form-control-sm" name="consultation_complete[${idx}][membership]" placeholder="Organisation"></td>
        <td><input type="text" class="form-control form-control-sm" name="consultation_complete[${idx}][funder]" placeholder="Funder"></td>
        <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></td>`;
    tbody.appendChild(tr);
}
function addIPRow() {
    document.querySelector('.ip-row-placeholder')?.remove();
    const tbody = document.getElementById('ipBody');
    const idx = tbody.querySelectorAll('tr.ip-row').length;
    const tr = document.createElement('tr');
    tr.className = 'ip-row';
    tr.innerHTML = `
        <td><input type="text" class="form-control form-control-sm" name="intellectual_properties[${idx}][year]" placeholder="2023"></td>
        <td><input type="text" class="form-control form-control-sm" name="intellectual_properties[${idx}][reference_no]" placeholder="PI2023001234"></td>
        <td><input type="text" class="form-control form-control-sm" name="intellectual_properties[${idx}][ip_type]" placeholder="Patent / Copyright"></td>
        <td><input type="text" class="form-control form-control-sm" name="intellectual_properties[${idx}][title]" placeholder="IP title"></td>
        <td><input type="text" class="form-control form-control-sm" name="intellectual_properties[${idx}][status_ip]" placeholder="Granted"></td>
        <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></td>`;
    tbody.appendChild(tr);
}
function addSupRow() {
    document.querySelector('.sup-row-placeholder')?.remove();
    const tbody = document.getElementById('supervisionBody');
    const idx = tbody.querySelectorAll('tr.sup-row').length;
    const tr = document.createElement('tr');
    tr.className = 'sup-row';
    tr.innerHTML = `
        <td><input type="text" class="form-control form-control-sm" name="supervision[${idx}][year]" placeholder="2023"></td>
        <td><input type="text" class="form-control form-control-sm" name="supervision[${idx}][student_name]" placeholder="Student name"></td>
        <td><input type="text" class="form-control form-control-sm" name="supervision[${idx}][level]" placeholder="PhD / MSc"></td>
        <td><input type="text" class="form-control form-control-sm" name="supervision[${idx}][title]" placeholder="Thesis title"></td>
        <td><input type="text" class="form-control form-control-sm" name="supervision[${idx}][status]" placeholder="Completed"></td>
        <td><input type="url" class="form-control form-control-sm" name="supervision[${idx}][repository_url]" placeholder="https://..."></td>
        <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></td>`;
    tbody.appendChild(tr);
}
function addCTRow() {
    document.querySelector('.ct-row-placeholder')?.remove();
    const tbody = document.getElementById('coursesTeachingBody');
    const idx = tbody.querySelectorAll('tr.ct-row').length;
    const tr = document.createElement('tr');
    tr.className = 'ct-row';
    tr.innerHTML = `
        <td><input type="text" class="form-control form-control-sm" name="courses_teaching[${idx}][year]" placeholder="2024/2025"></td>
        <td><input type="text" class="form-control form-control-sm" name="courses_teaching[${idx}][course_code]" placeholder="EEE 3123"></td>
        <td><input type="text" class="form-control form-control-sm" name="courses_teaching[${idx}][course_name]" placeholder="Course name"></td>
        <td><button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></td>`;
    tbody.appendChild(tr);
}
</script>
