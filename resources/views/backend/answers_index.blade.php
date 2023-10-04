@extends('backend.layout_app')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Answers</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Author</th>
                    <th>Answer</th>
                    <th>Status</th>
                    <th class="text-left">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($answers as $key => $answer)
                    @if ($answer->question != null && $answer->user != null)
                        <tr>
                            <td>{{ $answer->id }}</td>
                            <td>
                                <a href="{{ route('question', $answer->question->slug) }}" target="_blank" class="text-reset text-truncate-2">{{ $answer->question->question }}</a>
                            </td>
                            <td>{{ $answer->user->name }} ({{ $answer->user->email }})</td>
                            <td>{{ $answer->comment }}</td>
                            <td><label class="siwitch siwitch-success mb-0">
                                <input onchange="update_published(this)" value="{{ $answer->id }}" type="checkbox" <?php if($answer->status == 1) echo "checked";?> >
                                <span class="slider round"></span></label>
                            </td>
                            <td class="text-left">
                                <a href="{{route('answers.delete', $answer->id)}}" class="btn btn-soft-danger btn-icon btn-circle btn-sm" title="delete">
                                    <i class="las la-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @elseif ($answer->user_id == 0)
                        <tr style=" background-color: #ffd; ">
                            <td>{{ $answer->id }}</td>
                            <td>
                                <a href="{{ route('question', $answer->question->slug) }}" target="_blank" class="text-reset text-truncate-2">{{ $answer->question->question }}</a>
                            </td>
                            <td>{{ $answer->writer }} (guest)</td>
                            <td>{{ $answer->comment }}</td>
                            <td>
                                <label class="siwitch siwitch-success mb-0">
                                <input onchange="update_published(this)" value="{{ $answer->id }}" type="checkbox" <?php if($answer->status == 1) echo "checked";?> >
                                <span class="slider round"></span></label>
                            </td>
                            <td class="text-left">
                                <a href="{{route('answers.delete', $answer->id)}}" class="btn btn-soft-danger btn-icon btn-circle btn-sm" title="delete">
                                    <i class="las la-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endif

                @endforeach
            </tbody>
        </table>
        <div class="paginatiion">
            {{ $answers->appends(request()->input())->links() }}
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('answers.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    OBJ.tools.notify('success', 'Published answer updated successfully');
                }
                else{
                    OBJ.tools.notify('danger', 'Something went wrong');
                }
            });
        }
        function filter_by_rating(el){
            var rating = $('#rating').val();
            if (rating != '') {
                $('#sort_by_rating').submit();
            }
        }
    </script>
@endsection
