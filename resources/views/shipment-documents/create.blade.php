@extends('layouts.admin')

@section('title', 'Upload Document')

@section('content')
<div class="container-fluid p-0">
    <div class="page-header">
        <h2>Upload Document</h2>
        <a href="{{ route('admin.shipments.documents.index', $shipment) }}" class="btn btn-secondary">Back to Documents</a>
    </div>

    <div class="card p-4">
        <form method="POST" action="{{ route('admin.shipments.documents.store', $shipment) }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="document_name">Document Name</label>
                <input type="text" id="document_name" name="document_name" value="{{ old('document_name') }}" required>
                @error('document_name')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="document_type">Document Type</label>
                <select id="document_type" name="document_type" required>
                    <option value="">Select Document Type</option>
                    @foreach($documentTypes as $value => $label)
                        <option value="{{ $value }}" {{ old('document_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('document_type')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="file">Choose File</label>
                <input type="file" id="file" name="file" accept=".pdf,.png,.jpg,.jpeg" required>
                @error('file')
                    <div class="error-text">{{ $message }}</div>
                @enderror
                <div class="help-text">Allowed formats: PDF, PNG, JPG, JPEG. Maximum size: 10 MB.</div>
            </div>

            <button type="submit" class="btn btn-primary">Upload Document</button>
        </form>
    </div>
</div>
@endsection
