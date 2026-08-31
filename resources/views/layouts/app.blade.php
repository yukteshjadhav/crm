<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CRM Portal')</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- SIDEBAR --}}
    @include('layouts.partials.sidebar')

    {{-- MAIN --}}
    <div class="main">
        {{-- HEADER --}}
        @include('layouts.partials.header')

        <div class="content">
            @yield('content')
        </div>
    </div>

    {{-- Custom Logout Modal --}}
    <div class="logout-modal" id="logoutModal">
        <div class="logout-modal-content">
            <div class="logout-modal-icon">
                <svg viewBox="0 0 24 24" width="32" height="32" fill="#dc2626">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                </svg>
            </div>
            <h3>Logout Confirmation</h3>
            <p>Are you sure you want to logout?</p>
            <div class="logout-modal-actions">
                <button type="button" class="btn-cancel" id="cancelLogout">Cancel</button>
                <button type="button" class="btn-confirm" id="confirmLogout">Yes, Logout</button>
            </div>
        </div>
    </div>

</body>

</html>