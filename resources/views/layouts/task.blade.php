
@php

    $bgColor = 'white';

    if($task['status'] === 'in_progress'){
        $bgColor = 'green-100';
    }

    $finalColor = 'bg-'.$bgColor;

@endphp

<div class="max-w-sm p-6 {{$finalColor}} border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $task['name'] }}</h5>
    </a>
    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $task['description'] }}</p>

    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
        Servicio: {{ $task->service->name }}
    </p>

    @if($task['scheduled_date'])
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Fecha límite: {{ $task['scheduled_date'] }}</p>
    @endif
    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Ver más
        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
    </a>
    @if($task['status'] === 'pending')
        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-center text-white bg-yellow-500 rounded-full dark:bg-yellow-600">
            Pendiente
        </span>
    @elseif($task['status'] === 'in_progress')
        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-center text-white bg-blue-500 rounded-full dark:bg-blue-600">
            En progreso
        </span>
    @elseif($task['status'] === 'completed')
        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-center text-white bg-green-500 rounded-full dark:bg-green-600">
            Completado
        </span>
    @else
        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-center text-white bg-red-500 rounded-full dark:bg-red-600">
            Cancelado
        </span>
    @endif
</div>

<script src="https://cdn.tailwindcss.com"></script>