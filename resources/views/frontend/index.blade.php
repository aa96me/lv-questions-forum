@extends('frontend.layout_app')

@section('content')
    <div id="section_featured">
        <section class="mb-4 mt-4">
            <div class="container">
                <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr style=" background-color: #de4e07; color: #fff;">
                                <th>Recently added questions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $key => $question)
                                <tr> <!--{ { ($key+1) + ($products->currentPage() - 1)*$products->perPage() } }-->
                                    <td>
                                        <a href="{{ route('question', $question->slug) }}">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if(strlen($question->question)>80)
                                                    <h3>{{mb_substr($question->question, 0, 80,'utf-8').".." }}</h3>
                                                    @else
                                                    <h3>{{$question->question }}</h3>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                        Answers  : {{count($question->answers)}}
                                    </td>
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
