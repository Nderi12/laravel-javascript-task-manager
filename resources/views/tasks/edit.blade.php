<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit {{ $task->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('tasks.update', ['task' => $task]) }}" method="POSt">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Name:</label><br>
                    <input class="form-control" type="text" id="name" name="name" value="{{ $task->name }}" required><br>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input class="form-control" type="date" name="due_date" value="{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}" id="date" required>
                </div>
              <div class="">
                  <button type="submit" class="btn btn-success">
                      Submit
                  </button>
              </div>
    
            </form>
        </div>
    </div>
</x-app-layout>