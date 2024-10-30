<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Rules
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
                        <a class="btn btn-info" href="{{route('rule.create')}}">Create New</a>
                        <div class="card mt-4">
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th colspan="2">Actioin</th>
                                    </tr>
                                    @foreach ($rules as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->description}}</td>
                                            <td><a class="text-decoration-none " href="{{route('rule.edit', $item->id)}}">Edit</a></td>
                                            <td><a class="text-decoration-none " href="{{route('rule.destroy', $item->id)}}">Delete</a></td>
                                        </tr>

                                    @endforeach
                                </table>
                            </div>
                            <div class="mx-3">
                            {{ $rules->links('pagination::bootstrap-4') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>