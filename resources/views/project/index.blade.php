<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <button type="button" class="btn btn-dark" style="color: blue">
                            <a href="{{ route('projects.create') }}">Create New Project</a>
                        </button>
                        <h2 class='text-center mb-4'><b>Projects List</b></h2>
                        <br>
                        <table id="dtBasicExample" class="table" width="100%">
                            <thead>
                                <tr>
                                  <th class="th-sm">
                                    #
                                  </th>
                                    <th class="th-sm">Name
                                    </th>
                                    <th class="th-sm">No of Tasks
                                    </th>
                                    <th class="th-sm">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td class="text-center p-3">{{ $loop->iteration }}</td>
                                        <td class="text-center p-3">{{ $project->name }}</td>
                                        <td class="text-center p-3">{{ count($project->tasks) }} tasks</td>
                                        <td class="text-center p-3"><button class="btn btn-primary" style="color: blue;" type="submit"><a href="{{ route('projects.show', ['project' => $project]) }}"> View</a></button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
