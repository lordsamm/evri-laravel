<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — Evri Shipments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            /* Evri-inspired Purple Palette */
            --evri-purple-primary: #6b21a8;
            --evri-purple-light: #a855f7;
            --evri-purple-dark: #4c1d95;
            --evri-purple-bg: #f5f3ff;
            
            /* Neutral Colors */
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            
            /* Status Colors */
            --success: #10b981;
            --success-bg: #d1fae5;
            --danger: #ef4444;
            --danger-bg: #fee2e2;
            --warning: #f59e0b;
            --warning-bg: #fef3c7;
            --info: #3b82f6;
            --info-bg: #dbeafe;
            
            /* Spacing */
            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --spacing-2xl: 3rem;
            
            /* Border Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            
            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--gray-50);
            color: var(--gray-800);
            line-height: 1.5;
        }
        
        /* Admin Header */
        .admin-header {
            background: linear-gradient(135deg, var(--evri-purple-primary) 0%, var(--evri-purple-dark) 100%);
            color: #fff;
            padding: var(--spacing-lg) var(--spacing-xl);
            box-shadow: var(--shadow-md);
        }
        .admin-header h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.025em;
        }
        .admin-header a {
            color: #fff;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        .admin-header a:hover {
            opacity: 0.9;
        }
        
        /* Admin Navigation */
        .admin-nav {
            margin-top: var(--spacing-md);
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-md);
            align-items: center;
        }
        .admin-nav a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--radius-md);
            transition: all 0.2s;
        }
        .admin-nav a:hover {
            background: rgba(255, 255, 255, 0.1);
            text-decoration: none;
        }
        .admin-nav button {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 500;
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--radius-md);
            transition: all 0.2s;
        }
        .admin-nav button:hover {
            background: rgba(255, 255, 255, 0.25);
        }
        
        /* Admin Container */
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: var(--spacing-xl);
        }
        
        /* Cards */
        .card {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }
        .card.p-4 {
            padding: var(--spacing-xl);
        }
        
        /* Stat Cards */
        .stat-card {
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .stat-card:hover {
            text-decoration: none;
            color: inherit;
        }
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: var(--spacing-sm);
            line-height: 1;
        }
        .stat-number {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: var(--spacing-xs);
            color: var(--gray-800);
            line-height: 1.2;
        }
        .stat-title {
            font-size: 0.875rem;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }
        
        /* Alerts */
        .alert {
            padding: var(--spacing-md) var(--spacing-lg);
            border-radius: var(--radius-lg);
            margin-bottom: var(--spacing-lg);
            border-left: 4px solid;
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
        }
        .alert-success {
            background: var(--success-bg);
            border-color: var(--success);
            color: #065f46;
        }
        .alert-danger {
            background: var(--danger-bg);
            border-color: var(--danger);
            color: #991b1b;
        }
        .alert-warning {
            background: var(--warning-bg);
            border-color: var(--warning);
            color: #92400e;
        }
        .alert-info {
            background: var(--info-bg);
            border-color: var(--info);
            color: #1e40af;
        }
        
        /* Buttons */
        .btn {
            padding: var(--spacing-sm) var(--spacing-lg);
            border-radius: var(--radius-md);
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-sm);
            text-decoration: none;
            line-height: 1.5;
        }
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        .btn:active {
            transform: translateY(0);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--evri-purple-primary) 0%, var(--evri-purple-dark) 100%);
            color: #fff;
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--evri-purple-dark) 0%, var(--evri-purple-primary) 100%);
            color: #fff;
        }
        
        .btn-secondary {
            background: #fff;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
        }
        .btn-secondary:hover {
            background: var(--gray-50);
            border-color: var(--gray-400);
            color: var(--gray-800);
        }
        
        .btn-success {
            background: var(--success);
            color: #fff;
            border: none;
        }
        .btn-success:hover {
            background: #059669;
            color: #fff;
        }
        
        .btn-danger {
            background: var(--danger);
            color: #fff;
            border: none;
        }
        .btn-danger:hover {
            background: #dc2626;
            color: #fff;
        }
        
        .btn-sm {
            padding: var(--spacing-xs) var(--spacing-md);
            font-size: 0.875rem;
        }
        
        .btn-lg {
            padding: var(--spacing-md) var(--spacing-xl);
            font-size: 1rem;
        }
        
        /* Tables */
        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }
        .table thead {
            background: var(--gray-50);
        }
        .table th {
            text-align: left;
            padding: var(--spacing-md) var(--spacing-lg);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--gray-500);
            font-weight: 600;
            border-bottom: 2px solid var(--gray-200);
        }
        .table td {
            padding: var(--spacing-md) var(--spacing-lg);
            border-bottom: 1px solid var(--gray-200);
            vertical-align: middle;
            color: var(--gray-700);
        }
        .table tbody tr {
            transition: background-color 0.2s;
        }
        .table tbody tr:hover {
            background-color: var(--evri-purple-bg);
        }
        .table tbody tr:last-child td {
            border-bottom: none;
        }
        
        /* Forms */
        .form-group {
            margin-bottom: var(--spacing-lg);
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: var(--spacing-sm);
            color: var(--gray-700);
            font-size: 0.95rem;
        }
        input, select, textarea {
            width: 100%;
            max-width: 480px;
            padding: var(--spacing-sm) var(--spacing-md);
            border: 1px solid var(--gray-300);
            border-radius: var(--radius-md);
            font: inherit;
            font-size: 0.95rem;
            transition: all 0.2s;
            background: #fff;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--evri-purple-primary);
            box-shadow: 0 0 0 3px rgba(107, 33, 168, 0.1);
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        .help-text {
            font-size: 0.875rem;
            color: var(--gray-500);
            margin-top: var(--spacing-sm);
        }
        .error-text {
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: var(--spacing-sm);
            font-weight: 500;
        }
        
        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-xl);
            gap: var(--spacing-lg);
            flex-wrap: wrap;
        }
        .page-header h2 {
            margin: 0;
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--gray-800);
            letter-spacing: -0.025em;
        }
        
        /* Detail Grid */
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-lg);
        }
        .detail-item strong {
            display: block;
            font-size: 0.875rem;
            color: var(--gray-500);
            margin-bottom: var(--spacing-xs);
            text-transform: uppercase;
            letter-spacing: 0.025em;
            font-weight: 600;
        }
        .detail-item span {
            font-size: 1rem;
            color: var(--gray-800);
            font-weight: 500;
        }
        
        /* Status Badges */
        .badge {
            display: inline-block;
            padding: var(--spacing-xs) var(--spacing-md);
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }
        .badge-success {
            background: var(--success-bg);
            color: #065f46;
        }
        .badge-danger {
            background: var(--danger-bg);
            color: #991b1b;
        }
        .badge-warning {
            background: var(--warning-bg);
            color: #92400e;
        }
        .badge-info {
            background: var(--info-bg);
            color: #1e40af;
        }
        .badge-purple {
            background: var(--evri-purple-bg);
            color: var(--evri-purple-dark);
        }
        
        /* Dashboard Footer */
        .dashboard-footer {
            margin-top: var(--spacing-2xl);
            padding-top: var(--spacing-lg);
            border-top: 1px solid var(--gray-200);
            color: var(--gray-500);
            font-size: 0.875rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .admin-header {
                padding: var(--spacing-md) var(--spacing-lg);
            }
            .admin-header h1 {
                font-size: 1.25rem;
            }
            .admin-nav {
                flex-direction: column;
                align-items: flex-start;
            }
            .admin-container {
                padding: var(--spacing-md);
            }
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .page-header h2 {
                font-size: 1.5rem;
            }
            .stat-number {
                font-size: 1.75rem;
            }
            .table {
                font-size: 0.875rem;
            }
            .table th, .table td {
                padding: var(--spacing-sm) var(--spacing-md);
            }
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <h1><a href="{{ route('admin.dashboard') }}">Evri Admin — Dashboard</a></h1>
        <nav class="admin-nav">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.shipments.index') }}">All Shipments</a>
            <a href="{{ route('admin.shipments.create') }}">Create Shipment</a>
            <a href="{{ route('admin.countries.index') }}">Countries</a>
            <a href="{{ route('admin.payment-proofs.index') }}">Payment Proofs</a>
            <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: #fff; cursor: pointer; font-size: 0.95rem;">Logout</button>
            </form>
        </nav>
    </header>

    <main class="admin-container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
