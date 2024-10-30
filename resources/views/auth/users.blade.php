<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            List Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container col-md-10">
                        @if (Session::has('done'))
                            <div class="alert alert-success">
                                {{Session::get('done')}}
                            </div>
                        @endif
                        <div class="card mt-4">
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Rule</th>
                                        <th>Edit Rule</th>


                                    </tr>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->rule->title}}</td>
                                            <td><a class="text-decoration-none" href="{{route('edit_user_rule', $item->id)}}">Edit</a></td>
                                        </tr>

                                    @endforeach
                                </table>
                            </div>
                            <div class="mx-3">
                            {{ $users->links('pagination::bootstrap-4') }}
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>