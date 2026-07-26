@extends('layouts.admin')

@section('title', 'Server Error')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
        <div class="text-center" style="max-width: 500px;">
            <div style="font-size: 8rem; font-weight: 700; color: var(--warning); line-height: 1;">500</div>
            <h2 style="color: var(--evri-text-primary); margin-bottom: 1rem;">Server Error</h2>
            <p style="color: var(--evri-text-secondary); margin-bottom: 2rem; font-size: 1.1rem;">
                Something went wrong on our end. Our team has been notified and we're working to fix it.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ url('/admin') }}" class="btn btn-primary">Go to Dashboard</a>
                <a href="javascript:location.reload()" class="btn btn-secondary">Try Again</a>
            </div>
        </div>
    </div>
</div>
@endsection
