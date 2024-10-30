<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Edit Driev : {{$drives->file}}
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
                        <a class="btn btn-info" href="{{route('drive.index')}}">Back</a>
                        <div class="card mt-4">
                            <div class="card-body">
                                <form action="{{route('drive.update', $drives->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" value="{{$drives->title}}" name="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <input type="text" value="{{$drives->description}}"  name="description" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">File : {{$drives->file}}</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                    <div class="d-grid col-md-6 my-4 mx-auto">
                                        <button class="btn btn-info">
                                            Update File
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
