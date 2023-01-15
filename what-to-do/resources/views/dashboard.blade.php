<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex">
                    <div class="flex-auto text-2xl mb-4">Tasks List</div>

                    <div class="flex-auto text-right mt-2">
                        <a href="/task" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add new Task</a>
                    </div>
                </div>
                <table class="w-full text-md rounded mb-4">
                    <thead>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">SL No.</th>
                        <th class="text-left p-3 px-5">Title</th>
                        <th class="text-left p-3 px-5">Task Details</th>
                        <th class="text-left p-3 px-5">DateTime</th>
                        <th class="text-left p-3 px-5">Priority</th>
                        <th class="text-left p-3 px-5">Status</th>
                        <th class="text-left p-3 px-5">Method</th>
                        <th class="text-left p-3 px-5">Created At</th>
                        <th class="text-left p-3 px-5">Modify</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach(auth()->user()->tasks as $task)
                        <tr class="border-b hover:bg-orange-100">
                            <td class="p-3 px-5">
                                {{$i}}
                            </td>
                            <td class="p-3 px-5">
                                {{$task->title}}
                            </td>
                            <td class="p-3 px-5">
                                {{$task->description}}
                            </td>
                            <td class="p-3 px-5">
                                {{$task->due_datetime}}
                            </td>
                            <td class="p-3 px-5">
                                {{$task->priority}}
                            </td>
                            <td class="p-3 px-5">
                                {{$task->status}}
                            </td>
                            <td class="p-3 px-5">
                                {{$task->by}}
                            </td>
                            <td class="p-3 px-5">
                                {{$task->created_at}}
                            </td>
                            <td class="p-3 px-5">
                                <a href="/task/{{$task->id}}" name="edit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</a>
                                <form action="/task/{{$task->id}}" class="inline-block">
                                    <button type="submit" name="delete" formmethod="POST" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
