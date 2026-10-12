@props([
    'property',
    'editRoute' => null,
    'destroyRoute' => null,
    'allowDelete' => true,
])
@php
    $editRoute = $editRoute ?? route('admin.properties.edit', $property);
    $destroyRoute = $destroyRoute ?? route('admin.properties.destroy', $property);
    $locationLine = trim(implode(', ', array_filter([
        $property->address,
        $property->city,
        $property->state,
    ])));
@endphp

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
        <div class="property-badges">
            <span class="property-status-badge status-{{ strtolower(str_replace(' ', '-', $property->status)) }}">
                {{ ucfirst($property->status) }}
            </span>
            @if($property->featured)
                <span class="featured-badge">Featured</span>
            @endif
        </div>
    </div>

    <div class="property-body">
        <div class="property-title-row">
            <h4 class="property-title" title="{{ $property->title }}">
                <a href="{{ route('properties.show', $property->slug) }}">{{ $property->title }}</a>
            </h4>
        </div>

        <div class="property-price-block">
            <span class="property-price">₦{{ number_format($property->price, 0) }}</span>
            @if($property->discount_price)
                <span class="original-price">₦{{ number_format($property->discount_price, 0) }}</span>
            @endif
        </div>

        @if($locationLine !== '')
            <div class="property-location" title="{{ $locationLine }}">
                <i class="flaticon-location"></i>
                <span>{{ $locationLine }}</span>
            </div>
        @endif

        <div class="property-details">
            <span class="detail-item"><i class="flaticon-hotel"></i>{{ $property->bedrooms ?? '—' }} bd</span>
            <span class="detail-item"><i class="flaticon-bath-tub"></i>{{ $property->bathrooms ?? '—' }} ba</span>
            <span class="detail-item"><i class="flaticon-car"></i>{{ $property->parking_spaces ?? '—' }} pk</span>
        </div>

        <div class="property-footer">
            <div class="property-meta">
                <span class="property-type">{{ ucfirst(str_replace('_', ' ', $property->property_type)) }}</span>
                <span class="property-id">#{{ $property->id }}</span>
            </div>
            @if($property->relationLoaded('realtor') && $property->realtor)
                <div class="property-realtor" title="{{ $property->realtor->publicBrandName() }}">
                    <i class="flaticon-user"></i>
                    <span>{{ $property->realtor->publicBrandName() }}</span>
                </div>
            @endif
        </div>
    </div>

    <div class="property-actions">
        <a href="{{ route('properties.show', $property->slug) }}" class="btn-action btn-view" title="View Property">
            <i class="flaticon-magnifiying-glass"></i>
        </a>
        <a href="{{ $editRoute }}" class="btn-action btn-edit" title="Edit Property">
            <i class="flaticon-edit"></i>
        </a>
        @if($allowDelete)
            <form action="{{ $destroyRoute }}" method="POST" class="delete-form" onsubmit="return confirmDelete('{{ addslashes($property->title) }}')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-action btn-delete" title="Delete Property">
                    <i class="flaticon-delete"></i>
                </button>
            </form>
        @endif
    </div>
</div>

@once
    @push('scripts')
    <script>
    function confirmDelete(propertyTitle) {
        return confirm(`Are you sure you want to delete "${propertyTitle}"?\n\nThis action cannot be undone and will permanently remove:\n• All property images\n• Property brochure\n• All associated data\n\nClick OK to delete or Cancel to keep the property.`);
    }
    </script>
    @endpush

    @push('styles')
    <style>
    .properties-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 16px;
        margin-bottom: 30px;
        align-items: stretch;
    }

    @media (max-width: 768px) {
        .properties-grid {
            grid-template-columns: 1fr;
        }
    }

    .admin-property-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
        display: flex;
        flex-direction: column;
        min-width: 0;
        height: 100%;
    }

    .admin-property-card:hover {
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
        transform: translateY(-1px);
    }

    .admin-property-card .property-image {
        position: relative;
        width: 100%;
        height: 140px;
        flex-shrink: 0;
        overflow: hidden;
        background: #f1f3f5;
    }

    .admin-property-card .property-thumbnail {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .admin-property-card .no-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #868e96;
        font-size: 12px;
    }

    .admin-property-card .no-image-placeholder i {
        font-size: 32px;
        margin-bottom: 4px;
    }

    .admin-property-card .property-badges {
        position: absolute;
        top: 8px;
        left: 8px;
        right: 8px;
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        pointer-events: none;
    }

    .admin-property-card .property-status-badge,
    .admin-property-card .featured-badge {
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        line-height: 1.2;
    }

    .admin-property-card .property-status-badge.status-available { background: #28a745; color: #fff; }
    .admin-property-card .property-status-badge.status-sold { background: #dc3545; color: #fff; }
    .admin-property-card .property-status-badge.status-rented { background: #ffc107; color: #212529; }
    .admin-property-card .property-status-badge.status-off-plan { background: #17a2b8; color: #fff; }
    .admin-property-card .property-status-badge.status-upcoming { background: #6f42c1; color: #fff; }

    .admin-property-card .featured-badge {
        background: #fd7e14;
        color: #fff;
        margin-left: auto;
    }

    .admin-property-card .property-body {
        flex: 1;
        min-width: 0;
        padding: 12px 14px 10px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .admin-property-card .property-title {
        margin: 0;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.35;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        word-break: break-word;
    }

    .admin-property-card .property-title a {
        color: #212529;
        text-decoration: none;
    }

    .admin-property-card .property-title a:hover {
        color: #0d6efd;
    }

    .admin-property-card .property-price-block {
        display: flex;
        flex-wrap: wrap;
        align-items: baseline;
        gap: 6px 8px;
        line-height: 1.2;
    }

    .admin-property-card .property-price {
        font-size: 16px;
        font-weight: 700;
        color: #198754;
        white-space: nowrap;
    }

    .admin-property-card .original-price {
        font-size: 12px;
        color: #868e96;
        text-decoration: line-through;
        white-space: nowrap;
    }

    .admin-property-card .property-location {
        display: flex;
        align-items: flex-start;
        gap: 4px;
        font-size: 12px;
        color: #6c757d;
        line-height: 1.35;
        min-width: 0;
    }

    .admin-property-card .property-location i {
        flex-shrink: 0;
        margin-top: 2px;
        font-size: 13px;
    }

    .admin-property-card .property-location span {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        min-width: 0;
    }

    .admin-property-card .property-details {
        display: flex;
        flex-wrap: wrap;
        gap: 8px 12px;
        font-size: 12px;
        color: #495057;
    }

    .admin-property-card .detail-item {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
    }

    .admin-property-card .detail-item i {
        font-size: 13px;
        color: #868e96;
    }

    .admin-property-card .property-footer {
        margin-top: auto;
        padding-top: 8px;
        border-top: 1px solid #e9ecef;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .admin-property-card .property-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
        font-size: 11px;
        color: #868e96;
        min-width: 0;
    }

    .admin-property-card .property-type {
        background: #f1f3f5;
        padding: 2px 6px;
        border-radius: 4px;
        font-weight: 500;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 70%;
    }

    .admin-property-card .property-realtor {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        color: #6c757d;
        min-width: 0;
    }

    .admin-property-card .property-realtor span {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .admin-property-card .property-actions {
        display: flex;
        border-top: 1px solid #e9ecef;
        padding: 8px 10px;
        gap: 8px;
        justify-content: flex-end;
        background: #fafbfc;
    }

    .admin-property-card .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        border: none;
        cursor: pointer;
        flex-shrink: 0;
        transition: background 0.15s ease;
    }

    .admin-property-card .btn-view { background: #17a2b8; color: #fff; }
    .admin-property-card .btn-view:hover { background: #138496; color: #fff; }
    .admin-property-card .btn-edit { background: #ffc107; color: #212529; }
    .admin-property-card .btn-edit:hover { background: #e0a800; }
    .admin-property-card .btn-delete { background: #dc3545; color: #fff; }
    .admin-property-card .btn-delete:hover { background: #c82333; }

    .admin-property-card .delete-form {
        display: contents;
    }
    </style>
    @endpush
@endonce
