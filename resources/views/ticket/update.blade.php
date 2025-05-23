@extends('layouts.app', ['page_title' => 'Edit Ticket', 'page_parent_title' => 'Tickets','page_parent_url' => ''])

@push('styles')
@endpush

@section('content')

<!-- Basic Layout & Basic with Icons -->
<form action="" method="POST">
  @csrf
  <div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
      <div class="card mb-8">
        <div class="card-body">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $ticket->title) }}" >
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Ticekt Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $ticket->description) }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="priority" class="form-label">Ticket Category</label>

                    <select class="form-control @error('category') is-invalid @enderror" name="category">
                    <option value="">Select Category</option>
                        <option value="1" @if(old('category', $ticket->category) == 1) selected @endif>General</option>
                        <option value="2" @if(old('category', $ticket->category) == 2) selected @endif>Technical</option>
                        <option value="3" @if(old('category', $ticket->category) == 3) selected @endif>Billing</option>
                    </select>

                @error('category')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="priority" class="form-label">Ticket Priority</label>

                    <select class="form-control @error('priority') is-invalid @enderror" name="priority">
                    <option value="">Select Priority</option>
                    <option value="1" @if(old('priority', $ticket->priority) == 1) selected @endif>Low</option>
                    <option value="2" @if(old('priority', $ticket->priority) == 2) selected @endif>Medium</option>
                    <option value="3" @if(old('priority', $ticket->priority) == 3) selected @endif>High</option>
                    </select>

                @error('priority')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
      <div class="card mb-4">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</form>
@endsection

@push('scripts')
@endpush
