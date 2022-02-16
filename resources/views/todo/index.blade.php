@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Todo App') }}</div>

                <div class="card-body">

                    <form action="{{route('todo.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="input" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="input" placeholder="Name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>

                    @if (session('status'))
                    <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="list-group mt-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                                    type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="active-tab" data-bs-toggle="tab" data-bs-target="#active"
                                    type="button" role="tab" aria-controls="active"
                                    aria-selected="false">Active</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="completed-tab" data-bs-toggle="tab"
                                    data-bs-target="#completed" type="button" role="tab" aria-controls="completed"
                                    aria-selected="false">Completed</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                <ul class="list-group list-group-flush">

                                    @forelse ($all as $a)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $a->name }}
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <form action="{{ route('todo.done', [$a->id]) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-success" title="Mark as Done" type="submit" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <input type="hidden" name="_method" value="put">
                                            </form>

                                            <a href="{{ route('todo.edit', [$a->id]) }}" type="button" class="btn btn-sm btn-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('todo.destroy', [$a->id]) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-danger" title="Delete" type="submit" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <input type="hidden" name="_method" value="delete">
                                            </form>
                                        </div>
                                    </li>
                                    @empty
                                    <li class="list-group-item">No Todos</li>
                                    @endforelse

                                </ul>
                            </div>
                            <div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="active-tab">
                                <ul class="list-group list-group-flush">

                                    @forelse ($act as $a)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $a->name }}
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <form action="{{ route('todo.done', [$a->id]) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-success" title="Mark as Done" type="submit" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <input type="hidden" name="_method" value="put">
                                            </form>

                                            <a href="{{ route('todo.edit', [$a->id]) }}" type="button" class="btn btn-sm btn-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('todo.destroy', [$a->id]) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-danger" title="Delete" type="submit" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <input type="hidden" name="_method" value="delete">
                                            </form>
                                        </div>
                                    </li>
                                    @empty
                                    <li class="list-group-item">No Todos</li>
                                    @endforelse

                                </ul>
                            </div>
                            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                                <ul class="list-group list-group-flush">

                                    @forelse ($done as $a)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $a->name }}
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('todo.edit', [$a->id]) }}" type="button" class="btn btn-sm btn-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('todo.destroy', [$a->id]) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-danger" title="Delete" type="submit" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <input type="hidden" name="_method" value="delete">
                                            </form>
                                        </div>
                                    </li>
                                    @empty
                                    <li class="list-group-item">No Todos</li>
                                    @endforelse

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
