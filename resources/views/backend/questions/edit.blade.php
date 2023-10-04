@extends('backend.layout_app')

@section('content')

<div class="col-lg-12 mx-auto">
	<form class="form form-horizontal mar-top" action="{{route('questions.update', $question->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
		<input name="_method" type="hidden" value="POST">
		@csrf
        <input type="text" class="form-control" name="question" value="{{$question->question}}" required></td>
        <input type="text" class="form-control" name="description" value="{{$question->description}}" required></td>
		<div class="mb-3 text-right">
			<button type="submit" name="button" class="btn btn-info">Update</button>
		</div>
	</form>
</div>

@endsection
