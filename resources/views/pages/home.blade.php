@if (auth()->user()->role == 'admin')
    @include('pages.dashboardAdmin')
@elseif (auth()->user()->role == 'user')
    @include('pages.dashboard')
@endif
