@extends('layouts.admin')

@section('title', 'Add Country')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1>Add Country</h1>
        </div>
        <div class="col text-end">
            <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">Back to Countries</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @include('countries._form')
        </div>
    </div>
</div>
@endsection
