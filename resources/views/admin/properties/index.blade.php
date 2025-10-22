@extends('admin.layouts.app')

@section('title', 'Properties')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="flaticon-check"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="flaticon-warning"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="admin-header">
    <div class="header-content">
        <h3>Properties Management</h3>
        <div class="text-content">Manage all properties in your portfolio</div>
    </div>
    <div class="header-actions">
        <a href="{{ route('admin.properties.create') }}" class="tf-button-default">
            <i class="flaticon-plus"></i> Add New Property
        </a>
    </div>
</div>

<div class="properties-grid">
    @forelse($properties as $property)
        <x-admin-property-card :property="$property" />
    @empty
        <div class="empty-state">
            <div class="empty-icon">
                <i class="flaticon-house"></i>
            </div>
            <h4>No Properties Found</h4>
            <p>You haven't added any properties yet. Start by adding your first property.</p>
            <a href="{{ route('admin.properties.create') }}" class="tf-button-primary">
                <i class="flaticon-plus"></i> Add Your First Property
            </a>
        </div>
    @endforelse
</div>

@if($properties->hasPages())
    <div class="pagination-wrapper">
        {{ $properties->links() }}
    </div>
@endif
@endsection

@push('styles')
<style>
.alert {
    padding: 12px 20px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 500;
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

.alert i {
    font-size: 18px;
}

.btn-close {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    margin-left: auto;
    opacity: 0.7;
}

.btn-close:hover {
    opacity: 1;
}
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

.properties-grid {
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
    
    .properties-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .header-content h3 {
        font-size: 24px;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s ease';
            setTimeout(function() {
                alert.remove();
            }, 500);
        }, 5000);
    });
});
</script>
@endpush 