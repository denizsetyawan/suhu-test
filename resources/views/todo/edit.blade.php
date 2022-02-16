@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Todo App') }}</div>

                <div class="card-body">

                    @foreach($todo as $t)
                    <form action="{{route('todo.update', $t->id)}}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <input type="hidden" name="status" value="{{ $t->isDone }}">
                        <div class="mb-3">
                            <label for="input" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $t->name }}" id="input" placeholder="Name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
