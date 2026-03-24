<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight font-poppins">
            Student <span class="text-indigo-600">Profile</span>
        </h2>
        <p class="text-sm font-medium text-gray-500 italic mt-1">"Manage your academic identity and account security."</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto space-y-12">
            <div class="p-4 sm:p-8 border-b-2 border-dashed border-gray-100">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 border-b-2 border-dashed border-gray-100">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
