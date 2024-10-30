<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Show Drive for : {{$driveData->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container col-md-10">
                        <a class="btn btn-info" href="{{route('drive.index')}}">Back</a>
                        <div class="card mt-4">
                            <div class="card-body">
                                @if($driveData->file_type == 'jpg' || $driveData->file_type == 'PNG' || $driveData->file_type == 'jif')
                                <img width="120" src="{{asset("upload/$driveData->file")}}" alt="">                                
                                @endif
                                <h6>Drive Description : {{$driveData->description}}</h6>
                                <hr>
                                <h6>Drive created by : {{$driveData->name}}</h6>
                                <hr>
                                <h6>Drive created_at : {{$driveData->created_at}}</h6>
                                <hr>
                                <h6>Drive file_type : {{$driveData->file_type}}</h6>
                                <hr>
                                <a href="{{route('drive.download', $driveData->drive_id)}}" class="my-3 btn btn-info">Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
