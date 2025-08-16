<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Users</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="mb-0">Users</h1>
    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">← Tasks</a>
  </div>

  {{-- Search + Age Filter --}}
  <form method="GET" action="{{ route('users.index') }}" class="row g-2 mb-4">
    <div class="col-md-6">
      <input type="text" name="q" class="form-control" placeholder="Search by name..." value="{{ request('q') }}">
    </div>
    <div class="col-md-4">
      <select name="age" class="form-select">
        <option value="all"      {{ request('age','all') === 'all' ? 'selected' : '' }}>All</option>
        <option value="under15"  {{ request('age') === 'under15' ? 'selected' : '' }}>Under 15</option>
        <option value="above15"  {{ request('age') === 'above15' ? 'selected' : '' }}>15 and above</option>
      </select>
    </div>
    <div class="col-md-2 d-grid">
      <button class="btn btn-primary">Apply</button>
    </div>
  </form>

  {{-- Users Table --}}
  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-light">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th class="text-center" style="width:120px;">Age</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $u)
          <tr>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td class="text-center">{{ $u->age }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="text-center text-muted">No users found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-3">
    {{ $users->links() }}
  </div>
</div>
</body>
</html>
