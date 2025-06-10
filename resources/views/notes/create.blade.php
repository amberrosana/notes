<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Note') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

            @if ($errors->any())
                <div class="mb-4 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700 dark:bg-red-900 dark:text-red-300 dark:border-red-600">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('notes.store') }}">
                @csrf

                <div>
                    <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Title</label>
                    <input
                        id="title"
                        name="title"
                        type="text"
                        value="{{ old('title') }}"
                        maxlength="255"
                        required
                        autofocus
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200
                               focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400"
                    />
                </div>

                <div class="mt-4">
                    <label for="body" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Body</label>
                    <textarea
                        id="body"
                        name="body"
                        maxlength="10000"
                        rows="10"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200
                               focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400"
                    >{{ old('body') }}</textarea>
                </div>

                <div class="mt-6">
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white
                               hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400"
                    >
                        Create Note
                    </button>

                    <a href="{{ route('dashboard') }}" class="ml-4 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
