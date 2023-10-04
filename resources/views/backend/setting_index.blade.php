@extends('backend.layout_app')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 h6 text-center">Maintenance Mode Activation</h3>
                </div>
                <div class="card-body text-center">
                    <label class="siwitch siwitch-success mb-0">
                        <input type="checkbox" onchange="updateSettings(this, 'maintenance_mode')" <?php if (\App\Models\Setting::where('type', 'maintenance_mode')->first()->value == 1) {
                            echo 'checked';
                        } ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        <div class="card">
            <div class="card-header">
                <h6 class="fw-600 mb-0">Settings</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">Site Name</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="site_name">
                            <input type="text" class="form-control" placeholder="Title" name="site_name"
                                value="{{ env('APP_NAME') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">Meta Description</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="meta_description">
                            <textarea class="resize-off form-control" placeholder="Description" name="meta_description">{{ get_setting('meta_description') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">Keywords</label>
                        <div class="col-md-8">
                            <input type="hidden" name="types[]" value="meta_keywords">
                            <textarea class="resize-off form-control" placeholder="Keyword, Keyword" name="meta_keywords">{{ get_setting('meta_keywords') }}</textarea>
                            <small class="text-muted">Separate with coma</small>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function updateSettings(el, type) {
            if ($(el).is(':checked')) {
                var value = 1;
            } else {
                var value = 0;
            }
            $.post('{{ route('settings.maintenance') }}', {
                _token: '{{ csrf_token() }}',
                type: type,
                value: value
            }, function(data) {
                if (data == '1') {
                    OBJ.tools.notify('success', 'Settings updated successfully');
                } else {
                    OBJ.tools.notify('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
