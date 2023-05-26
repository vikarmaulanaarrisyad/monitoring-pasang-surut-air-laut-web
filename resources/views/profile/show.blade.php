@extends('layouts.app')

@section('title', 'Profile')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        @if (empty(Auth()->user()->avatar))
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('AdminLTE/dist/img/user1-128x128.jpg') }}" alt="User profile picture"
                                width="400">
                        @else
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ Storage::url(Auth()->user()->avatar) }}" alt="User profile picture" width="400">
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link @if (request('pills') == '') active @endif"
                                href="{{ route('profile.show') }}">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (request('pills') == 'password') active @endif"
                                href="{{ route('profile.show') }}?pills=password">Password</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade @if (request('pills') == '') show active @endif" id="pills-profil"
                            role="tabpanel" aria-labelledby="pills-profil-tab">
                            @includeIf('profile.update-profile-information-form')
                        </div>
                        <div class="tab-pane fade @if (request('pills') == 'password') show active @endif" id="pills-password"
                            role="tabpanel" aria-labelledby="pills-password-tab">
                            @includeIf('profile.update-password-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<x-notif></x-notif>
