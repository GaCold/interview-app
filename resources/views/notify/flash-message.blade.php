@if(Session::has('success'))
    <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
        <i class="ri-notification-off-line me-3 align-middle fs-16"></i><strong>@lang('Success')</strong>
        {{Session::get('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(Session::has('error'))
    <div class="alert alert-danger alert-border-left alert-dismissible fade show mb-xl-0" role="alert">
        <i class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>@lang('Danger')</strong>
        {{Session::get('error')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

