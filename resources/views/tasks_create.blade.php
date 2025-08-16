<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Create Task</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <h1 class="mb-4">Create Task</h1>

  <form method="POST" action="{{ route('tasks.store') }}" class="card p-3 shadow-sm">
    @csrf
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input name="title" class="form-control" value="{{ old('title') }}" required>
      @error('title')
        <div class="text-danger small mt-1">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
      @error('description')
        <div class="text-danger small mt-1">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Order (unique number)</label>
      <input type="number" name="order" class="form-control" value="{{ old('order') }}" required>
      @error('order')
        <div class="text-danger small mt-1">{{ $message }}</div>
      @enderror
    </div>

    <div class="d-flex gap-2">
      <button class="btn btn-primary">Save</button>
      <a class="btn btn-outline-secondary" href="{{ route('tasks.index') }}">Cancel</a>
    </div>
  </form>
</div>
</body>
</html>
