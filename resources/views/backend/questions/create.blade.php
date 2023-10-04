@extends('backend.layout_app')

@section('content')
<div class="col-md-10 mx-auto">
	<form class="form form-horizontal mar-top" action="{{route('questions.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
		@csrf
		<div class="card">
			<div class="card-body">
				<div class="form-group row">
					<label class="col-md-3 col-from-label">Question<span class="text-danger">*</span></label>
					<div class="col-md-8">
						<input type="text" name="question" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3 col-from-label">Description<span class="text-danger">*</span></label>
					<div class="col-md-8">
						<textarea class="form-control" rows="4" name="description"></textarea>
					</div>
				</div>

			</div>
		</div>

		<div class="mb-3 text-right">
			<button type="submit" name="button" class="btn btn-primary">Add</button>
		</div>
	</form>
</div>
@endsection
