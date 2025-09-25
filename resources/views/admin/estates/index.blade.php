@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estates</h1>
        <a href="{{ route('admin.estates.create') }}" class="btn btn-primary">Add Estate</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estates as $estate)
                        <tr>
                            <td>{{ $estate->name }}</td>
                            <td>{{ ucfirst($estate->status) }}</td>
                            <td>{{ $estate->city }}</td>
                            <td>{{ $estate->state }}</td>
                            <td>
                                <a href="{{ route('admin.estates.edit', $estate) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.estates.destroy', $estate) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this estate?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $estates->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 