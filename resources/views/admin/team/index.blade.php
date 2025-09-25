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
                                                    <a href="tel:+68 685 93 283" class="tf-button-icon-before style-1">
                                                        <i class="flaticon-phone"></i>
                                                        <div>
                                                            <div class="title">Mobile</div>
                                                            <span>1-222-333-4444</span>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="tf-button-icon-before style-1">
                                                        <i class="flaticon-phone"></i>
                                                        <div>
                                                            <div class="title">Email</div>
                                                            <span>info@husthome.com</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bot">
                                            <div class="wg-social style-black">
                                                <ul class="list-social">
                                                    <li>
                                                        <a href="#">
                                                            <i class="icon-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="icon-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="icon-instagram"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="icon-linkedin2"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div >
                                <a href="{{ route('admin.team.edit', $member) }}" class="tf-button-no-bg d-inline align-items-center" style="margin-right:20px;"><i class="flaticon-edit"></i> Edit</a>
                                <form action="{{ route('admin.team.destroy', $member) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="tf-button-no-bg" onclick="return confirm('Delete this team member?')"><i class="flaticon-delete"></i>Delete</button>
                                </form>
                                        </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    </div>
                                    </div>
@endsection 