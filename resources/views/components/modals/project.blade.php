@props(['buttonText', 'title', 'project', 'service'])

<!-- Button trigger modal -->
<button type="button" class="btn btn-dark" data-bs-toggle="modal"
    data-bs-target="#{{ $id = 'project-modal' }}" required>
    {{ $buttonText ?? (isset($project) ? 'Update project' : 'Create a new project') }}
</button>

<!-- Modal -->
<div class="modal fade" id="{{ $id }}" tabindex="-1"
    aria-labelledby="{{ $id }}-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
  	        <form id="projects-form-{{ $id }}"
                action="{{ isset($project) ? route('project.update', ['project' => $project]) : route('projects.store') }}"
                method="POST">
                @csrf
                @isset($project)
                    @method('PATCH')
                @endisset
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $id }}-label">
                        {{ $title ?? (isset($project) ? 'Update this project' : 'Create new project') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="">Name</label>
                            <br>
                            <input name="name" type="text"
                                class="form-control @error('name', $id) is-invalid @enderror"
                                placeholder="e.g Marketing Management"
                                value="{{ old('name') ?? ($project->name ?? (app()->environment('local') ? 'Marketing Management' : '')) }}"
                                required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button form="projects-form-{{ $id }}" type="submit" class="btn btn-success">
                        {{ $submitText ?? 'Submit' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@if ($errors->hasBag($id))
    @push('js')
        <script>
            var modal = new bootstrap.Modal(document.getElementById(`{{ $id }}`));
            modal.show();
        </script>
    @endpush
@endif
