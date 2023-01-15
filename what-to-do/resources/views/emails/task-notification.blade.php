<!DOCTYPE html>
<html>
<head>
    <title>Task Notification</title>
</head>
<body>
    <h1>Task Notification</h1>
    <p>Hello {{ $user->name }},</p>
    <p>This is a notification that the following task is due:</p>
    <table>
        <tr>
            <th>Task Name</th>
            <th>Due Date</th>
            <th>Description</th>
        </tr>
        <tr>
            <td>{{ $task->name }}</td>
            <td>{{ $task->due_date }}</td>
            <td>{{ $task->description }}</td>
        </tr>
    </table>
</body>
</html>
