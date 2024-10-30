<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Your All Drievs
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
                        <a class="btn btn-info" href="{{route('drive.create')}}">Create New</a>
                        <div class="card mt-4">
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th colspan="3">Actioins</th>
                                        <th>Status</th>

                                    </tr>
                                    @foreach ($drives as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->title}}</td>
                                            <td><a class="text-decoration-none " href="{{route('drive.show', $item->id)}}">Show</a></td>
                                            <td><a class="text-decoration-none " href="{{route('drive.edit', $item->id)}}">Edit</a></td>
                                            <td><a class="text-decoration-none" href="{{route('drive.destroy', $item->id)}}">Delete</a></td>
                                            @if ($item->status == 'private')
                                                <td><a class=" text text-danger text-decoration-none"
                                                        href="{{route('drive.change_status', $item->id)}}">{{$item->status}}</a>
                                                </td>
                                            @else
                                                <td><a class="text text-success text-decoration-none"
                                                        href="{{route('drive.change_status', $item->id)}}">{{$item->status}}</a>
                                                </td>
                                            @endif

                                        </tr>

                                    @endforeach
                                </table>
                            </div>
                            <div class="mx-3">
                            {{ $drives->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>