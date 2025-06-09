<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
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
                        @else
                            <div
                                class="mb-4 w-full rounded-lg border border-blue-300 bg-blue-100 px-4 py-3 text-sm font-medium text-blue-800 shadow-md dark:border-blue-600 dark:bg-blue-900 dark:text-blue-100"
                            >
                                👋 Welcome back, {{ Auth::user()->name }}!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
