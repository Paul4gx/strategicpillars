@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h3>Team Members</h3>
        <a href="{{ route('admin.team.create') }}" class="tf-button-default"> <i class="flaticon-plus"></i> Add Member</a>
    </div>
    <div class="text-content">Review Team</div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
<div class="">
<div class="flex gap30 mb-30 flex-column">
     @foreach($teamMembers as $member)
                                    <div class="wg-box agents-item wow fadeInUp">
                                        <div class="flex gap40">
                                            <div class="image">
                                                <img src="{{ asset('storage/uploads/team/'.$member->photo) }}" alt="">
                                            </div>
                                            <div>
                                                <div class="infor">
                                                    <div class="name" style="padding-bottom:0px">
                                                        <a href="{{ route('admin.team.show', $member) }}">{{ $member->name }} <span>({{ $member->role }})</span></a>
                                                    </div>
                                                    <p>{{ $member->bio }}</p>
                                                </div>
                                                <div class="flex gap30 flex-wrap wrap-contact">
                                                    @if($member->phone)
                                                    <a href="tel:{{ $member->phone }}" class="tf-button-icon-before style-1">
                                                        <i class="flaticon-phone"></i>
                                                        <div>
                                                            <div class="title">Phone</div>
                                                            <span>{{ $member->phone }}</span>
                                                        </div>
                                                    </a>
                                                    @endif
                                                    @if($member->email)
                                                    <a href="mailto:{{ $member->email }}" class="tf-button-icon-before style-1">
                                                        <i class="flaticon-email"></i>
                                                        <div>
                                                            <div class="title">Email</div>
                                                            <span>{{ $member->email }}</span>
                                                        </div>
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bot">
                                            <div class="wg-social style-black">
                                                <ul class="list-social">
                                                    @if($member->social_links && is_array($member->social_links))
                                                        @foreach($member->social_links as $social)
                                                            @if($social['platform'] === 'facebook')
                                                                <li><a href="https://facebook.com/{{ $social['username'] }}" target="_blank"><i class="icon-facebook"></i></a></li>
                                                            @elseif($social['platform'] === 'twitter')
                                                                <li><a href="https://twitter.com/{{ $social['username'] }}" target="_blank"><i class="icon-twitter"></i></a></li>
                                                            @elseif($social['platform'] === 'instagram')
                                                                <li><a href="https://instagram.com/{{ $social['username'] }}" target="_blank"><i class="icon-instagram"></i></a></li>
                                                            @elseif($social['platform'] === 'linkedin')
                                                                <li><a href="https://linkedin.com/in/{{ $social['username'] }}" target="_blank"><i class="icon-linkedin2"></i></a></li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="action-buttons">
                                <a href="{{ route('admin.team.edit', $member) }}" class="tf-button-no-bg d-inline align-items-center" style="margin-right:20px;"><i class="flaticon-edit"></i> Edit</a>
                                <form action="{{ route('admin.team.destroy', $member) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete('{{ $member->name }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="tf-button-no-bg delete-btn"><i class="flaticon-delete"></i>Delete</button>
                                </form>
                                        </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    </div>
                                    </div>
@endsection

@push('scripts')
<script>
function confirmDelete(teamMemberName) {
    return confirm(`Are you sure you want to delete "${teamMemberName}"? This action cannot be undone.`);
}

// Add some visual feedback for delete button
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.color = '#dc3545';
            this.style.backgroundColor = '#f8d7da';
        });
        button.addEventListener('mouseleave', function() {
            this.style.color = '';
            this.style.backgroundColor = '';
        });
    });
});
</script>
@endpush

@push('styles')
<style>
.action-buttons {
    display: flex;
    align-items: center;
    gap: 10px;
}

.delete-btn {
    transition: all 0.3s ease;
    border-radius: 4px;
    padding: 8px 12px;
}

.delete-btn:hover {
    background-color: #f8d7da !important;
    color: #dc3545 !important;
    border: 1px solid #f5c6cb;
}

.tf-button-no-bg {
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 8px 12px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.tf-button-no-bg:hover {
    background-color: #f8f9fa;
    text-decoration: none;
}
</style>
@endpush 