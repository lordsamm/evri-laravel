@extends('layouts.admin')

@section('title', 'Access Denied')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
        <div class="text-center" style="max-width: 500px;">
            <div style="font-size: 8rem; font-weight: 700; color: var(--danger); line-height: 1;">403</div>
            <h2 style="color: var(--evri-text-primary); margin-bottom: 1rem;">Access Denied</h2>
            <p style="color: var(--evri-text-secondary); margin-bottom: 2rem; font-size: 1.1rem;">
                You don't have permission to access this resource. Please contact your administrator if you believe this is an error.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ url('/admin') }}" class="btn btn-primary">Go to Dashboard</a>
                <a href="javascript:history.back()" class="btn btn-secondary">Go Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
