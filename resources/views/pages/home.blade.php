@if (auth()->user()->role == 'admin')
    @include('pages.dashboardAdmin')
@else
    @include('pages.dashboard')
@endif
