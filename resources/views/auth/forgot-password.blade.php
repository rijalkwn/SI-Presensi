@extends('layouts.app')

@section('content')
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            @error('email')
                <span class="text-red-500 text-sm" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit">Email Password Reset Link</button>
        </div>
    </form>
@endsection
