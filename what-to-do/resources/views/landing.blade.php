<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link href="resources/css/app.css" rel="stylesheet">

</head>
<body class="bg-gray-200">
  <header class="bg-red-500 text-white p-4">
    <h1 class="text-2xl font-bold flex justify-left">{{ config('app.name') }}</h1>
  </header>
  <nav class="bg-white p-4">
    <ul class="flex justify-center">
      <li class="mr-6"><a href="{{ route('landing') }}" class="text-blue-500 hover:text-blue-800">Home</a></li>
      <li class="mr-6"><a href="{{ route('dashboard') }}" class="text-blue-500 hover:text-blue-800">Dashboard</a></li>
      @if (Route::has('login'))
              @auth
              <li class="mr-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="text-blue-500 hover:text-blue-800" onclick="event.preventDefault();
                        this.closest('form').submit();">Log Out</a>
                    </form>
              </li>
              <li class="mr-6"><a href="{{ route('profile.show') }}" class="text-blue-500 hover:text-blue-800">Your Profile</a></li>
              @else
                  <li class="mr-6"><a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-800">Login/SignUp</a></li>
              @endauth
      @endif
    </ul>
  </nav>
  <main class="px-4 py-6">
    <div class="flex justify-center">
        <div class="card" style="width: 45rem;">
            <div class="card-body">
            @if (Route::has('login'))
                @auth
                    <h5 class="card-title flex justify-center">Your tasks</h5><hr>
                    <table class="w-full text-md rounded mb-4">
                        <thead>
                        <tr class="border-b">
                            <th class="text-left p-3 px-5">Title</th>
                            <th class="text-left p-3 px-5">Status</th>
                            <th class="text-left p-3 px-5">Due Datetime</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(auth()->user()->tasks as $task)
                            <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                <td class="p-3 px-5">{{ $task->title }}</td>
                                <td class="p-3 px-5">{{ $task->status }}</td>
                                <td class="p-3 px-5">{{ $task->due_datetime }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="{{route('tasks.generatePDF')}}" class="btn btn-primary">Download All Tasks PDF</a>
                @else
                    <h5 class="card-title flex justify-center">About</h5><hr>
                    <p class="card-text text-justify">
                        Welcome to WhatToDo, the ultimate task management application built with Laravel and Tailwind CSS! Our sleek and intuitive interface makes it easy to stay organized and get things done. With Todo, you can create to-do lists, set reminders, and track your progress with ease.
                        Sign up now to get started! Our quick and easy registration process allows you to create an account in just a few simple steps.
                        Once you're logged in, you'll have access to all of Todo's powerful features. With our customizable header and footer, you can personalize your experience and make Todo your own.
                        Take a look at our demo image to see how Todo can help you stay organized and on track. And with our stunning wallpaper, you'll enjoy a beautiful and inspiring background as you work.
                        Don't wait any longer to get organized and start achieving your goals. Sign up for Todo today and start conquering your to-do list!
                    </p>
                    <div class="flex justify-center">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Open Dashboard</a>
                    </div>
                @endauth
            @endif
            </div>
          </div>
      </div>
  </main>
</body>
</html>
