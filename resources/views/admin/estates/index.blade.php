@extends('admin.layouts.app')

@section('title', 'Estates')

@section('content')
<div class="admin-header">
    <div class="header-content">
        <h3>Estates Management</h3>
        <div class="text-content">Manage all estates in your portfolio</div>
    </div>
    <div class="header-actions">
        <a href="{{ route('admin.estates.create') }}" class="tf-button-default">
            <i class="flaticon-plus"></i> Add New Estate
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="estates-grid">
    @forelse($estates as $estate)
        <x-admin-estate-card :estate="$estate" />
    @empty
        <div class="empty-state">
            <div class="empty-icon">
                <i class="flaticon-building"></i>
            </div>
            <h4>No Estates Found</h4>
            <p>You haven't added any estates yet. Start by adding your first estate.</p>
            <a href="{{ route('admin.estates.create') }}" class="tf-button-primary">
                <i class="flaticon-plus"></i> Add Your First Estate
            </a>
        </div>
    @endforelse
</div>

@if($estates->hasPages())
    <div class="pagination-wrapper">
        {{ $estates->links() }}
    </div>
@endif
@endsection

@push('styles')
<style>
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 30px;
    padding: 20px 0;
    border-bottom: 1px solid #e9ecef;
}

.header-content h3 {
    margin: 0 0 8px 0;
    font-size: 28px;
    font-weight: 600;
    color: #212529;
}

.header-content .text-content {
    color: #6c757d;
    font-size: 16px;
}

.header-actions {
    display: flex;
    gap: 12px;
}

.estates-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    background: #f8f9fa;
    border-radius: 12px;
    border: 2px dashed #dee2e6;
}

.empty-icon {
    font-size: 64px;
    color: #6c757d;
    margin-bottom: 20px;
}

.empty-state h4 {
    font-size: 24px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 12px;
}

.empty-state p {
    color: #6c757d;
    font-size: 16px;
    margin-bottom: 24px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
    padding: 20px 0;
}

.alert {
    padding: 12px 16px;
    margin-bottom: 20px;
    border-radius: 8px;
    border: 1px solid transparent;
}

.alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}

.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

/* Responsive Design */
@media (max-width: 768px) {
    .admin-header {
        flex-direction: column;
        gap: 20px;
        align-items: stretch;
    }
    
    .header-actions {
        justify-content: center;
    }
    
    .estates-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .header-content h3 {
        font-size: 24px;
    }
}
</style>
@endpush 