<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('任務詳情') }}
            </h2>
            <a href="{{ route('tasks.index') }}" class="text-blue-500 hover:text-blue-700">
                返回任務列表
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-2xl font-semibold {{ $task->is_completed ? 'line-through text-gray-500' : '' }}">
                            {{ $task->title }}
                        </h3>
                        <div class="flex items-center space-x-2 mt-2">
                            <span class="px-2 py-1 text-xs rounded {{ $task->is_completed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $task->is_completed ? '已完成' : '進行中' }}
                            </span>
                            @if ($task->due_date)
                                <span class="px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded">
                                    期限：{{ $task->due_date->format('Y-m-d') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    @if ($task->description)
                        <div class="bg-gray-50 p-4 rounded mb-6">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">描述</h4>
                            <p class="text-gray-700">{{ $task->description }}</p>
                        </div>
                    @endif

                    <div class="bg-gray-50 p-4 rounded mb-6">
                        <h4 class="text-sm font-medium text-gray-500 mb-2">創建/更新資訊</h4>
                        <p class="text-gray-700 text-sm">創建於：{{ $task->created_at->format('Y-m-d H:i') }}</p>
                        <p class="text-gray-700 text-sm">最後更新：{{ $task->updated_at->format('Y-m-d H:i') }}</p>
                    </div>

                    <div class="flex space-x-4 mt-6">
                        <form action="{{ route('tasks.toggle-complete', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                {{ $task->is_completed ? '標記為未完成' : '標記為完成' }}
                            </button>
                        </form>

                        <a href="{{ route('tasks.edit', $task) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            編輯
                        </a>

                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('確定要刪除這個任務嗎？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                刪除
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
