@extends('layouts.admin')

@section('title', 'Edit Country')

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Edit Country</h2>
        <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">Back to Countries</a>
    </div>

    <div class="card p-4">
        @include('countries._form')
    </div>
</div>
@endsection
