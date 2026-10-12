@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h3>Team Members</h3>
        @if(auth()->user()->canManageTeam())
            <div class="flex gap10 flex-wrap">
                <a href="{{ route('admin.team.invite.create') }}" class="tf-button-primary"><i class="flaticon-user"></i> Invite realtor</a>
                <a href="{{ route('admin.team.create') }}" class="tf-button-default"><i class="flaticon-plus"></i> Add member</a>
            </div>
        @endif
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
                                                @if($member->photo)
                                                    <img src="{{ asset('storage/uploads/team/'.$member->photo) }}" alt="">
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center bg-light text-muted" style="width:120px;height:120px;border-radius:8px;">No photo</div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="infor">
                                                    <div class="name" style="padding-bottom:0px">
                                                        <a href="{{ route('admin.team.show', $member) }}">{{ $member->name }} <span>({{ $member->role }})</span></a>
                                                        @if($member->user_id && $member->user?->isActive() && ! $member->user?->onboarding_completed_at)
                                                            <span class="badge bg-primary ms-8" title="Invited — waiting for password setup and profile completion">Pending setup</span>
                                                        @elseif($member->user_id && $member->user?->isActive())
                                                            <span class="badge bg-success ms-8" title="Can log in and manage listings">Listings active</span>
                                                        @elseif($member->user_id)
                                                            <span class="badge bg-danger ms-8" title="Login account is deactivated">Listings inactive</span>
                                                        @else
                                                            <span class="badge bg-secondary ms-8" title="Website profile only">Profile only</span>
                                                        @endif
                                                        @if($member->is_visible)
                                                            <span class="badge bg-info ms-8" title="Visible on public pages">Visible</span>
                                                        @else
                                                            <span class="badge bg-warning text-dark ms-8" title="Hidden from public pages">Hidden</span>
                                                        @endif
                                                    </div>
                                                    <p>{{ $member->bio }}</p>
                                                </div>
                                                <div class="flex gap30 flex-wrap wrap-contact">
                                                    @if($member->phone)
                                                    <a class="tf-button-icon-before style-1">
                                                        <i class="flaticon-phone"></i>
                                                        <div>
                                                            <div class="title">Phone</div>
                                                            <span>{{ $member->phone }}</span>
                                                        </div>
                                                    </a>
                                                    @endif
                                                    @if($member->email)
                                                    <a class="tf-button-icon-before style-1">
                                                        <i class="flaticon-message"></i>
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
                                @if(auth()->user()->canManageTeam())
                                    <a href="{{ route('admin.team.edit', $member) }}" class="tf-button-no-bg d-inline align-items-center"><i class="flaticon-edit"></i> Edit</a>
                                    @if($member->user_id && $member->user?->isActive())
                                        <form action="{{ route('admin.team.resend-invite', $member) }}" method="POST" style="display:inline-block;" class="resend-invite-form" data-team-name="{{ e($member->name) }}">
                                            @csrf
                                            <button type="submit" class="tf-button-no-bg resend-invite-btn">Resend invite</button>
                                        </form>
                                    @endif
                                    @if($member->user_id)
                                        <form action="{{ route('admin.team.toggle-listing-account', $member) }}" method="POST" style="display:inline-block;" class="account-toggle-form" data-team-name="{{ e($member->name) }}" data-active="{{ $member->user?->isActive() ? '1' : '0' }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="tf-button-no-bg account-toggle-btn">
                                                {{ $member->user?->isActive() ? 'Deactivate account' : 'Reactivate account' }}
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.team.toggle-visibility', $member) }}" method="POST" style="display:inline-block;" class="visibility-toggle-form" data-team-name="{{ e($member->name) }}" data-visible="{{ $member->is_visible ? '1' : '0' }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="tf-button-no-bg visibility-toggle-btn">
                                            {{ $member->is_visible ? 'Turn off visibility' : 'Turn on visibility' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.team.destroy', $member) }}" method="POST" style="display:inline-block;" class="delete-form" data-team-name="{{ e($member->name) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="tf-button-no-bg delete-btn"><i class="flaticon-delete"></i>Delete</button>
                                    </form>
                                @else
                                    <span class="text-muted small">Main admin controls only</span>
                                @endif
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

function confirmAccountToggle(teamMemberName, isActive) {
    const action = isActive ? 'deactivate listing access for' : 'reactivate listing access for';
    return confirm(`Are you sure you want to ${action} "${teamMemberName}"?`);
}

function confirmVisibilityToggle(teamMemberName, isVisible) {
    const action = isVisible ? 'hide' : 'show';
    return confirm(`Are you sure you want to ${action} "${teamMemberName}" on public team pages?`);
}

function confirmResendInvite(teamMemberName) {
    return confirm(`Resend the password-setup email to "${teamMemberName}"?`);
}

// Add some visual feedback for delete button
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn, .account-toggle-btn, .visibility-toggle-btn, .resend-invite-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f9fa';
        });
        button.addEventListener('mouseleave', function() {
            this.style.color = '';
            this.style.backgroundColor = '';
        });
    });

    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            if (! confirmDelete(this.dataset.teamName || 'this team member')) {
                event.preventDefault();
            }
        });
    });

    document.querySelectorAll('.account-toggle-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            if (! confirmAccountToggle(this.dataset.teamName || 'this team member', this.dataset.active === '1')) {
                event.preventDefault();
            }
        });
    });

    document.querySelectorAll('.visibility-toggle-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            if (! confirmVisibilityToggle(this.dataset.teamName || 'this team member', this.dataset.visible === '1')) {
                event.preventDefault();
            }
        });
    });

    document.querySelectorAll('.resend-invite-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            if (! confirmResendInvite(this.dataset.teamName || 'this team member')) {
                event.preventDefault();
            }
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

.account-toggle-btn:hover {
    background-color: #fff3cd !important;
    color: #856404 !important;
    border: 1px solid #ffeeba;
}

.visibility-toggle-btn:hover {
    background-color: #d1ecf1 !important;
    color: #0c5460 !important;
    border: 1px solid #bee5eb;
}

.resend-invite-btn:hover {
    background-color: #e2e3f3 !important;
    color: #383d7c !important;
    border: 1px solid #c8cae6;
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