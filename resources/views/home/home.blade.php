@extends('layouts.template')

@section('title', 'Home - TimeSync')

@section('content')

<div class="flex flex-col items-center home-wrapper">

{{-- colored --}}
{{-- <div class="flex flex-col items-center bg-green-700 home-wrapper"> --}}

    <nav class="fixed top-24 bg-gray-200 h-32 w-3/4 flex items-center mb-38">

    {{-- colored --}}
    {{-- <nav class="bg-yellow-300 fixed top-22 h-20 w-3/4 flex items-center mb-38"> --}}

        @include('home._subbar_home')
    </nav>


    <div id="tasksTable" class="tasksTable w-3/4 h-full mt-48 flex flex-wrap justify-start gap-8 mt-10 pt-10 pl-4 pb-4">

    {{-- colored --}}
    {{-- <div id="tasksTable" class="tasksTable w-3/4 h-full flex flex-wrap justify-start gap-8 bg-red-800 mt-10 pt-10 pl-4 pb-4"> --}}
        
        @if(isset($tasks))
            @foreach ($tasks as $task)
                @include('tasks.task')
            @endforeach
        @endif
    </div>


    <div id="formNewTask">
        {{-- @include('tasks.task_new') --}}
    </div>

</div>


@endsection

@section('scripts')
{{-- <script src="../resources/js/header.js" ></script>
--}}
@endsection