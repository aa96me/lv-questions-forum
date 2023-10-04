@extends('frontend.layout_app')

@section('content')
    <div id="section_featured">
        <section class="mb-4 mt-4">
            <div class="container">
                <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th class="text-center">Answers</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $key => $question)
                                <tr>
                                    <td>
                                        <a href="{{ route('question', $question->slug) }}">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    @if(strlen($question->question)>80)
                                                    <span>{{mb_substr($question->question, 0, 80,'utf-8').".." }}</span>
                                                    @else
                                                    <span>{{$question->question }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="text-center">{{count($question->answers)}}</td>
                                  </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style=" display: flex; justify-content: space-between;">
                        <div class="paginatiion">
                            {{ $questions->appends(request()->input())->links() }}
                        </div>
		            </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('script')
@endsection
