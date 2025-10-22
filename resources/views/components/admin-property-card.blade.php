@props(['property'])

<div class="admin-property-card">
    <div class="property-image">
        @if($property->images->first())
            <img src="{{ asset('storage/uploads/properties/' . $property->images->first()->image_path) }}" 
                 alt="{{ $property->title }}" 
                 class="property-thumbnail">
        @else
            <div class="no-image-placeholder">
                <i class="flaticon-house"></i>
                <span>No Image</span>
            </div>
        @endif
        <div class="property-status-badge">
            <span class="status-{{ strtolower(str_replace(' ', '-', $property->status)) }}">
                {{ ucfirst($property->status) }}
            </span>
        </div>
        @if($property->featured)
            <div class="featured-badge">
                <span>FEATURED</span>
            </div>
        @endif
    </div>
    
    <div class="property-content">
        <div class="property-header">
            <h4 class="property-title">
                <a href="{{ route('properties.show', $property->slug) }}">{{ $property->title }}</a>
            </h4>
            <div class="property-price">
                ₦{{ number_format($property->price, 2) }}
                @if($property->discount_price)
                    <span class="original-price">₦{{ number_format($property->discount_price, 2) }}</span>
                @endif
            </div>
        </div>
        
        <div class="property-location">
            <i class="flaticon-location"></i>
            <span>{{ $property->address }}, {{ $property->city }}, {{ $property->state }}</span>
        </div>
        
        <div class="property-details">
            <div class="detail-item">
                <i class="flaticon-hotel"></i>
                <span>{{ $property->bedrooms ?? 'N/A' }} Beds</span>
            </div>
            <div class="detail-item">
                <i class="flaticon-bath-tub"></i>
                <span>{{ $property->bathrooms ?? 'N/A' }} Baths</span>
            </div>
            <div class="detail-item">
                <i class="flaticon-car"></i>
                <span>{{ $property->parking_spaces ?? 'N/A' }} Parking</span>
            </div>
        </div>
        
        <div class="property-meta">
            <span class="property-type">{{ ucfirst($property->property_type) }}</span>
            <span class="property-id">ID: {{ $property->id }}</span>
        </div>
    </div>
    
    <div class="property-actions">
        <div class="action-buttons">
            <a href="{{ route('properties.show', $property->slug) }}" 
               class="btn-action btn-view" 
               title="View Property">
                <i class="flaticon-magnifiying-glass"></i>
            </a>
            <a href="{{ route('admin.properties.edit', $property) }}" 
               class="btn-action btn-edit" 
               title="Edit Property">
                <i class="flaticon-edit"></i>
            </a>
            <form action="{{ route('admin.properties.destroy', $property) }}" 
                  method="POST" 
                  class="delete-form"
                  onsubmit="return confirmDelete('{{ $property->title }}')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="btn-action btn-delete" 
                        title="Delete Property">
                    <i class="flaticon-delete"></i>
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(propertyTitle) {
    return confirm(`Are you sure you want to delete "${propertyTitle}"?\n\nThis action cannot be undone and will permanently remove:\n• All property images\n• Property brochure\n• All associated data\n\nClick OK to delete or Cancel to keep the property.`);
}
</script>
@endpush

@push('styles')
<style>
.admin-property-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: all 0.3s ease;
    margin-bottom: 20px;
    display: flex;
    min-height: 200px;
}

.admin-property-card:hover {
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    transform: translateY(-2px);
}

.property-image {
    position: relative;
    width: 250px;
    min-width: 250px;
    overflow: hidden;
}

.property-thumbnail {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.admin-property-card:hover .property-thumbnail {
    transform: scale(1.05);
}

.no-image-placeholder {
    width: 100%;
    height: 100%;
    background: #f8f9fa;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}

.no-image-placeholder i {
    font-size: 48px;
    margin-bottom: 8px;
}

.property-status-badge {
    position: absolute;
    top: 12px;
    left: 12px;
}

.property-status-badge span {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-available { background: #28a745; color: white; }
.status-sold { background: #dc3545; color: white; }
.status-rented { background: #ffc107; color: #212529; }
.status-off-plan { background: #17a2b8; color: white; }
.status-upcoming { background: #6f42c1; color: white; }

.featured-badge {
    position: absolute;
    top: 12px;
    right: 12px;
}

.featured-badge span {
    background: #fd7e14;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: 600;
    text-transform: uppercase;
}

.property-content {
    flex: 1;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.property-header {
    margin-bottom: 12px;
}

.property-title {
    margin: 0 0 8px 0;
    font-size: 18px;
    font-weight: 600;
    line-height: 1.3;
}

.property-title a {
    color: #212529;
    text-decoration: none;
    transition: color 0.3s ease;
}

.property-title a:hover {
    color: #007bff;
}

.property-price {
    font-size: 20px;
    font-weight: 700;
    color: #28a745;
}

.original-price {
    font-size: 14px;
    color: #6c757d;
    text-decoration: line-through;
    margin-left: 8px;
}

.property-location {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
    color: #6c757d;
    font-size: 14px;
}

.property-location i {
    margin-right: 6px;
    font-size: 16px;
}

.property-details {
    display: flex;
    gap: 20px;
    margin-bottom: 16px;
}

.detail-item {
    display: flex;
    align-items: center;
    color: #6c757d;
    font-size: 14px;
}

.detail-item i {
    margin-right: 6px;
    font-size: 16px;
}

.property-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 12px;
    border-top: 1px solid #e9ecef;
    font-size: 12px;
    color: #6c757d;
}

.property-type {
    background: #e9ecef;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 500;
}

.property-actions {
    padding: 20px;
    border-left: 1px solid #e9ecef;
    display: flex;
    align-items: center;
    min-width: 80px;
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.btn-action {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-view {
    background: #17a2b8;
    color: white;
}

.btn-view:hover {
    background: #138496;
    color: white;
}

.btn-edit {
    background: #ffc107;
    color: #212529;
}

.btn-edit:hover {
    background: #e0a800;
    color: #212529;
}

.btn-delete {
    background: #dc3545;
    color: white;
}

.btn-delete:hover {
    background: #c82333;
    color: white;
    transform: scale(1.05);
}

.btn-delete:active {
    background: #a71e2a;
    transform: scale(0.95);
}

.delete-form {
    display: inline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .admin-property-card {
        flex-direction: column;
    }
    
    .property-image {
        width: 100%;
        height: 200px;
    }
    
    .property-actions {
        border-left: none;
        border-top: 1px solid #e9ecef;
        flex-direction: row;
        justify-content: center;
        min-width: auto;
    }
    
    .action-buttons {
        flex-direction: row;
    }
}
</style>
@endpush