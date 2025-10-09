@extends('layout.master')
@section('title', 'Profile')
@section('css')
    <!--font-awesome-css-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.css') }}">

    <!-- glight css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/glightbox/glightbox.min.css') }}">

    <!-- filepond css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/filepond/filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/filepond/image-preview.min.css') }}">

    <!-- slick css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/slick-theme.css') }}">
@endsection

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumb start -->
    <div class="row m-1">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="main-title">Profile</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li>
                        <a href="#" class="f-s-14 f-w-500">
                            <span><i class="ph-duotone ph-stack f-s-16"></i> Apps</span>
                        </a>
                    </li>
                    <li><a href="#" class="f-s-14 f-w-500">Profile</a></li>
                    <li class="active"><a href="#" class="f-s-14 f-w-500">Profile</a></li>
                </ul>
            </div>
            @if(auth()->id() === $user->id)
            <div>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm me-2">
                    <i class="ti ti-edit"></i> Edit Profile
                </a>
                <button type="button" class="btn btn-outline-secondary btn-sm me-2" id="shareProfile">
                    <i class="ti ti-share"></i> Share
                </button>
                <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#accountSettingsModal">
                    <i class="ti ti-settings"></i> Settings
                </button>
            </div>
            @endif
        </div>
    </div>
    <!-- Breadcrumb end -->

    <div class="row">
        <!-- Profile Image and Basic Info -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="profile-pic position-relative mb-3">
                        <div class="avatar-upload">
                            <div class="avatar-preview">
                              <div id="imgPreview">
                                @if($user->avatar)
                                  <img src="{{ asset('storage/'.$user->avatar) }}"
                                       alt="Profile Image">
                                @else
                                  <img src="{{ asset('assets/images/profile-app/01.png') }}"
                                       alt="Default Profile Image">
                                @endif
                              </div>
                            </div>

                        </div>
                        @if($user->is_online ?? false)
                        <span class="position-absolute bottom-0 end-0 translate-middle p-2 bg-success border border-light rounded-circle">
                            <span class="visually-hidden">Online</span>
                        </span>
                        @endif
                    </div>

                    <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                        <h5 class="f-w-600 mb-0">{{ $user->name }}</h5>
                        @if($user->email_verified_at)
                        <i class="ti ti-badge-filled text-success" title="Verified Email" data-bs-toggle="tooltip"></i>
                        @else
                        <i class="ti ti-alert-circle text-warning" title="Email Not Verified" data-bs-toggle="tooltip"></i>
                        @endif
                    </div>
                    
                    <p class="text-muted mb-3">{{ $user->role ?? 'User' }}</p>
                    
                    <!-- Account Status -->
                    <div class="mb-3">
                        <span class="badge bg-light-success text-success">
                            <i class="ti ti-circle-check f-s-12 me-1"></i>
                            Active Account
                        </span>
                        @if($user->email_verified_at)
                        <span class="badge bg-light-primary text-primary ms-1">
                            <i class="ti ti-mail-check f-s-12 me-1"></i>
                            Verified
                        </span>
                        @endif
                    </div>

                    <!-- Stats -->
                    <div class="row text-center mb-3">
                        <div class="col-4">
                            <h4 class="text-primary mb-0">{{ $user->posts_count ?? 0 }}</h4>
                            <small class="text-secondary">Posts</small>
                        </div>
                        <div class="col-4">
                            <h4 class="text-primary mb-0">{{ $user->followers_count ?? 0 }}</h4>
                            <small class="text-secondary">Followers</small>
                        </div>
                        <div class="col-4">
                            <h4 class="text-primary mb-0">{{ $user->following_count ?? 0 }}</h4>
                            <small class="text-secondary">Following</small>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2">
                        @if(auth()->id() !== $user->id)
                        <button type="button" class="btn btn-primary btn-sm" id="followButton">
                            <i class="ti ti-user-plus"></i> Follow
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="messageButton">
                            <i class="ti ti-message-circle"></i> Message
                        </button>
                        @else
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">
                            <i class="ti ti-edit"></i> Edit Profile
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Personal Information -->
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Personal Info</h6>
                    @if(auth()->id() === $user->id)
                    <a href="{{ route('profile.edit') }}" class="btn btn-link btn-sm p-0">
                        <i class="ti ti-edit f-s-14"></i>
                    </a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="info-list">
                        <div class="mb-3">
                            <span class="fw-medium d-block"><i class="ti ti-mail text-primary me-2"></i>Email</span>
                            <small class="text-secondary">{{ $user->email }}</small>
                        </div>

                        @if($user->phone)
                        <div class="mb-3">
                            <span class="fw-medium d-block"><i class="ti ti-phone text-primary me-2"></i>Phone</span>
                            <small class="text-secondary">{{ $user->phone }}</small>
                        </div>
                        @endif

                        @if($user->location)
                        <div class="mb-3">
                            <span class="fw-medium d-block"><i class="ti ti-map-pin text-primary me-2"></i>Location</span>
                            <small class="text-secondary">{{ $user->location }}</small>
                        </div>
                        @endif

                        @if($user->birth_date)
                        <div class="mb-3">
                            <span class="fw-medium d-block"><i class="ti ti-cake text-primary me-2"></i>Birthday</span>
                            <small class="text-secondary">{{ \Carbon\Carbon::parse($user->birth_date)->format('M d, Y') }}</small>
                        </div>
                        @endif

                        @if($user->department)
                        <div class="mb-3">
                            <span class="fw-medium d-block"><i class="ti ti-briefcase text-primary me-2"></i>Department</span>
                            <small class="text-secondary">{{ $user->department }}</small>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- About & Links -->
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="mb-0">About & Links</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="fw-medium d-block mb-2">Bio</span>
                        <p class="text-muted f-s-13">{{ $user->bio ?? 'No bio available.' }}</p>
                    </div>

                    @if($user->website)
                    <div class="mb-3">
                        <span class="fw-medium d-block"><i class="ti ti-world text-primary me-2"></i>Website</span>
                        <small>
                            <a href="{{ $user->website }}" target="_blank" class="text-decoration-none">Visit Site</a>
                        </small>
                    </div>
                    @endif

                    @if($user->github)
                    <div class="mb-3">
                        <span class="fw-medium d-block"><i class="ti ti-brand-github text-primary me-2"></i>GitHub</span>
                        <small>
                            <a href="https://github.com/{{ $user->github }}" target="_blank" class="text-decoration-none">@{{ $user->github }}</a>
                        </small>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Account Information (Only for own profile) -->
        <div class="col-md-3">
            @if(auth()->id() === $user->id)
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="mb-0">Account Info</h6>
                </div>
                <div class="card-body">
                    <div class="account-info">
                        <div class="mb-3">
                            <span class="fw-medium d-block"><i class="ti ti-id text-info me-2"></i>User ID</span>
                            <small class="text-secondary">#{{ $user->id }}</small>
                        </div>

                        <div class="mb-3">
                            <span class="fw-medium d-block"><i class="ti ti-calendar-plus text-info me-2"></i>Member Since</span>
                            <small class="text-secondary">{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}</small>
                        </div>

                        <div class="mb-3">
                            <span class="fw-medium d-block"><i class="ti ti-refresh text-info me-2"></i>Last Updated</span>
                            <small class="text-secondary">{{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</small>
                        </div>

                        <div class="mb-3">
                            <span class="fw-medium d-block"><i class="ti ti-shield-check text-info me-2"></i>Email Status</span>
                            @if($user->email_verified_at)
                            <span class="badge bg-light-success text-success f-s-11">
                                Verified
                            </span>
                            @else
                            <span class="badge bg-light-warning text-warning f-s-11">Not Verified</span>
                            @endif
                        </div>

                        @if($user->remember_token)
                        <div class="mb-3">
                            <span class="fw-medium d-block"><i class="ti ti-key text-info me-2"></i>Session</span>
                            <span class="badge bg-light-success text-success f-s-11">Active</span>
                        </div>
                        @endif

                        <div class="mt-3">
                            @if(!$user->email_verified_at)
                            <button type="button" class="btn btn-sm btn-outline-warning w-100 mb-2" id="resendVerification">
                                <i class="ti ti-mail"></i> Verify Email
                            </button>
                            @endif
                            <button type="button" class="btn btn-sm btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#accountSettingsModal">
                                <i class="ti ti-settings"></i> Settings
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <!-- Recent Activity for other users -->
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="mb-0">Recent Activity</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted text-center f-s-13">No recent activity to display.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Account Settings Modal -->
<div class="modal fade" id="accountSettingsModal" tabindex="-1" aria-labelledby="accountSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accountSettingsModalLabel">Account Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="ti ti-lock me-2"></i> Change Password
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="ti ti-bell me-2"></i> Notification Settings
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="ti ti-shield me-2"></i> Privacy Settings
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="ti ti-download me-2"></i> Download Data
                    </a>
                    <a href="#" class="list-group-item list-group-item-action text-danger">
                        <i class="ti ti-trash me-2"></i> Delete Account
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Tamaño del círculo */
.avatar-preview {
  width: 120px;
  height: 120px;
  margin: 0 auto; /* centrado opcional */
}

/* Contenedor circular sin aro, sin padding, sin fondo */
.avatar-preview #imgPreview {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  overflow: hidden;

  /* Overrides al template que te agrega aro/padding/fondo */
  border: 0 !important;
  padding: 0 !important;
  background: transparent !important;
  box-shadow: none !important;
}

/* La imagen debe llenar todo el círculo */
.avatar-preview #imgPreview img {
  width: 100%;
  height: 100%;
  object-fit: cover;        /* recorta para llenar */
  object-position: center;  /* centrada */
  display: block;           /* elimina gap de línea base */
  border-radius: 50%;       /* por si acaso */
}

</style>
@endsection

@section('script')
<!-- Glight js -->
<script src="{{ asset('assets/vendor/glightbox/glightbox.min.js') }}"></script>

<!-- filepond -->
<script src="{{ asset('assets/vendor/filepond/file-encode.min.js') }}"></script>
<script src="{{ asset('assets/vendor/filepond/validate-size.min.js') }}"></script>
<script src="{{ asset('assets/vendor/filepond/validate-type.js') }}"></script>
<script src="{{ asset('assets/vendor/filepond/exif-orientation.min.js') }}"></script>
<script src="{{ asset('assets/vendor/filepond/image-preview.min.js') }}"></script>
<script src="{{ asset('assets/vendor/filepond/filepond.min.js') }}"></script>

<!-- slick-file -->
<script src="{{ asset('assets/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/vendor/shepherdjs/shepherd.js') }}"></script>

<!-- js -->
<script src="{{ asset('assets/js/profile.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Share profile functionality
    const shareBtn = document.getElementById('shareProfile');
    if (shareBtn) {
        shareBtn.addEventListener('click', function() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $user->name }} - Profile',
                    url: window.location.href
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(window.location.href).then(function() {
                    // Show success message (you can replace with your toast/notification system)
                    alert('Profile link copied to clipboard!');
                });
            }
        });
    }

    // Resend verification email
    const resendBtn = document.getElementById('resendVerification');
    if (resendBtn) {
        resendBtn.addEventListener('click', function() {
            // Add your email verification logic here
            alert('Verification email sent!');
        });
    }
});
</script>
@endsection