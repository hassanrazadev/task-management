<x-app-layout>
    <div class="tasks-container">
        <div class="text-2xl mb-4 flex gap-3 items-center justify-between">
            <div class="flex items-center gap-3">
                <x-primary-button dom="a" url="{{ route('projects.index') }}" class="flex gap-2 justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </x-primary-button>

                {{ isset($project) ? $project->name : 'All' }}: {{ __('Tasks') }}
            </div>

            <x-primary-button dom="a" url="{{ route('projects.tasks.create', ['project' => $project->id]) }}" class="flex gap-2 justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </x-primary-button>
        </div>

        <p class="text-gray-500 mb-2">{{ $project->description }}</p>

        <div class="p-1 border-b border-dashed border-gray-400 mb-4"></div>

        <div class="tasks-lists w-full md:w-1/5">
            <div class="tasks-list tasks-list-sortable flex flex-col gap-4">
                @foreach($tasks as $task)
                    <div class="task-container border border-gray-400 rounded p-3 hover:cursor-move bg-white flex justify-between" data-id="{{ $task->id }}">
                        <div>
                            <div>
                                {{ $task->name }}
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('projects.tasks.edit', ['project' => $project->id, 'task' => $task->id,]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 stroke-blue-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                            <button type="button" data-id="{{ $task->id }}" class="delete-task">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 stroke-red-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <x-slot:script>
        <script type="text/javascript">
            (function (){
                $('.tasks-list-sortable').sortable({
                    items: ".task-container",
                    cursor: 'move',
                    placeholder: "ui-state-highlight-task",
                    refreshPosition: true,
                    stop: function( event, ui ) {
                        const list = ui.item.parents('.tasks-list-sortable');
                        const listTasks = $(list).find('.task-container').map((index, task) => $(task).data('id')).get();
                        window.axios.post('{{ route('projects.tasks.reorder', $project->id) }}', {
                            task_ids: listTasks
                        }).then(r => {
                            console.log(r.data);
                        }).catch(e => {
                            console.error(e.data);
                        })
                    }
                });

                $(document).on('click', '.delete-task', function (e) {
                    e.preventDefault();
                    const $this = $(this);
                    const taskId = $this.data('id')
                    let url = '{{ route('projects.tasks.destroy', ['project' => $project->id, 'task' => ':taskId']) }}';
                    url = url.replace(':taskId', taskId);

                    if (confirm("Are you sure you want to delete this task?")) {
                        window.axios.delete(url)
                            .then(res => {
                                $this.parents('.task-container').remove()
                            }).catch(e => {
                                console.error(e);
                            })
                    }
                })
            }());
        </script>
    </x-slot:script>
</x-app-layout>
