<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            <!-- Search form -->
            <form method="GET" action="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search notes..."
                    class="rounded border border-gray-300 px-4 py-2 text-sm text-gray-800 dark:text-gray-100 dark:bg-gray-900 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                <button
                    type="submit"
                    class="rounded bg-indigo-600 px-3 py-2 text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400"
                >
                    Search
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-show="show"
                    x-transition
                >
                    @if (session('registered'))
                        <div
                            class="mb-4 w-full rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-sm font-medium text-green-800 shadow-md dark:border-green-600 dark:bg-green-900 dark:text-green-100"
                            role="alert"
                        >
                            🎉 You have registered successfully. Welcome!
                        </div>
                    @elseif (session('logged_in'))
                        <div
                            class="mb-4 w-full rounded-lg border border-blue-300 bg-blue-100 px-4 py-3 text-sm font-medium text-blue-800 shadow-md dark:border-blue-600 dark:bg-blue-900 dark:text-blue-100"
                        >
                            👋 Welcome back, {{ Auth::user()->name }}!
                        </div>
                    @endif
                </div>

                @if(session('success'))
                    <div
                        x-data="{ show: true }"
                        x-init="setTimeout(() => show = false, 4000)"
                        x-show="show"
                        x-transition
                        class="mb-6 w-full rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-sm font-medium text-green-800 shadow-md dark:border-green-600 dark:bg-green-900 dark:text-green-100"
                        role="alert"
                    >
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Search result message -->
                @if(request('search'))
                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                        Showing results for: <strong>{{ request('search') }}</strong>
                    </p>
                @endif

                <div class="mb-6">
                    <a href="{{ route('notes.create') }}"
                       class="inline-block rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400"
                    >
                        + Create New Note
                    </a>
                </div>

                @if($notes->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach ($notes as $note)
                            <div
                                class="p-4 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 shadow hover:shadow-md transition"
                            >
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 line-clamp-2">{{ $note->title }}</h3>
                                <p class="mt-2 text-gray-700 dark:text-gray-300 whitespace-pre-line line-clamp-4">{{ $note->body }}</p>

                                <div class="mt-4 flex space-x-4">
                                    <a href="{{ route('notes.edit', $note) }}"
                                       class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600"
                                    >
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('notes.destroy', $note) }}" onsubmit="return confirm('Are you sure you want to delete this note?');">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    @if(request('search'))
                        <p class="text-gray-600 dark:text-gray-400">
                            No notes found for "<strong>{{ request('search') }}</strong>".
                        </p>
                    @else
                        <p class="text-gray-600 dark:text-gray-400">You have no notes yet.</p>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
