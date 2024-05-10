@extends('layouts.template')

@section('title', $task->name . ' - TimeSync')

@section('content')

    <div class="container flex mx-auto justify-center items-center">
        <div class="@if($task->status == 'in_progress') bg-green-100 @else bg-white @endif shadow-md rounded my-6 w-2/3">
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-2">{{ $task->name }}</h2>
                <p class="text-gray-600 mb-4">{{ $task->description }}</p>
                <p class="mb-4"><span class="font-semibold">Servicio: </span>{{ $task->service->name }}</p>
                <div class="flex mb-4">
                    <div class="w-1/2">
                        <p><span class="font-semibold">Horas totales asignadas al Servicio: </span> {{ ($task->service->total_hours ?? '0').'h' }}</p>
                        <p class="@if($task->service->hours_used > $task->service->total_hours) text-red-600 @endif">
                            <span class="font-semibold">Horas totales usadas: </span> {{ ($task->service->hours_used ?? '0').'h' }}
                        </p>
                        <hr>
                        <p><span class="font-semibold">Horas usadas en esta tarea: </span> {{ ($task->hours ?? '0').'h' }}</p>

                        <p><span class="font-semibold">Estado:</span>
                            
                            <button>            
                                @if ($task['status'] === 'pending')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-center text-white bg-yellow-500 rounded-full dark:bg-yellow-600">
                                        Pendiente
                                    </span>
                                @elseif($task['status'] === 'in_progress')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-center text-white bg-blue-500 rounded-full dark:bg-blue-600">
                                        En progreso
                                    </span>
                                @elseif($task['status'] === 'completed')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-center text-white bg-green-500 rounded-full dark:bg-green-600">
                                        Completado
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-center text-white bg-red-500 rounded-full dark:bg-red-600">
                                        Cancelado
                                    </span>
                                @endif
                            
                            </button>
                        
                        </p>
                    </div>
                </div>
                <div class="flex">
                    @if($task->status == 'pending' || $task->status == 'in_progress') 
                        <a href="{{ route('task.status', $task->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mr-2 rounded">{{($task->status == 'pending' ? 'Iniciar' : 'Finalizar')}}</a>
                        @endif
                    @if($task->status == 'in_progress') 
                        <a href="{{ route('task.complete', $task->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 mr-2 rounded">Terminar parte</a>
                    @endif
                    @if(auth()->user()->hasAnyRole(['timesync_admin', 'superadmin', 'admin']))
                        <a href="{{-- {{ route('task.update', $task->id) }} --}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-2 rounded">Editar</a>
                        @if(!auth()->user()->hasAnyRole(['admin']))
                            <a href="{{ route('task.delete', $task->id) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mr-2 rounded">Eliminar</a>
                        @endif
                    @endif
                    <a href="{{ route('task.cancel', $task->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 mr-2 rounded">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    
    
@endsection
