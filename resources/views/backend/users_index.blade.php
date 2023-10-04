@extends('backend.layout_app')

@section('content')


<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Users list</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th class="text-left">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $user)
                        <tr>
                            <td>{{ ($key+1) + ($users->currentPage() - 1)*$users->perPage() }}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td class="text-left">
                               <a href="{{route('users.delete', $user->id)}}" class="btn btn-soft-danger btn-icon btn-circle btn-sm" title="delete">
                                   <i class="las la-trash"></i>
                               </a>
                           </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
        <div class="paginatiion">
            {{ $users->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection
