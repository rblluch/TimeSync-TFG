@extends('layouts.template')

@section('title', 'Home - TimeSync')

@section('content')

<div class="flex flex-col items-center">
    <nav class="bg-yellow-300 h-20 w-3/4 flex items-center">
        @include('home._subbar_home')
    </nav>


    <div id="tasksTable" class="w-3/4 flex items-start bg-red-700">
        @if(isset($tasks))
            @foreach ($tasks as $task)
                @include('layouts.task')
            @endforeach
        @endif
    </div>
</div>


@endsection

@section('scripts')
<script src="../resources/js/home.js" ></script>

@endsection