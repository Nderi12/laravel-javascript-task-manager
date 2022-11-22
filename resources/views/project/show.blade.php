<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12" id="app">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button type="button" class="btn btn-dark" style="color: blue">
                        <a href="{{ route('tasks.create', ['project' => $project]) }}">Add Task</a>
                    </button>
                    <h2 class='text-center mb-4'><b>{{ $project->name }} tasks list</b></h2>
                    <br>
                    <ul id="sortlist">
                        @foreach ($tasks as $task)
                            <li data-id="{{ $task->id }}">Task Name: {{ $task->name }} | Due Date:
                                {{ $task->due_date }} | <form action="{{ route('tasks.destroy', ['task' => $task]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-info" style="color: red;">Delete</button>
                                </form> | <button class="btn btn-primary" style="color: blue;" type="submit"><a
                                        href="{{ route('tasks.edit', ['task' => $task]) }}"> Edit</a></button></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        function orderableList(target) {
            // get the list container
            target.classList.add("orderableList");
            let items = target.getElementsByTagName("li"),
                current = null;

            // for each item in the list make it draggable
            for (let i of items) {
                i.draggable = true;

                // listen to drag events
                i.ondragstart = (ev) => {
                    current = i;
                    for (let it of items) {
                        if (it !== current) {
                            it.classList.add("hint");
                        }
                    }
                };


                i.ondragenter = (ev) => {
                    if (i !== current) {
                        i.classList.add("active");
                    }
                };

                i.ondragleave = () => {
                    i.classList.remove("active");
                };

                i.ondragend = () => {
                    for (let it of items) {
                        it.classList.remove("hint");
                        it.classList.remove("active");
                    }
                };

                // prevent the default drop event from being fired
                i.ondragover = (evt) => {
                    evt.preventDefault();
                };

                // order the list after the element has been dropped
                i.ondrop = (evt) => {
                    evt.preventDefault();
                    if (i !== current) {
                        let currentpos = 0,
                            droppedpos = 0;
                        for (let it = 0; it < items.length; it++) {
                            if (current === items[it]) {
                                currentpos = it;
                            }
                            if (i === items[it]) {
                                droppedpos = it;
                            }
                        }
                        if (currentpos < droppedpos) {
                            i.parentNode.insertBefore(current, i.nextSibling);
                        } else {
                            i.parentNode.insertBefore(current, i);
                        }
                        console.log(i.getAttribute("data-id"));
                        var data = {
                            priority: droppedpos + 1,
                            id: i.getAttribute("data-id"),
                            _token: "{{ csrf_token() }}"
                        }

                        var request = new Request("{{ route('tasks.priority') }}", {
                            method: "PUT",
                            body: JSON.stringify(data),
                            headers: new Headers({
                                'Content-Type': 'application/json'
                            })
                        })

                        fetch(request)
                            .then(res => res.json())
                            .then(res => {
                                // this.loadTasks()
                            });

                        if (currentpos < droppedpos) {
                            i.parentNode.insertBefore(current, i.nextSibling);
                        } else {
                            i.parentNode.insertBefore(current, i);
                        }
                    }
                };
            }
        }

        window.addEventListener("DOMContentLoaded", () => {
            orderableList(document.getElementById("sortlist"));
        });
    </script>
    <style>
        /* (A) LIST STYLES */
        .orderableList {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .orderableList li {
            margin: 10px;
            padding: 15px;
            border: 1px solid #dfdfdf;
            background: #f5f5f5;
        }

        /* (B) DRAG-AND-DROP HINT */
        .orderableList li.hint {
            border: 1px solid #ffc49a;
            background: #feffb4;
        }

        .orderableList li.active {
            border: 1px solid #ffa5a5;
            background: #ffe7e7;
        }
    </style>
</x-app-layout>
