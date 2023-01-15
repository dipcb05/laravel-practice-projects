<h1>Tasks of {{ $user->name }}, till today</h1>
<table>
    <thead>
        <tr>
            <th>Task Name</th>
            <th>Due Date</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($userTasks as $task)
            <tr>
                <td>{{ $task->name }}</td>
                <td>{{ $task->due_date }}</td>
                <td>{{ $task->description }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
