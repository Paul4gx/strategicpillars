<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    <p>{{ __("You're logged in!") }}</p>
                    @if(auth()->user()->isAdmin())
                        <p>
                            <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">{{ __('Open admin dashboard') }}</a>
                        </p>
                    @elseif(auth()->user()->isRealtor())
                        <p>
                            <a href="{{ auth()->user()->onboarding_completed_at ? route('realtor.dashboard') : route('realtor.onboarding.edit') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">{{ __('Open realtor workspace') }}</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
