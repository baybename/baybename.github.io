{{-- hiển thị bố cục trong file app của thư mục layout --}}
@extends('layout.app')

@section('title', $task->title)

@section('content')
<div class="mb-4">
    <a href="{{route('task.index')}}"
    class="link">⇽ go back to the task list!</a>
</div>
{{-- các đoạn mã viết sau dòng này sẽ được bao trong content, --}}

{{-- hiển thị sự miêu tả thuộc tính được khai báo trong web.php ở phần new task--}}
<p class="mb-4 text-slate-700">{{ $task->description }}</p>

{{-- hiển thị chuỗi văn bản thuộc tính --}}
@if ($task->long_description)
    <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
@endif

{{-- hiển thị thời gian --}}
    <p class="mb-4 text-sm text-slate-500">create{{ $task->created_at->diffForHumans() }} 𐤟 
        updated{{ $task->updated_at->diffForHumans() }}</p>
{{-- trả về khoảng thời gian update từ luc up đến hiệ tại  --}}
<p class="mb-4">
    @if($task->completed)
        <span class="font-medium text-green-500">Completed</span>
    @else
    <span class="font-medium text-red-500">No completed</span>
    @endif

</p>


    <div class="flex gap-2">
        <a href="{{ route('task.edit', ['task' => $task]) }}"
            class="btn">Edit</a>

        <form method="POST" action="{{ route('task.toggle-complete', ['task' => $task])}}">
        @csrf
        @method('PUT')
        <button type="submit" class="btn">
            Mark as {{ $task->completed ? 'not completed' : 'completed' }}
        </button>
    </form>

        <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">Delete</button>
        </form>
    </div>
@endsection