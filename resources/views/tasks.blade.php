<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tasks List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">

  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="mb-0">Tasks</h1>
    <a class="btn btn-success" href="{{ route('tasks.create') }}">+ New Task</a>
  </div>

  @if(session('ok'))
    <div class="alert alert-success">{{ session('ok') }}</div>
  @endif

  <form method="GET" action="{{ route('tasks.index') }}" class="row g-2 mb-4">
    <div class="col-md-5">
      <input type="text" name="search" class="form-control" placeholder="Search by title" value="{{ request('search') }}">
    </div>
    <div class="col-md-4">
      <select name="filter" class="form-select">
        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All tasks</option>
        <option value="under_15" {{ request('filter') == 'under_15' ? 'selected' : '' }}>Order less than 15</option>
        <option value="above_15" {{ request('filter') == 'above_15' ? 'selected' : '' }}>Order 15 and above</option>
      </select>
    </div>
    <div class="col-md-3 d-flex gap-2">
      <button class="btn btn-primary w-100">Apply</button>
      <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
  </form>

  <div class="row g-3">
    @forelse($tasks as $task)
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title mb-1">
              <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
            </h5>

            <div class="d-flex align-items-center gap-2 text-muted mb-2">
              <span>Order: {{ $task->order }}</span>
              @if(isset($task->status))
                <span class="badge {{ $task->status === 'done' ? 'text-bg-success' : 'text-bg-secondary' }}">
                  {{ ucfirst($task->status) }}
                </span>
              @endif
            </div>

            <p class="mb-0">{{ $task->description }}</p>

            <div class="d-flex flex-wrap gap-2 mt-3">
              @if(isset($task->status))
                <form method="POST" action="{{ route('tasks.toggle', $task->id) }}">
                  @csrf
                  @method('PATCH')
                  <button class="btn btn-sm btn-warning">
                    {{ $task->status === 'done' ? 'Mark Pending' : 'Mark Done' }}
                  </button>
                </form>
              @endif

              <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>

              <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="return confirm('Delete this task?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-warning text-center">No tasks found.</div>
      </div>
    @endforelse
  </div>

  <div class="mt-4">
    {{ $tasks->links() }}
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
