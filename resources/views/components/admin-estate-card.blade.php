@props(['estate'])

<div class="admin-estate-card">
    <div class="estate-image">
        @if($estate->cover_image)
            <img src="{{ asset('storage/uploads/estates/covers/' . $estate->cover_image) }}" 
                 alt="{{ $estate->name }}" 
                 class="estate-thumbnail">
        @elseif($estate->images->first())
            <img src="{{ asset('storage/uploads/estates/gallery/' . $estate->images->first()->image_path) }}" 
                 alt="{{ $estate->name }}" 
                 class="estate-thumbnail">
        @else
            <div class="no-image-placeholder">
                <i class="flaticon-building"></i>
                <span>No Image</span>
            </div>
        @endif
        <div class="estate-status-badge">
            <span class="status-{{ strtolower(str_replace(' ', '-', $estate->status)) }}">
                {{ ucfirst($estate->status) }}
            </span>
        </div>
    </div>
    
    <div class="estate-content">
        <div class="estate-header">
            <h4 class="estate-title">
                <a href="{{ route('estates.show', $estate->slug) }}">{{ $estate->name }}</a>
            </h4>
            <div class="estate-location">
                <i class="flaticon-location"></i>
                <span>{{ $estate->city }}, {{ $estate->state }}</span>
            </div>
        </div>
        
        <div class="estate-description">
            <p>{{ Str::limit($estate->description, 120) }}</p>
        </div>
        
        <div class="estate-stats">
            <div class="stat-item">
                <i class="flaticon-house"></i>
                <span>{{ $estate->properties->count() }} Properties</span>
            </div>
            <div class="stat-item">
                <i class="flaticon-image"></i>
                <span>{{ $estate->images->count() }} Images</span>
            </div>
        </div>
        
        <div class="estate-amenities">
            @if($estate->amenities && count($estate->amenities) > 0)
                <div class="amenities-list">
                    @foreach(array_slice($estate->amenities, 0, 3) as $amenity)
                        <span class="amenity-tag">{{ $amenity }}</span>
                    @endforeach
                    @if(count($estate->amenities) > 3)
                        <span class="amenity-more">+{{ count($estate->amenities) - 3 }} more</span>
                    @endif
                </div>
            @endif
        </div>
        
        <div class="estate-meta">
            <span class="estate-id">ID: {{ $estate->id }}</span>
            <span class="estate-slug">{{ $estate->slug }}</span>
        </div>
    </div>
    
    <div class="estate-actions">
        <div class="action-buttons">
            <a href="{{ route('estates.show', $estate->slug) }}" 
               class="btn-action btn-view" 
               title="View Estate">
                <i class="flaticon-magnifiying-glass"></i>
            </a>
            <a href="{{ route('admin.estates.edit', $estate) }}" 
               class="btn-action btn-edit" 
               title="Edit Estate">
                <i class="flaticon-edit"></i>
            </a>
            <form action="{{ route('admin.estates.destroy', $estate) }}" 
                  method="POST" 
                  class="delete-form"
                  onsubmit="return confirm('Are you sure you want to delete this estate?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="btn-action btn-delete" 
                        title="Delete Estate">
                    <i class="flaticon-delete"></i>
                </button>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
.admin-estate-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: all 0.3s ease;
    margin-bottom: 20px;
    display: flex;
    min-height: 200px;
}

.admin-estate-card:hover {
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    transform: translateY(-2px);
}

.estate-image {
    position: relative;
    width: 250px;
    min-width: 250px;
    overflow: hidden;
}

.estate-thumbnail {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.admin-estate-card:hover .estate-thumbnail {
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

.estate-status-badge {
    position: absolute;
    top: 12px;
    left: 12px;
}

.estate-status-badge span {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-completed { background: #28a745; color: white; }
.status-developing { background: #ffc107; color: #212529; }
.status-upcoming { background: #6f42c1; color: white; }

.estate-content {
    flex: 1;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.estate-header {
    margin-bottom: 12px;
}

.estate-title {
    margin: 0 0 8px 0;
    font-size: 18px;
    font-weight: 600;
    line-height: 1.3;
}

.estate-title a {
    color: #212529;
    text-decoration: none;
    transition: color 0.3s ease;
}

.estate-title a:hover {
    color: #007bff;
}

.estate-location {
    display: flex;
    align-items: center;
    color: #6c757d;
    font-size: 14px;
}

.estate-location i {
    margin-right: 6px;
    font-size: 16px;
}

.estate-description {
    margin-bottom: 16px;
    color: #6c757d;
    font-size: 14px;
    line-height: 1.5;
}

.estate-stats {
    display: flex;
    gap: 20px;
    margin-bottom: 16px;
}

.stat-item {
    display: flex;
    align-items: center;
    color: #6c757d;
    font-size: 14px;
}

.stat-item i {
    margin-right: 6px;
    font-size: 16px;
}

.estate-amenities {
    margin-bottom: 16px;
}

.amenities-list {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.amenity-tag {
    background: #e9ecef;
    color: #495057;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
}

.amenity-more {
    background: #007bff;
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
}

.estate-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 12px;
    border-top: 1px solid #e9ecef;
    font-size: 12px;
    color: #6c757d;
}

.estate-id {
    background: #e9ecef;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 500;
}

.estate-slug {
    font-family: monospace;
    background: #f8f9fa;
    padding: 2px 6px;
    border-radius: 4px;
}

.estate-actions {
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
}

.delete-form {
    display: inline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .admin-estate-card {
        flex-direction: column;
    }
    
    .estate-image {
        width: 100%;
        height: 200px;
    }
    
    .estate-actions {
        border-left: none;
        border-top: 1px solid #e9ecef;
        flex-direction: row;
        justify-content: center;
        min-width: auto;
    }
    
    .action-buttons {
        flex-direction: row;
    }
    
    .estate-stats {
        flex-direction: column;
        gap: 8px;
    }
}
</style>
@endpush
