@extends('layout.app')

@section('title', 'The list of tasks')

@section('content')
        <nav class="mb-4">
                <a href="{{route('tasks.create')}}" class="link">Add Task!</a>
        </nav>
<div>

        @forelse ($tasks as $task)
        <div>
        <a href="{{ route('task.show', ['task' => $task->id]) }}" 
        @class(['line-through' => $task->completed])>{{ $task -> title }}</a>
</div> 
        @empty
        <div>không có tasks nào cả</div>
        @endforelse

        @if ($tasks->count())
        <nav class="mt-4">
                {{ $tasks->links() }}
        </nav>
{{-- thẻ nav tạo thành phần điều hướng cho trang web --}}
        @endif
        {{-- @endif --}}
@endsection