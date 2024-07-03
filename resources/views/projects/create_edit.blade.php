<x-app-layout>
    <div>
        <h2 class="text-2xl mb-4 flex gap-3 items-center">
            <x-primary-button dom="a" url="{{ route('projects.index') }}" class="flex gap-2 justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </x-primary-button>

            {{ isset($project) ? "Update Project" : "Create Project" }}
        </h2>

        <div class="p-1 border-b border-dashed border-gray-400 mb-4"></div>

        <form action="{{ isset($project) ? route('projects.update', ['project' => $project->id]) : route('projects.store') }}" method="post">
            @csrf
            @isset($project)
                @method('PUT')
            @endisset
            <div class="w-full md:w-1/3 flex flex-col gap-4">
                <x-input-field
                    name="name"
                    :value="isset($project) ? $project->name : old('name')"
                    label="Name <span class='text-red-700'>*</span>"
                    :with-errors="true"
                />

                <div class="flex flex-col gap-2">
                    <label>Description</label>
                    <textarea name="description" class="p-2 border border-gray-400 rounded focus:border-blue-400 w-full">{{ isset($project) ? $project->description : old('description') }}</textarea>
                    @error('description')
                        <div class="text-red-700">{{ $message }}</div>
                    @enderror
                </div>

                <x-primary-button>
                    {{ isset($project) ? "Update" : "Create" }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
