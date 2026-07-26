<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Submit Payment Proof - {{ $fee->fee_name }}</title>
    <script type="text/javascript" src="{{ asset('js/cookie-banner/gtag-consent.js') }}"></script><script type="text/javascript" src="{{ asset('js/cookie-banner/insert-script-utils.js') }}"></script><script type="text/javascript" src="{{ asset('js/cookie-banner/getcookie-override.js') }}"></script><script type="text/javascript" src="{{ asset('js/cookie-banner/scripts-prod.js') }}"></script><script type="text/javascript" src="{{ asset('js/cookie-banner/iframe-check.js') }}"></script><script id="js-cookie-banner-init" type="text/javascript" src="{{ asset('js/cookie-banner/cookie-banner-init.js') }}"></script><script type="text/javascript" src="{{ asset('js/cookie-banner/consent-changed.js') }}"></script><script type="text/javascript" src="{{ asset('js/cookie-banner/consent-check.js') }}"></script><script src="{{ asset('static.cdn.prismic.io/prismic0962.js') }}" async defer crossorigin="anonymous" data-hid="prismic-preview"></script><style>@font-face{font-family:poppins;src:url({{ asset('poppins-regular-webfont.eot') }});src:url({{ asset('poppins-regular-webfontd41d.eot') }}) format("embedded-opentype"),url({{ asset('poppins-regular-webfont.woff2') }}) format("woff2"),url({{ asset('poppins-regular-webfont.woff') }}) format("woff"),url({{ asset('poppins-regular-webfont.ttf') }}) format("truetype"),url(404-not-found.html#poppinsregular) format("svg");font-weight:400;font-style:normal}@font-face{font-family:poppins;src:url({{ asset('poppins-semibold-webfont.eot') }});src:url({{ asset('poppins-semibold-webfontd41d.eot') }}) format("embedded-opentype"),url({{ asset('poppins-semibold-webfont.woff2') }}) format("woff2"),url({{ asset('poppins-semibold-webfont.woff') }}) format("woff"),url({{ asset('poppins-semibold-webfont.ttf') }}) format("truetype"),url({{ asset('poppins-semibold-webfont.svg') }}) format("svg");font-weight:700;font-style:normal}body[data-v-ce18f008]{font-family:poppins}[data-v-ce18f008],[data-v-ce18f008]:after,[data-v-ce18f008]:before{box-sizing:border-box;paddi...[4046 bytes truncated]
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
    </style>
</head>
<body>
<div style="min-height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 2rem 1rem 4rem;">
    <div style="max-width: 700px; margin: 0 auto;">
        @if(session('success'))
            <div style="background: #10b981; color: white; padding: 1rem 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <span style="font-weight: 500;">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div style="background: #ef4444; color: white; padding: 1rem 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span style="font-weight: 500;">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div style="background: white; border-radius: 16px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); overflow: hidden;">
            <div style="background: linear-gradient(135deg, #0066cc 0%, #004499 100%); padding: 2rem; text-align: center;">
                <div style="margin-bottom: 1rem;">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
                <h1 style="color: white; font-size: 1.75rem; font-weight: 700; margin: 0;">Submit Payment Proof</h1>
                <p style="color: rgba(255,255,255,0.9); margin: 0.5rem 0 0 0; font-size: 1rem;">Upload proof of payment for your shipment fee</p>
            </div>

            <div style="padding: 2rem;">
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem;">
                    <h2 style="font-size: 1.125rem; font-weight: 600; color: #1e293b; margin: 0 0 1rem 0; display: flex; align-items: center; gap: 0.5rem;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0066cc" stroke-width="2">
                            <rect x="1" y="3" width="15" height="13"></rect>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg>
                        Shipment Summary
                    </h2>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <div>
                            <label style="font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem; display: block;">Tracking Number</label>
                            <div style="font-family: 'Courier New', monospace; font-size: 1rem; font-weight: 600; color: #0066cc;">{{ $fee->shipment->tracking_number }}</div>
                        </div>
                        <div>
                            <label style="font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem; display: block;">Fee Name</label>
                            <div style="font-size: 1rem; font-weight: 500; color: #1e293b;">{{ $fee->fee_name }}</div>
                        </div>
                        <div>
                            <label style="font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem; display: block;">Amount Due</label>
                            <div style="font-size: 1.25rem; font-weight: 700; color: #059669;">£{{ number_format($fee->amount, 2) }}</div>
                        </div>
                        <div>
                            <label style="font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem; display: block;">Status</label>
                            <div style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600; text-transform: capitalize; background: #fef3c7; color: #92400e;">{{ ucfirst($fee->status) }}</div>
                        </div>
                        @if($fee->due_date)
                        <div>
                            <label style="font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem; display: block;">Due Date</label>
                            <div style="font-size: 1rem; font-weight: 500; color: #1e293b;">{{ $fee->due_date->format('d M Y') }}</div>
                        </div>
                        @endif
                    </div>
                </div>

                <form method="POST" action="{{ route('payment-proofs.store', [$fee->shipment, $fee]) }}" enctype="multipart/form-data">
                    @csrf

                    <div style="margin-bottom: 1.5rem;">
                        <label for="payer_name" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1e293b; margin-bottom: 0.5rem;">Payer Name <span style="color: #ef4444;">*</span></label>
                        <input type="text" id="payer_name" name="payer_name" value="{{ old('payer_name') }}" required style="width: 100%; padding: 0.875rem 1rem; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 1rem; transition: all 0.2s; @error('payer_name') border-color: #ef4444; background-color: #fef2f2; @enderror" placeholder="Enter your full name">
                        @error('payer_name')
                            <div style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label for="payment_reference" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1e293b; margin-bottom: 0.5rem;">Payment Reference (Optional)</label>
                        <input type="text" id="payment_reference" name="payment_reference" value="{{ old('payment_reference') }}" style="width: 100%; padding: 0.875rem 1rem; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 1rem; transition: all 0.2s; @error('payment_reference') border-color: #ef4444; background-color: #fef2f2; @enderror" placeholder="e.g., Transaction ID, Order number">
                        @error('payment_reference')
                            <div style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label for="receipt" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1e293b; margin-bottom: 0.5rem;">Receipt Upload <span style="color: #ef4444;">*</span></label>
                        <input type="file" id="receipt" name="receipt" accept=".jpg,.jpeg,.png,.pdf" required style="display: none;">
                        
                        <div id="upload-area" style="border: 2px dashed #cbd5e1; border-radius: 12px; padding: 2.5rem 2rem; text-align: center; background: #f8fafc; cursor: pointer; transition: all 0.3s; @error('receipt') border-color: #ef4444; background-color: #fef2f2; @enderror">
                            <div id="upload-placeholder">
                                <div style="margin-bottom: 1rem;">
                                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                </div>
                                <div style="color: #1e293b; font-size: 1.125rem; font-weight: 600; margin-bottom: 0.5rem;">Click to upload or drag and drop</div>
                                <div style="color: #64748b; font-size: 0.875rem;">PDF, PNG, JPG, JPEG (max 10MB)</div>
                            </div>
                            
                            <div id="file-preview" style="display: none;">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; margin-bottom: 1rem;">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                    <div style="text-align: left;">
                                        <div style="color: #1e293b; font-size: 1rem; font-weight: 600;" id="file-name"></div>
                                        <div style="color: #64748b; font-size: 0.875rem;" id="file-size"></div>
                                    </div>
                                </div>
                                <button type="button" id="remove-file" style="padding: 0.5rem 1rem; border: none; border-radius: 6px; background-color: #ef4444; color: white; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: background-color 0.2s;">Remove File</button>
                            </div>
                        </div>
                        @error('receipt')
                            <div style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                        @enderror

                        <div style="margin-top: 1rem; padding: 1rem; background: #fef3c7; border-left: 4px solid #f59e0b; border-radius: 4px;">
                            <div style="display: flex; align-items: start; gap: 0.75rem;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2">
                                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                    <line x1="12" y1="9" x2="12" y2="13"></line>
                                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                </svg>
                                <div>
                                    <div style="font-weight: 600; color: #92400e; font-size: 0.875rem; margin-bottom: 0.25rem;">Security Notice</div>
                                    <div style="color: #b45309; font-size: 0.875rem; line-height: 1.5;">Accepted file types: PDF, PNG, JPG, JPEG. Maximum file size: 10MB. All uploads are encrypted and securely stored.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-bottom: 2rem;">
                        <label for="note" style="display: block; font-size: 0.875rem; font-weight: 600; color: #1e293b; margin-bottom: 0.5rem;">Additional Note (Optional)</label>
                        <textarea id="note" name="note" rows="4" style="width: 100%; padding: 0.875rem 1rem; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 1rem; resize: vertical; transition: all 0.2s; @error('note') border-color: #ef4444; background-color: #fef2f2; @enderror" placeholder="Add any additional information about your payment...">{{ old('note') }}</textarea>
                        @error('note')
                            <div style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="display: flex; gap: 1rem; flex-direction: column;">
                        <button type="submit" style="width: 100%; padding: 1rem 2rem; border: none; border-radius: 8px; background: linear-gradient(135deg, #0066cc 0%, #004499 100%); color: white; font-size: 1rem; font-weight: 600; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 6px rgba(0,102,204,0.3);">
                            Submit Payment Proof
                        </button>
                        <a href="{{ route('tracking.show', $fee->shipment->tracking_number) }}" style="width: 100%; padding: 1rem 2rem; border-radius: 8px; background-color: #64748b; color: white; text-decoration: none; font-size: 1rem; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; transition: all 0.3s;">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('upload-area');
    const fileInput = document.getElementById('receipt');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const filePreview = document.getElementById('file-preview');
    const fileName = document.getElementById('file-name');
    const fileSize = document.getElementById('file-size');
    const removeFileBtn = document.getElementById('remove-file');
    const MAX_SIZE = 10 * 1024 * 1024;
    
    uploadArea.addEventListener('click', function(e) {
        if (e.target !== removeFileBtn) fileInput.click();
    });
    
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.style.borderColor = '#0066cc';
        uploadArea.style.backgroundColor = '#e6f0ff';
    });
    
    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.style.borderColor = '#cbd5e1';
        uploadArea.style.backgroundColor = '#f8fafc';
    });
    
    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.style.borderColor = '#cbd5e1';
        uploadArea.style.backgroundColor = '#f8fafc';
        const files = e.dataTransfer.files;
        if (files.length > 0) handleFile(files[0]);
    });
    
    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) handleFile(e.target.files[0]);
    });
    
    removeFileBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        fileInput.value = '';
        uploadPlaceholder.style.display = 'block';
        filePreview.style.display = 'none';
    });
    
    function handleFile(file) {
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
        if (!validTypes.includes(file.type)) {
            alert('Please select a valid file (PDF, PNG, JPG, or JPEG).');
            return;
        }
        if (file.size > MAX_SIZE) {
            alert('File size must be less than 10MB.');
            return;
        }
        fileName.textContent = file.name;
        fileSize.textContent = formatFileSize(file.size);
        uploadPlaceholder.style.display = 'none';
        filePreview.style.display = 'block';
    }
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
});
</script>
</body>
</html>
