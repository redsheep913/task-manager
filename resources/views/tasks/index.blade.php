<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('我的任務') }}
            </h2>
            <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                新增任務
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($tasks->isEmpty())
                        <p class="text-gray-500">您目前沒有任何任務。</p>
                    @else
                        <div class="grid gap-4">
                            @foreach ($tasks as $task)
                                <div class="border p-4 rounded {{ $task->is_completed ? 'bg-gray-100' : '' }}">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-semibold {{ $task->is_completed ? 'line-through text-gray-500' : '' }}">
                                                {{ $task->title }}
                                            </h3>
                                            @if ($task->description)
                                                <p class="text-gray-600 mt-1">{{ $task->description }}</p>
                                            @endif
                                            @if ($task->due_date)
                                                <p class="text-sm text-gray-500 mt-2">
                                                    期限：{{ $task->due_date->format('Y-m-d') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="flex space-x-2">
                                            <form action="{{ route('tasks.toggle-complete', $task) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-blue-500 hover:text-blue-700">
                                                    {{ $task->is_completed ? '標記為未完成' : '標記為完成' }}
                                                </button>
                                            </form>
                                            <a href="{{ route('tasks.edit', $task) }}" class="text-yellow-500 hover:text-yellow-700">
                                                編輯
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('確定要刪除這個任務嗎？');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700">
                                                    刪除
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
