<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Name : {{$user->name}}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User Rule : {{$user->rule->title}}
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
                        <a class="btn btn-info" href="{{route('listUsers')}}">Back</a>
                        <div class="card mt-4">
                            <div class="card-body">
                                <form action="{{route('update_rule', $user->id)}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="mx-2 fw-bold" for="">Choose Rull</label>
                                        <select class="form-control my-2" name="rule_id" id="">
                                            @foreach ($rules as $rule)
                                                @if($rule->id != 1){
                                                    <option value="{{$rule->id}}">{{$rule->title}}</option>
                                                }
                                                @endif
                                                
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="d-grid col-md-2 my-4">
                                        <button class="btn btn-info">
                                            Update User Rule
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