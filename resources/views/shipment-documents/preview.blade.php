@extends('layouts.admin')

@section('title', 'Preview Document')

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Preview Document - {{ $document->document_name }}</h2>
        <a href="{{ route('admin.shipments.documents.index', $document->shipment) }}" class="btn btn-secondary">Back to Documents</a>
    </div>

    <div class="card p-4">
        @if($document->isPdf())
            <iframe src="{{ asset('storage/' . $document->file_path) }}" width="100%" height="800px" style="border: none;"></iframe>
        @elseif($document->isImage())
            <div class="text-center">
                <img src="{{ asset('storage/' . $document->file_path) }}" alt="{{ $document->document_name }}" class="img-fluid" style="max-height: 800px;">
            </div>
        @else
            <div class="alert alert-warning">
                <p class="mb-0">This file type cannot be previewed in the browser.</p>
                <a href="{{ route('admin.shipments.documents.download', [$document->shipment, $document]) }}" class="btn btn-primary mt-2">Download File</a>
            </div>
        @endif
    </div>
</div>
@endsection
