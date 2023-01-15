<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

                <form method="POST" action="/task">

                    <button id="start-recording"
                            class="p-4 bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg">
                        Add Task by Voice
                    </button>
                    <br>

                    <div class="form-group">
                        <input type="text"
                               name="title"
                               class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-10 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"
                               placeholder='Enter the short title'>
                        <br><br>
                        <textarea name="description"
                                  class="bg-gray-100
                                         rounded border
                                         border-gray-400
                                         leading-normal
                                         resize-none
                                         w-full
                                         h-20 py-2 px-3
                                         font-medium
                                         placeholder-gray-700
                                         focus:outline-none
                                         focus:bg-white"
                                  placeholder='Enter the task description'
                                  rows="2" cols="50"></textarea>
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        <br><br>
                        <label for="datetime-local">Due Date and Time: </label>
                        <input type="datetime-local" name="due_datetime">
                        <label for="priority"> Priority: </label>
                        <select name="priority" id="priority">
                            <option value="high"> High </option>
                            <option value="moderate"> Moderate </option>
                            <option value="low"> Low </option>
                        </select>
                        <label for="status"> Status: </label>
                        <select name="status" id="status">
                          <option value="pending"> Pending </option>
                          <option value="prerequisite"> Have to done other task before </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Task</button>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>


</x-app-layout>
