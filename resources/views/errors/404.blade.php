@extends('layouts.admin')

@section('title', 'Page Not Found')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
        <div class="text-center" style="max-width: 500px;">
            <div style="font-size: 8rem; font-weight: 700; color: var(--evri-purple-primary); line-height: 1;">404</div>
            <h2 style="color: var(--evri-text-primary); margin-bottom: 1rem;">Page Not Found</h2>
            <p style="color: var(--evri-text-secondary); margin-bottom: 2rem; font-size: 1.1rem;">
                The page you're looking for doesn't exist or has been moved.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ url('/admin') }}" class="btn btn-primary">Go to Dashboard</a>
                <a href="javascript:history.back()" class="btn btn-secondary">Go Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
