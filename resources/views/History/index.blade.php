@if (auth()->user()->role == 'admin')
    @include('History.historyAdmin')
@elseif (auth()->user()->role == 'user')
    @include('History.historyUser')
@endif
