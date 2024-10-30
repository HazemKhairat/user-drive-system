<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Edit Rule : {{$rule->title}}
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
                        <a class="btn btn-info" href="{{route('rule.index')}}">Back</a>
                        <div class="card mt-4">
                            <div class="card-body">
                                <form action="{{route('rule.update', $rule->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" value="{{$rule->title}}" name="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <input type="text" value="{{$rule->description}}"  name="description" class="form-control">
                                    </div>
                                    <div class="d-grid col-md-6 my-4 mx-auto">
                                        <button class="btn btn-info">
                                            Update Rule
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
