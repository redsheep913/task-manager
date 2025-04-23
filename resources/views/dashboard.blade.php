<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('儀表板') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">歡迎回來，{{ Auth::user()->name }}！</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-100 p-4 rounded shadow">
                            <h4 class="font-medium">總任務數</h4>
                            <p class="text-2xl font-bold">{{ Auth::user()->tasks()->count() }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded shadow">
                            <h4 class="font-medium">已完成任務</h4>
                            <p class="text-2xl font-bold">{{ Auth::user()->tasks()->where('is_completed', true)->count() }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded shadow">
                            <h4 class="font-medium">待完成任務</h4>
                            <p class="text-2xl font-bold">{{ Auth::user()->tasks()->where('is_completed', false)->count() }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('tasks.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            查看我的任務
                        </a>
                        <a href="{{ route('tasks.create') }}" class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            創建新任務
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
