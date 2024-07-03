<x-app-layout>
    <div>

        <h2 class="text-2xl mb-4 flex gap-3 items-center">
            <x-primary-button dom="a" url="{{ route('projects.tasks.index', $project->id) }}" class="flex gap-2 justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </x-primary-button>

            {{ isset($task) ? "Update Task" : "Create Task" }}
        </h2>

        <div class="p-1 border-b border-dashed border-gray-400 mb-4"></div>

        <form action="{{ isset($task) ? route('projects.tasks.update', ['project' => $project->id, 'task' => $task->id]) : route('projects.tasks.store', ['project' => $project->id]) }}" method="post">
            @csrf
            @isset($task)
               @method('PUT')
            @endisset

            <div class="flex md:flex-row flex-col items-end gap-4">
                <x-input-field
                    name="name" :value="isset($task) ? $task->name : old('name')"
                    container-class="w-full md:w-1/4"
                    label="Name"
                />
                <x-input-field
                    type="number" name="priority"
                    :value="isset($task) ? $task->priority : old('priority')"
                    container-class="w-full md:w-1/4"
                    label="Priority"
                />
                <div class="flex flex-col gap-2 w-full md:w-1/4">
                    <label>Project</label>
                    <select name="project_id" class="py-2 px-3 bg-white border border-gray-400 rounded focus:border-blue-400">
                        @foreach($projects as $proj)
                            <option value="{{ $proj->id }}" @selected(old('project_id', (isset($task) ? $task->project_id : $project->id)) == $proj->id)>{{ $proj->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-primary-button>
                    {{ isset($task) ? "Update" : "Create" }}
                </x-primary-button>
            </div>
        </form>

    </div>
</x-app-layout>
