@extends('backend.layout_app')

@section('content')

<div class="titlebar2 text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<a href="{{ route('questions.create') }}" class="btn btn-info">
    			<span>New question</span>
    		</a>
		</div>
	</div>
</div>
<br>
<div class="card">
	<form class="" id="sort_questions" action="" method="GET">
		<div class="card-header row gutters-5">
			<div class="col text-center text-md-left">
				<h5 class="mb-md-0">Questions</h5>
			</div>
            <div class="col-md-3">
                <select class="form-control @isset($publication) @if($publication != 'all') controlselect @endif @endisset" name="publication" onchange="sort_questions()">
                    <option value="all" @isset($publication) @if($publication == 'all') selected @endif @endisset>All</option>
                    <option value="1" @isset($publication) @if($publication == '1') selected @endif @endisset>Published</option>
                    <option value="0" @isset($publication) @if($publication == '0') selected @endif @endisset>Unpublished</option>
                </select>
            </div>
		</div>
	</form>
    <div class="card-body">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th> </th>
                    <th>Published</th>
                    <th class="text-left">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $key => $question)
                    <tr>
                        <td>{{ ($key+1) + ($questions->currentPage() - 1)*$questions->perPage() }}</td>
                        <td>
                            <a href="{{ route('question', $question->slug) }}" target="_blank">
								<div class="row">
									<div class="col-md-12">
										<span class="text-muted">{{ $question->question }}</span>
                                    </div>
								</div>
							</a>
                            <span>{{ $question->description }}</span>
                        </td>
                        <td>
							<label class="siwitch siwitch-success mb-0">
                              <input onchange="update_published(this)" value="{{ $question->id }}" type="checkbox" <?php if($question->published == 1) echo "checked";?> >
                              <span class="slider round"></span>
							</label>
						</td>
						<td class="text-left">
		                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('questions.edit', ['id'=>$question->id] )}}" title="Edit">
		                        <i class="las la-edit"></i>
		                    </a>
                           <a href="{{route('questions.delete', $question->id)}}" class="btn btn-soft-danger btn-icon btn-circle btn-sm" title="Delete">
                              <i class="las la-trash"></i>
                           </a>
                      </td>
                  	</tr>
                @endforeach
            </tbody>
        </table>

        <div style=" display: flex; justify-content: space-between;">
        <div class="paginatiion ">
            {{ $questions->appends(request()->input())->links() }}
        </div>
		</div>
    </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('questions.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    OBJ.tools.notify('success', 'Published successfully');
                }
                else{
                    OBJ.tools.notify('danger', 'Something is wrong!');
                }
            });
            //location.reload();
        }

        function sort_questions(num){
            $('#sort_questions').submit();
        }

    </script>
@endsection
