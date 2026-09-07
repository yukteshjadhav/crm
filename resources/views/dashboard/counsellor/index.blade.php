<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Lead Console • Premium Glass (Responsive)</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@500;600;700&family=Public+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: "#16213e",
                        "navy-deep": "#0f1730",
                        ink: "#1a2233",
                        "ink-muted": "#5b6472",
                        "ink-faint": "#8991a0",
                        accent: "#2f5fdb",
                        "accent-soft": "#eaf0fd",
                        success: "#1f9d64",
                        "success-soft": "#e7f7ef",
                        warning: "#b56a00",
                        "warning-soft": "#fbf1e2",
                        critical: "#c22e2e",
                        "critical-soft": "#fbeaea",
                    },
                    fontFamily: {
                        display: ["Libre Franklin", "sans-serif"],
                        body: ["Public Sans", "sans-serif"],
                        mono: ["IBM Plex Mono", "monospace"],
                    },
                },
            },
        };
    </script>
    <style>
        body {
            font-family: 'Public Sans', sans-serif;
            background: linear-gradient(135deg, #c7d2fe 0%, #e9d5ff 25%, #fbcfe8 50%, #bae6fd 75%, #c7d2fe 100%);
            background-size: 200% 200%;
            background-attachment: fixed;
            animation: gradientShift 18s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.45;
            pointer-events: none;
            z-index: 0;
        }

        .orb-1 {
            width: 480px;
            height: 480px;
            background: #818cf8;
            top: -120px;
            left: -100px;
        }

        .orb-2 {
            width: 380px;
            height: 380px;
            background: #f472b6;
            top: 30%;
            right: -80px;
        }

        .orb-3 {
            width: 320px;
            height: 320px;
            background: #38bdf8;
            bottom: -80px;
            left: 25%;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.18);
            border-radius: 4px;
        }

        .glass-nav {
            background: rgba(15, 23, 48, 0.78);
            backdrop-filter: blur(28px) saturate(160%);
            -webkit-backdrop-filter: blur(28px) saturate(160%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .glass-sidebar {
            background: rgba(255, 255, 255, 0.58);
            backdrop-filter: blur(32px) saturate(180%);
            -webkit-backdrop-filter: blur(32px) saturate(180%);
            border-right: 1px solid rgba(255, 255, 255, 0.45);
            box-shadow: 8px 0 40px rgba(0, 0, 0, 0.06);
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 50;
        }

        .card-glass {
            background: rgba(255, 255, 255, 0.52);
            backdrop-filter: blur(24px) saturate(160%);
            -webkit-backdrop-filter: blur(24px) saturate(160%);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.6);
            border-radius: 18px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card-glass:hover {
            background: rgba(255, 255, 255, 0.68);
            box-shadow: 0 16px 48px rgba(31, 38, 135, 0.14), inset 0 1px 0 rgba(255, 255, 255, 0.7);
            transform: translateY(-2px);
        }

        .field {
            background: rgba(255, 255, 255, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.55);
            color: #1a2233;
            backdrop-filter: blur(10px);
            transition: all 0.2s;
        }

        .field:focus {
            outline: none;
            border-color: #2f5fdb;
            box-shadow: 0 0 0 3px rgba(47, 95, 219, 0.18);
            background: rgba(255, 255, 255, 0.88);
        }

        .field::placeholder {
            color: #8991a0;
        }

        .eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10.5px;
            letter-spacing: 0.08em;
            font-weight: 500;
        }

        .tier-row {
            transition: background-color .15s ease;
        }

        .tier-row:hover {
            background-color: rgba(255, 255, 255, 0.45);
        }

        .tier-box {
            background: rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 14px;
            overflow: hidden;
        }

        /* ========== RESPONSIVE ========== */
        /* Mobile Sidebar Overlay - No heavy blur */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 40;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            pointer-events: none;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        @media (max-width: 991.98px) {
            .glass-sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                z-index: 50;
                transform: translateX(-100%);
                width: 300px !important;
            }

            .glass-sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0 !important;
            }
        }

        @media (max-width: 640px) {
            .nav-badges {
                display: none !important;
            }

            .nav-doc-btn span:not(.material-symbols-outlined) {
                display: none;
            }

            .nav-doc-btn {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
        }

        /* Floating panel position for desktop */
        /* Floating Lead Panel */
        #floatingLeadPanel {
            position: fixed;
            top: 64px;
            bottom: 0;
            left: 335px;
            /* desktop sidebar width */
            width: 300px;
            z-index: 40;
            display: flex;
            opacity: 0;
            visibility: hidden;
            transform: translateX(-14px);
            pointer-events: none;
            transition:
                opacity 0.28s ease,
                transform 0.28s cubic-bezier(0.22, 1, 0.36, 1),
                visibility 0.28s ease;
        }

        #floatingLeadPanel.open {
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
            pointer-events: auto;
        }

        #floatingLeadPanel .float-inner {
            height: calc(100% - 24px);
            margin: 12px 12px 12px 0;
            border-radius: 18px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
            border: 1px solid rgba(255, 255, 255, 0.55);
            box-shadow: 8px 12px 36px rgba(31, 38, 135, 0.12);
            transform: scale(0.98);
            transition: transform 0.28s cubic-bezier(0.22, 1, 0.36, 1);
        }

        #floatingLeadPanel.open .float-inner {
            transform: scale(1);
        }

        /* Mobile */
        @media (max-width: 991.98px) {
            #floatingLeadPanel {
                left: 300px;
                width: min(300px, calc(100vw - 310px));
            }
        }


        /* ========== CUSTOM DROPDOWN ========== */
        .custom-select {
            position: relative;
            width: 100%;
            font-family: inherit;
        }

        .custom-select-trigger {
            width: 100%;
            min-height: 40px;
            padding: 0 36px 0 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 500;
            color: #1a2233;
            cursor: pointer;
            transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
            user-select: none;
        }

        .custom-select-trigger:hover {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(0, 0, 0, 0.12);
        }

        .custom-select.open .custom-select-trigger,
        .custom-select-trigger:focus {
            outline: none;
            border-color: #a78bfa;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.14);
            background: #fff;
        }

        .custom-select-trigger .cs-label {
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #1a2233;
        }

        .custom-select-trigger .cs-label.is-placeholder {
            color: #8991a0;
            font-weight: 400;
        }

        .custom-select-trigger .cs-arrow {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: #8991a0;
            transition: transform 0.2s ease, color 0.15s;
            pointer-events: none;
        }

        .custom-select.open .cs-arrow {
            transform: translateY(-50%) rotate(180deg);
            color: #7c3aed;
        }

        .custom-select-options {
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            right: 0;
            z-index: 99999;
            max-height: 240px;
            overflow-y: auto;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            box-shadow: 0 12px 40px rgba(31, 38, 135, 0.16);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-6px) scale(0.98);
            transform-origin: top center;
            transition: opacity 0.18s ease, transform 0.18s ease, visibility 0.18s;
            padding: 6px;
            pointer-events: none;
        }

        /* Works both inside select AND when portaled to body */
        .custom-select.open .custom-select-options,
        .custom-select-options.cs-open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .custom-select-options::-webkit-scrollbar {
            width: 5px;
        }

        .custom-select-options::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 4px;
        }

        .custom-select-option {
            padding: 9px 12px;
            border-radius: 8px;
            font-size: 13.5px;
            color: #374151;
            cursor: pointer;
            transition: background 0.12s, color 0.12s;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .custom-select-option:hover {
            background: rgba(124, 58, 237, 0.08);
            color: #7c3aed;
        }

        .custom-select-option.selected {
            background: rgba(124, 58, 237, 0.12);
            color: #7c3aed;
            font-weight: 600;
        }

        .custom-select-option.selected::after {
            content: "✓";
            font-size: 12px;
            font-weight: 700;
        }

        .custom-select-option.disabled {
            opacity: 0.4;
            pointer-events: none;
        }

        /* Search inside dropdown (optional) */
        .custom-select-search {
            padding: 6px 6px 8px;
            position: sticky;
            top: 0;
            background: rgba(255, 255, 255, 0.95);
            z-index: 1;
        }

        .custom-select-search input {
            width: 100%;
            height: 34px;
            padding: 0 10px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            font-size: 13px;
            background: #fff;
            outline: none;
        }

        .custom-select-search input:focus {
            border-color: #a78bfa;
            box-shadow: 0 0 0 2px rgba(124, 58, 237, 0.12);
        }

        /* Size variants */
        .custom-select.sm .custom-select-trigger {
            min-height: 34px;
            font-size: 12.5px;
            border-radius: 8px;
            padding-left: 10px;
        }

        .custom-select.lg .custom-select-trigger {
            min-height: 46px;
            font-size: 14.5px;
            border-radius: 12px;
        }

        /* Allow dropdown to escape parent cards */
        .tier-box,
        .card-glass,
        .card,
        .sidebarAddLead,
        #sidebarAddLead {
            overflow: visible !important;
        }

        .custom-select-options {
            z-index: 9999 !important;
        }

        .custom-select.open {
            z-index: 50;
        }

        .custom-select-options {
            position: absolute;
            /* or fixed via JS above */
            top: calc(100% + 6px);
            left: 0;
            right: 0;
            z-index: 9999;
            /* keep your existing glass styles */
        }

        #sidebarAddLead .tier-box {
            overflow: visible !important;
        }

        .custom-select-options {
            z-index: 9999 !important;
        }

        /* ========== CUSTOM DATE PICKER (DOB) ========== */
        .custom-datepicker {
            position: relative;
            width: 100%;
            font-family: inherit;
        }

        .cdp-trigger {
            width: 100%;
            min-height: 40px;
            padding: 0 40px 0 12px;
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 500;
            color: #1a2233;
            cursor: pointer;
            transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
            user-select: none;
        }

        .cdp-trigger:hover {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(0, 0, 0, 0.12);
        }

        .custom-datepicker.open .cdp-trigger,
        .cdp-trigger:focus {
            outline: none;
            border-color: #a78bfa;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.14);
            background: #fff;
        }

        .cdp-trigger .cdp-label {
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .cdp-trigger .cdp-label.is-placeholder {
            color: #8991a0;
            font-weight: 400;
        }

        .cdp-trigger .cdp-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #8991a0;
            font-size: 18px;
            pointer-events: none;
        }

        .custom-datepicker.open .cdp-icon {
            color: #7c3aed;
        }

        /* Panel */
        .cdp-panel {
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            width: 280px;
            z-index: 99999;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 14px;
            box-shadow: 0 12px 40px rgba(31, 38, 135, 0.16);
            padding: 12px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-6px) scale(0.98);
            transform-origin: top left;
            transition: opacity 0.18s ease, transform 0.18s ease, visibility 0.18s;
            pointer-events: none;
        }

        .custom-datepicker.open .cdp-panel,
        .cdp-panel.cdp-open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .cdp-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            gap: 6px;
        }

        .cdp-header-title {
            font-size: 13.5px;
            font-weight: 600;
            color: #1a2233;
            flex: 1;
            text-align: center;
        }

        .cdp-nav-btn {
            width: 30px;
            height: 30px;
            border: none;
            border-radius: 8px;
            background: rgba(124, 58, 237, 0.08);
            color: #7c3aed;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s;
        }

        .cdp-nav-btn:hover {
            background: rgba(124, 58, 237, 0.16);
        }

        .cdp-nav-btn .material-symbols-outlined {
            font-size: 18px;
        }

        .cdp-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
            margin-bottom: 4px;
        }

        .cdp-weekdays span {
            text-align: center;
            font-size: 11px;
            font-weight: 600;
            color: #8991a0;
            padding: 4px 0;
        }

        .cdp-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
        }

        .cdp-day {
            aspect-ratio: 1;
            border: none;
            border-radius: 8px;
            background: transparent;
            font-size: 12.5px;
            font-weight: 500;
            color: #1a2233;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.12s, color 0.12s;
        }

        .cdp-day:hover:not(.empty):not(.disabled) {
            background: rgba(124, 58, 237, 0.1);
            color: #7c3aed;
        }

        .cdp-day.selected {
            background: #7c3aed;
            color: #fff;
            font-weight: 600;
        }

        .cdp-day.today:not(.selected) {
            border: 1.5px solid #7c3aed;
            color: #7c3aed;
        }

        .cdp-day.empty {
            cursor: default;
        }

        .cdp-day.disabled {
            opacity: 0.3;
            pointer-events: none;
        }

        .cdp-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            padding-top: 8px;
            border-top: 1px solid rgba(0, 0, 0, 0.06);
        }

        .cdp-footer button {
            border: none;
            background: none;
            font-size: 12.5px;
            font-weight: 600;
            color: #7c3aed;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .cdp-footer button:hover {
            background: rgba(124, 58, 237, 0.08);
        }

        .cdp-footer button.cdp-clear {
            color: #8991a0;
        }

        .cdp-selects {
            display: flex;
            gap: 6px;
            flex: 1;
            justify-content: center;
        }

        .cdp-month-select,
        .cdp-year-select {
            appearance: none;
            -webkit-appearance: none;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: rgba(124, 58, 237, 0.06) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%237c3aed' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E") no-repeat right 6px center;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 600;
            color: #1a2233;
            padding: 5px 22px 5px 8px;
            cursor: pointer;
            outline: none;
            max-width: 110px;
        }

        .cdp-year-select {
            max-width: 78px;
        }

        .cdp-month-select:focus,
        .cdp-year-select:focus {
            border-color: #a78bfa;
            box-shadow: 0 0 0 2px rgba(124, 58, 237, 0.12);
        }
    </style>
</head>

<body class="text-ink h-screen overflow-hidden flex flex-col relative">

    <!-- Background Orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- TOP NAV -->
    <nav class="relative z-50 flex justify-between items-center w-full px-4 sm:px-6 h-[64px] glass-nav flex-shrink-0 shadow-xl">
        <div class="flex items-center gap-3 sm:gap-5 min-w-0">
            <!-- Hamburger (Mobile) -->
            <button id="menuBtn" class="lg:hidden p-2 -ml-1 rounded-lg text-white/80 hover:bg-white/10 hover:text-white transition-colors">
                <span class="material-symbols-outlined text-[24px]">menu</span>
            </button>

            <div class="flex items-center gap-2.5 sm:gap-3 min-w-0">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg bg-white/15 flex items-center justify-center shadow-inner flex-shrink-0">
                    <span class="material-symbols-outlined text-white/90 text-[18px] sm:text-[19px]">workspaces</span>
                </div>
                <div class="flex flex-col leading-none min-w-0">
                    <span class="eyebrow text-white/45 hidden xs:block">LEAD · 25 AUG 2026</span>
                    <span class="font-display text-[16px] sm:text-[19px] font-semibold text-white mt-0.5 truncate">Yuktesh Jadhav</span>
                </div>
            </div>

            <div class="nav-badges hidden md:flex gap-2 ml-2 pl-5 border-l border-white/15">
                <span class="flex items-center gap-1.5 bg-white/12 text-white px-3 py-1.5 rounded-lg font-body text-[12.5px] font-medium backdrop-blur-sm whitespace-nowrap">
                    <span class="material-symbols-outlined text-[15px] text-emerald-300">check_circle</span>
                    Eligible · ₹5,000
                </span>
                <span class="flex items-center gap-1.5 bg-white/6 text-white/55 px-3 py-1.5 rounded-lg font-body text-[12.5px] whitespace-nowrap">
                    Incentive · ₹0
                </span>
            </div>
        </div>

        <div class="flex items-center gap-1 sm:gap-2 flex-shrink-0">
            <button class="nav-doc-btn flex items-center gap-2 bg-white/10 hover:bg-white/18 px-3 sm:px-4 py-2 rounded-lg text-white font-body text-[13px] font-medium transition-all">
                <span class="material-symbols-outlined text-[16px]">description</span>
                <span class="hidden sm:inline">University Document</span>
                <span class="material-symbols-outlined text-[16px] text-white/50 hidden sm:inline">expand_more</span>
            </button>
            <div class="flex items-center border-l border-white/15 ml-1 pl-1">
                <button class="p-2 hover:bg-white/12 rounded-lg transition-colors text-white/70 hover:text-white" title="Apps">
                    <span class="material-symbols-outlined text-[20px]">apps</span>
                </button>
                <button class="p-2 hover:bg-white/12 rounded-lg transition-colors text-white/70 hover:text-white" title="Logout">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                </button>
            </div>
        </div>
    </nav>

    <div class="relative z-10 flex flex-1 overflow-hidden">

        <!-- SIDEBAR -->
        <aside class="glass-sidebar w-[300px] lg:w-[330px] flex flex-col flex-shrink-0" id="sidebar">
            <div class="px-4 pt-4 pb-3 flex justify-between items-center border-b border-white/30">
                <span class="font-display text-[16px] font-semibold text-ink">Pipeline Overview</span>
                <div class="flex gap-0.5">
                    <button class="p-1.5 hover:bg-white/40 rounded-lg text-ink-faint hover:text-ink transition-colors">
                        <span class="material-symbols-outlined text-[17px]">refresh</span>
                    </button>
                    <button id="addLeadBtn" class="p-1.5 hover:bg-white/40 rounded-lg text-ink-faint hover:text-ink transition-colors" title="Add Lead">
                        <span class="material-symbols-outlined text-[17px]">add</span>
                    </button>
                    <!-- Close on mobile -->
                    <button id="closeSidebarBtn" class="lg:hidden p-1.5 hover:bg-white/40 rounded-lg text-ink-faint hover:text-ink transition-colors">
                        <span class="material-symbols-outlined text-[17px]">close</span>
                    </button>
                </div>
            </div>

            <div class="flex p-1.5 gap-1 bg-white/25 mx-3 mt-3 rounded-xl backdrop-blur-sm">
                <button id="tabDashboard"
                    class="flex-1 py-1.5 rounded-lg text-center font-body text-[12.5px] font-semibold text-white bg-navy shadow-md transition-all">
                    Dashboard
                </button>
                <button id="tabList"
                    class="flex-1 py-1.5 rounded-lg text-center font-body text-[12.5px] font-medium text-ink-muted hover:text-ink transition-all">
                    List
                </button>
            </div>

            <div id="sidebarDashboard" class="flex-1 overflow-y-auto custom-scrollbar px-3 pt-4 pb-4">
                <!-- NEEDS ACTION -->
                <div class="mb-5">
                    <div class="flex items-center gap-2 mb-2 px-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-critical shadow-[0_0_8px_#c22e2e]"></span>
                        <span class="eyebrow text-ink-faint">NEEDS ACTION</span>
                    </div>
                    <div class="tier-box">
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 bg-critical-soft/70 border-b border-white/25">
                            <span class="font-body text-[13px] font-medium text-ink">Overdue Call Back</span>
                            <span class="font-mono text-[15px] font-semibold text-critical">01</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 bg-warning-soft/70 border-b border-white/25">
                            <span class="font-body text-[13px] font-medium text-ink">Overdue Interested</span>
                            <span class="font-mono text-[15px] font-semibold text-warning">00</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 bg-warning-soft/70">
                            <span class="font-body text-[13px] font-medium text-ink">Re-Enquired</span>
                            <span class="font-mono text-[15px] font-semibold text-warning">01</span>
                        </div>
                    </div>
                </div>

                <!-- TODAY'S PIPELINE -->
                <div class="mb-5">
                    <div class="flex items-center gap-2 mb-2 px-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-accent shadow-[0_0_8px_#2f5fdb]"></span>
                        <span class="eyebrow text-ink-faint">TODAY'S PIPELINE</span>
                    </div>
                    <div class="tier-box">
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25">
                            <span class="font-body text-[13px] text-ink-muted">Prospect Today</span>
                            <span class="font-mono text-[15px] font-semibold text-ink">00</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25">
                            <span class="font-body text-[13px] text-ink-muted">Interested Today</span>
                            <span class="font-mono text-[15px] font-semibold text-ink">00</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25">
                            <span class="font-body text-[13px] text-ink-muted">Call Back Today</span>
                            <span class="font-mono text-[15px] font-semibold text-ink">00</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5">
                            <span class="font-body text-[13px] text-ink-muted">Overdue Prospect</span>
                            <span class="font-mono text-[15px] font-semibold text-ink">00</span>
                        </div>
                    </div>
                </div>

                <!-- FUNNEL PROGRESS -->
                <div>
                    <div class="flex items-center gap-2 mb-2 px-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-success shadow-[0_0_8px_#1f9d64]"></span>
                        <span class="eyebrow text-ink-faint">FUNNEL PROGRESS</span>
                    </div>
                    <div class="tier-box">
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25">
                            <span class="font-body text-[13px] text-ink-muted">New Opportunity</span>
                            <span class="font-mono text-[15px] font-semibold text-ink">00</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25">
                            <span class="font-body text-[13px] text-ink-muted">Cold Calling</span>
                            <span class="font-mono text-[15px] font-semibold text-ink">00</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25">
                            <span class="font-body text-[13px] text-ink-muted">Recycled</span>
                            <span class="font-mono text-[15px] font-semibold text-ink">00</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25">
                            <span class="font-body text-[13px] text-ink-muted">To Be Enrolled</span>
                            <span class="font-mono text-[15px] font-semibold text-ink">00</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25 bg-success-soft/60">
                            <span class="font-body text-[13px] font-medium text-ink">Admission Done</span>
                            <span class="font-mono text-[15px] font-semibold text-success">00</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25">
                            <span class="font-body text-[13px] text-ink-muted">Provisional</span>
                            <span class="font-mono text-[15px] font-semibold text-ink">00</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25">
                            <span class="font-body text-[13px] text-ink-muted">Eligible</span>
                            <span class="font-mono text-[15px] font-semibold text-ink">00</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5">
                            <span class="font-body text-[13px] text-ink-muted">Rejected</span>
                            <span class="font-mono text-[15px] font-semibold text-ink">00</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ==================== LIST VIEW ==================== -->
            <div id="sidebarList" class="flex-1 overflow-y-auto custom-scrollbar px-3 pt-4 pb-4" style="display:none;">

                <!-- Lead Item -->
                <div class="lead-list-item flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-white/40 cursor-pointer transition-colors border-b border-white/20">
                    <button class="call-btn w-9 h-9 rounded-full bg-success/15 text-success flex items-center justify-center flex-shrink-0 hover:bg-success/25 transition-colors" title="Call">
                        <span class="material-symbols-outlined text-[18px]">call</span>
                    </button>
                    <div class="min-w-0 flex-1">
                        <div class="font-body text-[13.5px] font-semibold text-ink truncate">Emma Thompson</div>
                        <div class="font-body text-[12px] text-ink-muted mt-0.5">98765 43210</div>
                    </div>
                </div>

                <div class="lead-list-item flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-white/40 cursor-pointer transition-colors border-b border-white/20">
                    <button class="call-btn w-9 h-9 rounded-full bg-success/15 text-success flex items-center justify-center flex-shrink-0 hover:bg-success/25 transition-colors" title="Call">
                        <span class="material-symbols-outlined text-[18px]">call</span>
                    </button>
                    <div class="min-w-0 flex-1">
                        <div class="font-body text-[13.5px] font-semibold text-ink truncate">Rahul Sharma</div>
                        <div class="font-body text-[12px] text-ink-muted mt-0.5">91234 56789</div>
                    </div>
                </div>

                <div class="lead-list-item flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-white/40 cursor-pointer transition-colors border-b border-white/20">
                    <button class="call-btn w-9 h-9 rounded-full bg-success/15 text-success flex items-center justify-center flex-shrink-0 hover:bg-success/25 transition-colors" title="Call">
                        <span class="material-symbols-outlined text-[18px]">call</span>
                    </button>
                    <div class="min-w-0 flex-1">
                        <div class="font-body text-[13.5px] font-semibold text-ink truncate">Priya Patel</div>
                        <div class="font-body text-[12px] text-ink-muted mt-0.5">99887 76655</div>
                    </div>
                </div>

                <div class="lead-list-item flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-white/40 cursor-pointer transition-colors border-b border-white/20">
                    <button class="call-btn w-9 h-9 rounded-full bg-success/15 text-success flex items-center justify-center flex-shrink-0 hover:bg-success/25 transition-colors" title="Call">
                        <span class="material-symbols-outlined text-[18px]">call</span>
                    </button>
                    <div class="min-w-0 flex-1">
                        <div class="font-body text-[13.5px] font-semibold text-ink truncate">David Kim</div>
                        <div class="font-body text-[12px] text-ink-muted mt-0.5">97654 32109</div>
                    </div>
                </div>

                <div class="lead-list-item flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-white/40 cursor-pointer transition-colors border-b border-white/20">
                    <button class="call-btn w-9 h-9 rounded-full bg-success/15 text-success flex items-center justify-center flex-shrink-0 hover:bg-success/25 transition-colors" title="Call">
                        <span class="material-symbols-outlined text-[18px]">call</span>
                    </button>
                    <div class="min-w-0 flex-1">
                        <div class="font-body text-[13.5px] font-semibold text-ink truncate">Sophia Martinez</div>
                        <div class="font-body text-[12px] text-ink-muted mt-0.5">96543 21098</div>
                    </div>
                </div>

                <!-- Empty state (optional) -->
                <!--
                    <div class="text-center py-10 text-ink-muted text-[13px]">
                        No leads found
                    </div>
                    -->
            </div>
            <div id="sidebarSummary" class="flex-1 overflow-y-auto custom-scrollbar px-3 pt-4 pb-4" style="display:none;">
                <div class="mb-3 px-1">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-navy"></span>
                        <span class="eyebrow text-ink-faint">ALL STATUS SUMMARY</span>
                    </div>

                    <div class="tier-box">
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25 hover:bg-white/40 cursor-pointer status-item"
                            data-status="New Opportunity"
                            data-count="12">
                            <span class="font-body text-[13px] text-ink">New Opportunity</span>
                            <span class="font-mono text-[14px] font-semibold text-ink">12</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25 hover:bg-white/40 cursor-pointer status-item"
                            data-status="Cold Calling"
                            data-count="12">
                            <span class="font-body text-[13px] text-ink">Cold Calling</span>
                            <span class="font-mono text-[14px] font-semibold text-ink">08</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25 hover:bg-white/40 cursor-pointer status-item"
                            data-status="Prospect"
                            data-count="12">
                            <span class="font-body text-[13px] text-ink">Prospect</span>
                            <span class="font-mono text-[14px] font-semibold text-ink">15</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25 hover:bg-white/40 cursor-pointer status-item"
                            data-status="Interested"
                            data-count="12">
                            <span class="font-body text-[13px] text-ink">Interested</span>
                            <span class="font-mono text-[14px] font-semibold text-ink">09</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25 hover:bg-white/40 cursor-pointer status-item"
                            data-status="Call Back"
                            data-count="12">
                            <span class="font-body text-[13px] text-ink">Call Back</span>
                            <span class="font-mono text-[14px] font-semibold text-ink">06</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25 hover:bg-white/40 cursor-pointer status-item"
                            data-status="Re-Enquired"
                            data-count="12">
                            <span class="font-body text-[13px] text-ink">Re-Enquired</span>
                            <span class="font-mono text-[14px] font-semibold text-warning">03</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25 hover:bg-white/40 cursor-pointer status-item"
                            data-status="Overdue Call Back"
                            data-count="12">
                            <span class="font-body text-[13px] text-ink">Overdue Call Back</span>
                            <span class="font-mono text-[14px] font-semibold text-critical">01</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25 hover:bg-white/40 cursor-pointer status-item"
                            data-status="Admission Done"
                            data-count="12">
                            <span class="font-body text-[13px] text-ink">Admission Done</span>
                            <span class="font-mono text-[14px] font-semibold text-success">11</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25 hover:bg-white/40 cursor-pointer status-item"
                            data-status="Eligible"
                            data-count="12">
                            <span class="font-body text-[13px] text-ink">Eligible</span>
                            <span class="font-mono text-[14px] font-semibold text-ink">14</span>
                        </div>
                        <div class="tier-row flex items-center justify-between px-3 py-2.5 border-b border-white/25 hover:bg-white/40 cursor-pointer status-item"
                            data-status="Rejected"
                            data-count="12">
                            <span class="font-body text-[13px] text-ink">Rejected</span>
                            <span class="font-mono text-[14px] font-semibold text-critical">03</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== ADD LEAD FORM ==================== -->
            <div id="sidebarAddLead" class="flex-1 overflow-y-auto custom-scrollbar px-3 pt-4 pb-4" style="display:none;">
                <div class="mb-3 px-1">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-accent"></span>
                        <span class="eyebrow text-ink-faint">ADD NEW LEAD</span>
                    </div>

                    <div class="tier-box p-3 space-y-3">
                        <div>
                            <label class="block text-[11.5px] font-medium text-ink-muted mb-1">Name</label>
                            <input id="addLeadName" type="text" placeholder="Full name"
                                class="field w-full p-2.5 text-[13px] rounded-lg">
                        </div>

                        <div>
                            <label class="block text-[11.5px] font-medium text-ink-muted mb-1">Mobile</label>
                            <input id="addLeadMobile" type="text" placeholder="Mobile number"
                                class="field w-full p-2.5 text-[13px] rounded-lg">
                        </div>

                        <div>
                            <label class="block text-[11.5px] font-medium text-ink-muted mb-1">Email</label>
                            <input id="addLeadEmail" type="email" placeholder="Email address"
                                class="field w-full p-2.5 text-[13px] rounded-lg">
                        </div>

                        <div>
                            <label class="block text-[11.5px] font-medium text-ink-muted mb-1">Source</label>
                            <div class="custom-select" data-name="source">
                                <div class="custom-select-trigger" tabindex="0">
                                    <span class="cs-label is-placeholder">Select source</span>
                                    <svg class="cs-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M6 9l6 6 6-6" />
                                    </svg>
                                </div>
                                <div class="custom-select-options">
                                    <div class="custom-select-option" data-value="">Select source</div>
                                    <div class="custom-select-option" data-value="Website">Website</div>
                                    <div class="custom-select-option" data-value="Referral">Referral</div>
                                    <div class="custom-select-option" data-value="LinkedIn">LinkedIn</div>
                                    <div class="custom-select-option" data-value="Cold Call">Cold Call</div>
                                </div>
                                <!-- real value for forms -->
                                <input type="hidden" name="source" value="">
                            </div>
                        </div>

                        <div class="flex gap-2 pt-1">
                            <button id="saveAddLeadBtn"
                                class="flex-1 bg-accent text-white py-2 rounded-lg text-[13px] font-semibold hover:bg-accent/90 transition-colors">
                                Save Lead
                            </button>
                            <button id="cancelAddLeadBtn"
                                class="px-3 py-2 rounded-lg text-[13px] font-medium text-ink-muted bg-white/40 border border-white/50 hover:bg-white/60 transition-colors">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer button stays at bottom -->
            <div id="summaryReportBtn"
                class="border-t border-white/30 p-4 flex justify-between items-center cursor-pointer hover:bg-white/25 transition-colors">
                <span class="font-body text-[13px] font-semibold text-ink">Summary Report</span>
                <span class="material-symbols-outlined text-ink-faint text-[18px]" id="summaryIcon">chevron_right</span>
            </div>
        </aside>
        <!-- FLOATING LEAD LIST (right side of sidebar) -->
        <div id="floatingLeadPanel">
            <div class="float-inner">
                <!-- Header -->
                <div class="px-4 py-3 border-b border-white/40 flex items-center justify-between flex-shrink-0">
                    <div class="min-w-0">
                        <div class="font-display text-[14px] font-semibold text-ink truncate" id="floatLeadTitle">Leads</div>
                        <div class="text-[11.5px] text-ink-muted" id="floatLeadCount">0 leads</div>
                    </div>
                    <button id="closeFloatLeadBtn"
                        class="p-1.5 rounded-lg hover:bg-white/50 text-ink-faint hover:text-ink transition-colors">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>
                </div>

                <!-- Search Bar -->
                <div class="px-3 py-2.5 border-b border-white/30 flex-shrink-0">
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-2.5 top-1/2 -translate-y-1/2 text-ink-faint text-[18px]">
                            search
                        </span>
                        <input
                            id="floatLeadSearch"
                            type="text"
                            placeholder="Search name or mobile..."
                            class="w-full h-9 pl-9 pr-3 rounded-lg text-[13px] text-ink outline-none
                            bg-white/50 border border-white/50
                            focus:bg-white/80 focus:border-accent/40 focus:ring-2 focus:ring-accent/15
                            placeholder:text-ink-faint transition-all" />
                    </div>
                </div>

                <!-- Lead list -->
                <div id="floatLeadBody" class="flex-1 overflow-y-auto custom-scrollbar"></div>
            </div>
        </div>
        <!-- MAIN -->
        <main class="main-content flex-1 overflow-y-auto custom-scrollbar p-3 sm:p-5">
            <div class="max-w-[1440px] mx-auto">
                <!-- Responsive grid: 1 col mobile → 2 col tablet → 3 col desktop -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 items-start">

                    <!-- COLUMN 1 : Personal & Contact -->
                    <div class="flex flex-col gap-4 sm:gap-5 md:col-span-2 lg:col-span-1">
                        <div class="card-glass">
                            <div class="px-4 sm:px-5 py-4 border-b border-white/30 flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-accent-soft flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-accent text-[16px]">person</span>
                                </span>
                                <h2 class="font-display text-[15px] sm:text-[16px] font-semibold text-ink">Personal &amp; Contact</h2>
                            </div>
                            <div class="p-4 sm:p-5 flex flex-col gap-4">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Name</label>
                                        <input class="field p-2.5 text-[13.5px] rounded-lg" type="text" />
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Middle Name</label>
                                        <input class="field p-2.5 text-[13.5px] rounded-lg" type="text" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Last Name</label>
                                        <input class="field p-2.5 text-[13.5px] rounded-lg" type="text" />
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Gender</label>
                                        <div class="custom-select" data-name="gender">
                                            <div class="custom-select-trigger" tabindex="0">
                                                <span class="cs-label is-placeholder">Select Gender</span>
                                                <svg class="cs-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M6 9l6 6 6-6" />
                                                </svg>
                                            </div>
                                            <div class="custom-select-options">
                                                <div class="custom-select-option" data-value="">Select Gender</div>
                                                <div class="custom-select-option" data-value="male">Male</div>
                                                <div class="custom-select-option" data-value="female">Female</div>
                                                <div class="custom-select-option" data-value="other">Other</div>
                                            </div>
                                            <!-- real value for forms -->
                                            <input type="hidden" name="gender" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-accent-soft/50 p-3.5 rounded-xl border border-accent/15">
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Contact 1</label>
                                        <input class="field p-2.5 text-[13.5px] rounded-lg" type="text" />
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Contact 2</label>
                                        <input class="field p-2.5 text-[13.5px] rounded-lg" type="text" />
                                    </div>
                                </div>

                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Email (Verified)</label>
                                    <input class="field p-2.5 text-[13.5px] rounded-lg bg-white/40 text-ink-faint" readonly type="email" value="Email" />
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Email</label>
                                        <input class="field p-2.5 text-[13.5px] rounded-lg" type="email" />
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Date of Birth</label>
                                        <div class="custom-datepicker" data-name="dob">
                                            <div class="cdp-trigger" tabindex="0">
                                                <span class="cdp-label is-placeholder">Select date of birth</span>
                                                <span class="material-symbols-outlined cdp-icon">calendar_month</span>
                                            </div>
                                            <div class="cdp-panel">
                                                <div class="cdp-header">
                                                    <button type="button" class="cdp-nav-btn cdp-prev" title="Previous month">
                                                        <span class="material-symbols-outlined">chevron_left</span>
                                                    </button>

                                                    <div class="cdp-selects">
                                                        <select class="cdp-month-select"></select>
                                                        <select class="cdp-year-select"></select>
                                                    </div>

                                                    <button type="button" class="cdp-nav-btn cdp-next" title="Next month">
                                                        <span class="material-symbols-outlined">chevron_right</span>
                                                    </button>
                                                </div>

                                                <div class="cdp-weekdays">
                                                    <span>Su</span><span>Mo</span><span>Tu</span><span>We</span>
                                                    <span>Th</span><span>Fr</span><span>Sa</span>
                                                </div>
                                                <div class="cdp-days"></div>
                                                <div class="cdp-footer">
                                                    <button type="button" class="cdp-clear">Clear</button>
                                                    <button type="button" class="cdp-today">Today</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="dob" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Country</label>
                                        <select class="field p-2.5 text-[13.5px] rounded-lg">
                                            <option>Choose...</option>
                                        </select>
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">State</label>
                                        <select class="field p-2.5 text-[13.5px] rounded-lg">
                                            <option>Choose...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">City</label>
                                        <select class="field p-2.5 text-[13.5px] rounded-lg">
                                            <option>Choose...</option>
                                        </select>
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Pin Code</label>
                                        <select class="field p-2.5 text-[13.5px] rounded-lg">
                                            <option>Choose...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Address 1</label>
                                    <input class="field p-2.5 text-[13.5px] rounded-lg" type="text" />
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Address 2</label>
                                    <input class="field p-2.5 text-[13.5px] rounded-lg" type="text" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- COLUMN 2 -->
                    <div class="flex flex-col gap-4 sm:gap-5">
                        <div class="card-glass">
                            <div class="px-4 sm:px-5 py-4 border-b border-white/30 flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-accent-soft flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-accent text-[16px]">school</span>
                                </span>
                                <h2 class="font-display text-[15px] sm:text-[16px] font-semibold text-ink">Education &amp; Work</h2>
                            </div>
                            <div class="p-4 sm:p-5 flex flex-col gap-4">
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Qualification</label>
                                    <select class="field p-2.5 text-[13.5px] rounded-lg w-full">
                                        <option>Select</option>
                                    </select>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Years of Experience</label>
                                        <select class="field p-2.5 text-[13.5px] rounded-lg">
                                            <option>Select</option>
                                        </select>
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Months of Experience</label>
                                        <select class="field p-2.5 text-[13.5px] rounded-lg">
                                            <option>Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-glass">
                            <div class="px-4 sm:px-5 py-4 border-b border-white/30 flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-accent-soft flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-accent text-[16px]">business_center</span>
                                </span>
                                <h2 class="font-display text-[15px] sm:text-[16px] font-semibold text-ink">Opportunity</h2>
                            </div>
                            <div class="p-4 sm:p-5 flex flex-col gap-4">
                                <div class="flex flex-col gap-1.5 bg-accent-soft/50 p-3.5 rounded-xl border border-accent/15">
                                    <label class="font-body text-[12px] font-semibold text-accent">Source — Primary</label>
                                    <select class="field p-2.5 text-[13.5px] rounded-lg">
                                        <option>D.Y.Patil</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">University</label>
                                    <select class="field p-2.5 text-[13.5px] rounded-lg">
                                        <option>Select</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Admission Type</label>
                                    <select class="field p-2.5 text-[13.5px] rounded-lg">
                                        <option>Select</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Course</label>
                                    <select class="field p-2.5 text-[13.5px] rounded-lg">
                                        <option>Select</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Specialization</label>
                                    <select class="field p-2.5 text-[13.5px] rounded-lg">
                                        <option>Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-glass">
                            <div class="px-4 sm:px-5 py-4 border-b border-white/30 flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-accent-soft flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-accent text-[16px]">flight_takeoff</span>
                                </span>
                                <h2 class="font-display text-[15px] sm:text-[16px] font-semibold text-ink">Origin</h2>
                            </div>
                            <div class="p-4 sm:p-5 flex flex-col gap-4">
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Source</label>
                                    <select class="field p-2.5 text-[13.5px] rounded-lg">
                                        <option>Select</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Media</label>
                                    <select class="field p-2.5 text-[13.5px] rounded-lg">
                                        <option>Select</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Campaign</label>
                                    <select class="field p-2.5 text-[13.5px] rounded-lg">
                                        <option>Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- COLUMN 3 -->
                    <div class="flex flex-col gap-4 sm:gap-5 md:col-span-2 lg:col-span-1">
                        <div class="card-glass">
                            <div class="px-4 sm:px-5 py-4 border-b border-white/30 flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-accent-soft flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-accent text-[16px]">call_log</span>
                                </span>
                                <h2 class="font-display text-[15px] sm:text-[16px] font-semibold text-ink">Action &amp; Disposition</h2>
                            </div>
                            <div class="p-4 sm:p-5 flex flex-col gap-4">
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Lead Date</label>
                                    <input class="field p-2.5 text-[13.5px] rounded-lg bg-white/40 text-ink-faint" readonly type="text" />
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Status</label>
                                    <select class="field p-2.5 text-[13.5px] rounded-lg">
                                        <option>Prospect</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Status Details</label>
                                    <select class="field p-2.5 text-[13.5px] rounded-lg">
                                        <option>Prospect</option>
                                    </select>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Date</label>
                                        <div class="field flex items-center rounded-lg px-2.5">
                                            <input class="bg-transparent border-0 focus:ring-0 p-2 text-[13.5px] w-full text-ink placeholder:text-ink-faint" placeholder="mm/dd/yyyy" type="text" />
                                            <span class="material-symbols-outlined text-ink-faint text-[16px]">calendar_today</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Time</label>
                                        <div class="field flex items-center rounded-lg px-2.5">
                                            <input class="bg-transparent border-0 focus:ring-0 p-2 text-[13.5px] w-full text-ink placeholder:text-ink-faint" placeholder="--:--" type="text" />
                                            <span class="material-symbols-outlined text-ink-faint text-[16px]">schedule</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Remark</label>
                                    <input class="field p-2.5 text-[13.5px] rounded-lg" type="text" />
                                </div>
                                <div class="flex flex-col sm:flex-row gap-3 mt-1">
                                    <button class="flex-1 bg-accent text-white px-6 py-2.5 rounded-lg font-body text-[14px] font-semibold hover:bg-accent/90 transition-colors shadow-md flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-[17px]">save</span>
                                        Update
                                    </button>
                                    <button class="bg-white/50 border border-white/50 text-ink px-4 py-2.5 rounded-lg hover:bg-white/70 transition-colors flex items-center justify-center" title="Send Email">
                                        <span class="material-symbols-outlined text-[18px] text-accent">mail</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-glass flex flex-col flex-1 min-h-[220px] sm:min-h-[260px]">
                            <div class="px-4 sm:px-5 py-4 border-b border-white/30 flex justify-between items-center">
                                <h2 class="font-display text-[15px] sm:text-[16px] font-semibold text-ink flex items-center gap-2.5">
                                    <span class="w-7 h-7 rounded-lg bg-white/40 flex items-center justify-center flex-shrink-0">
                                        <span class="material-symbols-outlined text-ink-muted text-[16px]">history</span>
                                    </span>
                                    History Log
                                </h2>
                                <button class="p-1.5 hover:bg-white/40 rounded-lg text-ink-faint hover:text-ink transition-colors">
                                    <span class="material-symbols-outlined text-[17px]">open_in_new</span>
                                </button>
                            </div>
                            <div class="p-4 flex-1">
                                <textarea class="field w-full h-full min-h-[160px] sm:min-h-[190px] rounded-lg resize-none p-3 font-mono text-[12px] leading-relaxed bg-white/30" placeholder="History records will appear here..." readonly></textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <!-- Floating Help -->
    <button class="fixed bottom-5 right-5 sm:bottom-6 sm:right-6 z-50 bg-navy/85 backdrop-blur-xl text-white p-3.5 rounded-full flex items-center justify-center shadow-2xl transition-all hover:scale-110 border border-white/15">
        <span class="material-symbols-outlined text-[22px]">support_agent</span>
    </button>

    <script>
        (function() {
            // ===================== MOBILE SIDEBAR =====================
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const menuBtn = document.getElementById('menuBtn');
            const closeBtn = document.getElementById('closeSidebarBtn');

            function openSidebar() {
                sidebar?.classList.add('open');
                overlay?.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar?.classList.remove('open');
                overlay?.classList.remove('active');
                document.body.style.overflow = '';
            }

            menuBtn?.addEventListener('click', openSidebar);
            closeBtn?.addEventListener('click', closeSidebar);
            overlay?.addEventListener('click', closeSidebar);

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 992) closeSidebar();
            });

            // ===================== SIDEBAR PANELS =====================
            const tabDashboard = document.getElementById('tabDashboard');
            const tabList = document.getElementById('tabList');
            const sidebarDashboard = document.getElementById('sidebarDashboard');
            const sidebarList = document.getElementById('sidebarList');
            const sidebarSummary = document.getElementById('sidebarSummary');
            const sidebarAddLead = document.getElementById('sidebarAddLead');
            const summaryBtn = document.getElementById('summaryReportBtn');
            const summaryIcon = document.getElementById('summaryIcon');
            const addLeadBtn = document.getElementById('addLeadBtn');
            const cancelAddLeadBtn = document.getElementById('cancelAddLeadBtn');
            const saveAddLeadBtn = document.getElementById('saveAddLeadBtn');

            function hideAllPanels() {
                [sidebarDashboard, sidebarList, sidebarSummary, sidebarAddLead].forEach(el => {
                    if (el) el.style.display = 'none';
                });
            }

            function setTabActive(active) {
                if (tabDashboard) {
                    tabDashboard.className = 'flex-1 py-1.5 rounded-lg text-center font-body text-[12.5px] font-medium text-ink-muted hover:text-ink transition-all';
                }
                if (tabList) {
                    tabList.className = 'flex-1 py-1.5 rounded-lg text-center font-body text-[12.5px] font-medium text-ink-muted hover:text-ink transition-all';
                }
                summaryBtn?.classList.remove('bg-navy/10');
                if (summaryIcon) summaryIcon.textContent = 'chevron_right';

                if (active === 'dashboard' && tabDashboard) {
                    tabDashboard.className = 'flex-1 py-1.5 rounded-lg text-center font-body text-[12.5px] font-semibold text-white bg-navy shadow-md transition-all';
                }
                if (active === 'list' && tabList) {
                    tabList.className = 'flex-1 py-1.5 rounded-lg text-center font-body text-[12.5px] font-semibold text-white bg-navy shadow-md transition-all';
                }
                if (active === 'summary') {
                    summaryBtn?.classList.add('bg-navy/10');
                    if (summaryIcon) summaryIcon.textContent = 'expand_less';
                }
            }

            function showDashboard() {
                hideAllPanels();
                if (sidebarDashboard) sidebarDashboard.style.display = 'block';
                setTabActive('dashboard');
            }

            function showList() {
                hideAllPanels();
                if (sidebarList) sidebarList.style.display = 'block';
                setTabActive('list');
            }

            function showSummary() {
                hideAllPanels();
                if (sidebarSummary) sidebarSummary.style.display = 'block';
                setTabActive('summary');
            }

            function showAddLead() {
                hideAllPanels();
                setTabActive(null);
                if (sidebarAddLead) sidebarAddLead.style.display = 'block';

                const name = document.getElementById('addLeadName');
                const mobile = document.getElementById('addLeadMobile');
                const email = document.getElementById('addLeadEmail');
                const source = document.getElementById('addLeadSource');
                if (name) name.value = '';
                if (mobile) mobile.value = '';
                if (email) email.value = '';
                if (source) source.value = '';
            }

            tabDashboard?.addEventListener('click', showDashboard);
            tabList?.addEventListener('click', showList);
            summaryBtn?.addEventListener('click', showSummary);
            addLeadBtn?.addEventListener('click', showAddLead);
            cancelAddLeadBtn?.addEventListener('click', showDashboard);

            saveAddLeadBtn?.addEventListener('click', function() {
                const name = document.getElementById('addLeadName')?.value.trim() || '';
                const mobile = document.getElementById('addLeadMobile')?.value.trim() || '';
                const email = document.getElementById('addLeadEmail')?.value.trim() || '';
                const source = document.getElementById('addLeadSource')?.value || '';

                if (!name || !mobile) {
                    alert('Name and Mobile are required');
                    return;
                }

                // TODO: send to Laravel via fetch/axios
                console.log('New Lead:', {
                    name,
                    mobile,
                    email,
                    source
                });

                showDashboard();
            });

            // Default view
            showDashboard();

            // ===================== FLOATING LEAD PANEL =====================
            const leadsByStatus = {
                'New Opportunity': [{
                        id: 1,
                        name: 'Emma Thompson',
                        mobile: '98765 43210'
                    },
                    {
                        id: 2,
                        name: 'Rahul Sharma',
                        mobile: '91234 56789'
                    },
                    {
                        id: 3,
                        name: 'Priya Patel',
                        mobile: '99887 76655'
                    }
                ],
                'Cold Calling': [{
                        id: 4,
                        name: 'David Kim',
                        mobile: '97654 32109'
                    },
                    {
                        id: 5,
                        name: 'Sophia Martinez',
                        mobile: '96543 21098'
                    }
                ],
                'Prospect': [{
                    id: 6,
                    name: 'Amit Verma',
                    mobile: '98765 11111'
                }],
                'Interested': [{
                        id: 7,
                        name: 'Neha Singh',
                        mobile: '98765 22222'
                    },
                    {
                        id: 8,
                        name: 'Karan Mehta',
                        mobile: '98765 33333'
                    }
                ],
                'Call Back': [{
                    id: 9,
                    name: 'Anita Desai',
                    mobile: '98765 44444'
                }],
                'Re-Enquired': [{
                    id: 10,
                    name: 'Suresh Pillai',
                    mobile: '98765 77777'
                }],
                'Overdue Call Back': [{
                    id: 11,
                    name: 'Meera Joshi',
                    mobile: '98765 88888'
                }],
                'Admission Done': [{
                    id: 12,
                    name: 'Rohan Kapoor',
                    mobile: '98765 55555'
                }],
                'Eligible': [{
                    id: 13,
                    name: 'Kavita Rao',
                    mobile: '98765 99999'
                }],
                'Rejected': [{
                    id: 14,
                    name: 'Vikas Nair',
                    mobile: '98765 66666'
                }]
            };

            let currentLeads = [];

            const panel = document.getElementById('floatingLeadPanel');
            const floatTitle = document.getElementById('floatLeadTitle');
            const floatCount = document.getElementById('floatLeadCount');
            const floatBody = document.getElementById('floatLeadBody');
            const closeFloatBtn = document.getElementById('closeFloatLeadBtn');
            const searchInput = document.getElementById('floatLeadSearch');

            function renderLeads(leads) {
                if (!floatBody || !floatCount) return;

                floatCount.textContent = leads.length + (leads.length === 1 ? ' lead' : ' leads');

                if (!leads.length) {
                    floatBody.innerHTML = `<div class="px-4 py-10 text-center text-[13px] text-ink-muted">No leads found</div>`;
                    return;
                }

                floatBody.innerHTML = leads.map(lead => `
            <div class="flex items-center gap-3 px-3 py-3 border-b border-white/25 hover:bg-white/40 cursor-pointer transition-colors" data-lead-id="${lead.id}">
                <button class="w-9 h-9 rounded-full bg-success/15 text-success flex items-center justify-center flex-shrink-0 hover:bg-success/25"
                        onclick="event.stopPropagation(); location.href='tel:${lead.mobile.replace(/\s/g, '')}'">
                    <span class="material-symbols-outlined text-[18px]">call</span>
                </button>
                <div class="min-w-0 flex-1">
                    <div class="text-[13.5px] font-semibold text-ink truncate">${lead.name}</div>
                    <div class="text-[12px] text-ink-muted mt-0.5">${lead.mobile}</div>
                </div>
            </div>
        `).join('');
            }

            function openFloatingLeads(status) {
                if (!panel) return;
                currentLeads = leadsByStatus[status] || [];
                if (floatTitle) floatTitle.textContent = status;
                if (searchInput) searchInput.value = '';
                renderLeads(currentLeads);
                panel.classList.add('open');
            }

            function closeFloatingLeads() {
                panel?.classList.remove('open');
                if (searchInput) searchInput.value = '';
            }

            document.querySelectorAll('.status-item').forEach(el => {
                el.addEventListener('click', function() {
                    openFloatingLeads(this.getAttribute('data-status'));
                });
            });

            closeFloatBtn?.addEventListener('click', closeFloatingLeads);

            searchInput?.addEventListener('input', function() {
                const q = this.value.trim().toLowerCase();
                if (!q) {
                    renderLeads(currentLeads);
                    return;
                }
                const filtered = currentLeads.filter(lead =>
                    lead.name.toLowerCase().includes(q) ||
                    lead.mobile.replace(/\s/g, '').includes(q.replace(/\s/g, ''))
                );
                renderLeads(filtered);
            });
        })();
    </script>
    <script>
        (function() {
            function getMenu(root) {
                // Prefer stored reference after portal
                if (root._csMenu) return root._csMenu;
                return root.querySelector('.custom-select-options');
            }

            function closeAll(except) {
                document.querySelectorAll('.custom-select.open').forEach(function(el) {
                    if (el === except) return;

                    var menu = getMenu(el);
                    if (menu) {
                        menu.classList.remove('cs-open');
                        // Move menu back into select
                        if (menu.dataset.portaled === '1') {
                            el.appendChild(menu);
                            menu.dataset.portaled = '0';
                            menu.style.position = '';
                            menu.style.left = '';
                            menu.style.top = '';
                            menu.style.width = '';
                            menu.style.right = '';
                            menu.style.zIndex = '';
                        }
                    }
                    el.classList.remove('open');
                });
            }

            function placeMenu(root) {
                var triggerEl = root.querySelector('.custom-select-trigger');
                var menu = getMenu(root);
                if (!triggerEl || !menu) return;

                // Portal to body (avoids sidebar transform / overflow clipping)
                if (menu.dataset.portaled !== '1') {
                    document.body.appendChild(menu);
                    menu.dataset.portaled = '1';
                    root._csMenu = menu;
                }

                var rect = triggerEl.getBoundingClientRect();

                // Make visible first so height is measurable
                menu.classList.add('cs-open');
                menu.style.position = 'fixed';
                menu.style.left = rect.left + 'px';
                menu.style.width = rect.width + 'px';
                menu.style.right = 'auto';
                menu.style.zIndex = '99999';

                var menuHeight = menu.offsetHeight || 200;
                var spaceBelow = window.innerHeight - rect.bottom;
                var openUp = spaceBelow < menuHeight + 12;

                if (openUp) {
                    menu.style.top = Math.max(8, rect.top - menuHeight - 6) + 'px';
                } else {
                    menu.style.top = (rect.bottom + 6) + 'px';
                }
            }

            function initCustomSelect(root) {
                var triggerEl = root.querySelector('.custom-select-trigger');
                var label = root.querySelector('.cs-label');
                var menu = root.querySelector('.custom-select-options');
                var hidden = root.querySelector('input[type="hidden"]');
                var search = root.querySelector('.custom-select-search input');

                if (!triggerEl || !label || !menu) return;

                root._csMenu = menu;

                // Preselect
                var selected = menu.querySelector('.custom-select-option.selected');
                if (selected) {
                    label.textContent = selected.textContent.trim();
                    label.classList.remove('is-placeholder');
                    if (hidden) hidden.value = selected.getAttribute('data-value') || '';
                }

                triggerEl.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var isOpen = root.classList.contains('open');
                    closeAll();

                    if (!isOpen) {
                        root.classList.add('open');
                        placeMenu(root);

                        if (search) {
                            search.value = '';
                            filterOptions('');
                            setTimeout(function() {
                                search.focus();
                            }, 40);
                        }
                    }
                });

                // Delegation on menu (works after portal to body)
                menu.addEventListener('click', function(e) {
                    var opt = e.target.closest('.custom-select-option');
                    if (!opt || !menu.contains(opt)) return;

                    e.preventDefault();
                    e.stopPropagation();

                    menu.querySelectorAll('.custom-select-option').forEach(function(o) {
                        o.classList.remove('selected');
                    });
                    opt.classList.add('selected');

                    var value = opt.getAttribute('data-value') || '';
                    var text = opt.textContent.trim();

                    label.textContent = text || 'Select';
                    label.classList.toggle('is-placeholder', !value);

                    if (hidden) {
                        hidden.value = value;
                        hidden.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));
                    }

                    closeAll();

                    root.dispatchEvent(new CustomEvent('cs:change', {
                        detail: {
                            value: value,
                            text: text
                        },
                        bubbles: true
                    }));
                });

                function filterOptions(q) {
                    var term = (q || '').toLowerCase();
                    menu.querySelectorAll('.custom-select-option').forEach(function(opt) {
                        var match = !term || opt.textContent.toLowerCase().includes(term);
                        opt.style.display = match ? '' : 'none';
                    });
                }

                if (search) {
                    search.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                    search.addEventListener('input', function() {
                        filterOptions(search.value.trim());
                    });
                }
            }

            function initAll() {
                document.querySelectorAll('.custom-select').forEach(initCustomSelect);
            }

            document.addEventListener('click', function() {
                closeAll();
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeAll();
            });

            window.addEventListener('scroll', function() {
                document.querySelectorAll('.custom-select.open').forEach(placeMenu);
            }, true);

            window.addEventListener('resize', function() {
                document.querySelectorAll('.custom-select.open').forEach(placeMenu);
            });

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initAll);
            } else {
                initAll();
            }

            window.initCustomSelects = initAll;
        })();
    </script>

    <script>
        (function() {
            var MONTHS = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];

            function pad(n) {
                return n < 10 ? '0' + n : '' + n;
            }

            function formatDisplay(y, m, d) {
                return pad(d) + ' / ' + pad(m + 1) + ' / ' + y;
            }

            function formatValue(y, m, d) {
                return y + '-' + pad(m + 1) + '-' + pad(d);
            }

            function closeAll(except) {
                document.querySelectorAll('.custom-datepicker.open').forEach(function(el) {
                    if (el === except) return;
                    var panel = el._cdpPanel || el.querySelector('.cdp-panel');
                    if (panel) {
                        panel.classList.remove('cdp-open');
                        if (panel.dataset.portaled === '1') {
                            el.appendChild(panel);
                            panel.dataset.portaled = '0';
                            panel.style.position = '';
                            panel.style.left = '';
                            panel.style.top = '';
                            panel.style.width = '';
                            panel.style.zIndex = '';
                        }
                    }
                    el.classList.remove('open');
                });
            }

            function placePanel(root) {
                var trigger = root.querySelector('.cdp-trigger');
                var panel = root._cdpPanel || root.querySelector('.cdp-panel');
                if (!trigger || !panel) return;

                if (panel.dataset.portaled !== '1') {
                    document.body.appendChild(panel);
                    panel.dataset.portaled = '1';
                    root._cdpPanel = panel;
                }

                panel.classList.add('cdp-open');
                panel.style.position = 'fixed';
                panel.style.zIndex = '99999';
                panel.style.width = '300px';

                var rect = trigger.getBoundingClientRect();
                var h = panel.offsetHeight || 340;
                var openUp = (window.innerHeight - rect.bottom) < h + 12;

                panel.style.left = Math.min(rect.left, window.innerWidth - 310) + 'px';
                panel.style.top = openUp ?
                    Math.max(8, rect.top - h - 6) + 'px' :
                    (rect.bottom + 6) + 'px';
            }

            function initDatepicker(root) {
                var trigger = root.querySelector('.cdp-trigger');
                var label = root.querySelector('.cdp-label');
                var panel = root.querySelector('.cdp-panel');
                var daysEl = panel.querySelector('.cdp-days');
                var hidden = root.querySelector('input[type="hidden"]');
                var prevBtn = panel.querySelector('.cdp-prev');
                var nextBtn = panel.querySelector('.cdp-next');
                var clearBtn = panel.querySelector('.cdp-clear');
                var todayBtn = panel.querySelector('.cdp-today');
                var monthSelect = panel.querySelector('.cdp-month-select');
                var yearSelect = panel.querySelector('.cdp-year-select');

                if (!trigger || !panel || !daysEl || !monthSelect || !yearSelect) return;

                root._cdpPanel = panel;

                var now = new Date();
                var viewYear = now.getFullYear();
                var viewMonth = now.getMonth();
                var selected = null;

                var maxDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
                var minYear = 1950;
                var maxYear = now.getFullYear();

                // Fill month select
                monthSelect.innerHTML = MONTHS.map(function(name, i) {
                    return '<option value="' + i + '">' + name + '</option>';
                }).join('');

                // Fill year select (newest first)
                var yearOptions = [];
                for (var y = maxYear; y >= minYear; y--) {
                    yearOptions.push('<option value="' + y + '">' + y + '</option>');
                }
                yearSelect.innerHTML = yearOptions.join('');

                // Restore value
                if (hidden && hidden.value) {
                    var parts = hidden.value.split('-');
                    if (parts.length === 3) {
                        selected = {
                            y: parseInt(parts[0], 10),
                            m: parseInt(parts[1], 10) - 1,
                            d: parseInt(parts[2], 10)
                        };
                        viewYear = selected.y;
                        viewMonth = selected.m;
                        label.textContent = formatDisplay(selected.y, selected.m, selected.d);
                        label.classList.remove('is-placeholder');
                    }
                }

                function syncSelects() {
                    monthSelect.value = String(viewMonth);
                    yearSelect.value = String(viewYear);
                }

                function render() {
                    syncSelects();
                    daysEl.innerHTML = '';

                    var firstDay = new Date(viewYear, viewMonth, 1).getDay();
                    var daysInMonth = new Date(viewYear, viewMonth + 1, 0).getDate();

                    for (var i = 0; i < firstDay; i++) {
                        var empty = document.createElement('button');
                        empty.type = 'button';
                        empty.className = 'cdp-day empty';
                        empty.tabIndex = -1;
                        daysEl.appendChild(empty);
                    }

                    for (var d = 1; d <= daysInMonth; d++) {
                        var btn = document.createElement('button');
                        btn.type = 'button';
                        btn.className = 'cdp-day';
                        btn.textContent = d;

                        var cellDate = new Date(viewYear, viewMonth, d);
                        if (cellDate > maxDate || viewYear < minYear) {
                            btn.classList.add('disabled');
                        }

                        if (now.getFullYear() === viewYear &&
                            now.getMonth() === viewMonth &&
                            now.getDate() === d) {
                            btn.classList.add('today');
                        }

                        if (selected &&
                            selected.y === viewYear &&
                            selected.m === viewMonth &&
                            selected.d === d) {
                            btn.classList.add('selected');
                        }

                        btn.addEventListener('click', (function(day) {
                            return function(e) {
                                e.stopPropagation();
                                selected = {
                                    y: viewYear,
                                    m: viewMonth,
                                    d: day
                                };
                                label.textContent = formatDisplay(selected.y, selected.m, selected.d);
                                label.classList.remove('is-placeholder');
                                if (hidden) {
                                    hidden.value = formatValue(selected.y, selected.m, selected.d);
                                    hidden.dispatchEvent(new Event('change', {
                                        bubbles: true
                                    }));
                                }
                                closeAll();
                                root.dispatchEvent(new CustomEvent('cdp:change', {
                                    detail: {
                                        value: hidden ? hidden.value : '',
                                        display: label.textContent
                                    },
                                    bubbles: true
                                }));
                            };
                        })(d));

                        daysEl.appendChild(btn);
                    }
                }

                trigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var isOpen = root.classList.contains('open');
                    closeAll();
                    if (!isOpen) {
                        root.classList.add('open');
                        render();
                        placePanel(root);
                    }
                });

                prevBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    viewMonth--;
                    if (viewMonth < 0) {
                        viewMonth = 11;
                        viewYear--;
                    }
                    if (viewYear < minYear) {
                        viewYear = minYear;
                        viewMonth = 0;
                    }
                    render();
                    placePanel(root);
                });

                nextBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    viewMonth++;
                    if (viewMonth > 11) {
                        viewMonth = 0;
                        viewYear++;
                    }
                    if (viewYear > maxYear) {
                        viewYear = maxYear;
                        viewMonth = now.getMonth();
                    }
                    render();
                    placePanel(root);
                });

                // Month dropdown
                monthSelect.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
                monthSelect.addEventListener('change', function(e) {
                    e.stopPropagation();
                    viewMonth = parseInt(monthSelect.value, 10);
                    render();
                    placePanel(root);
                });

                // Year dropdown
                yearSelect.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
                yearSelect.addEventListener('change', function(e) {
                    e.stopPropagation();
                    viewYear = parseInt(yearSelect.value, 10);
                    render();
                    placePanel(root);
                });

                clearBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    selected = null;
                    label.textContent = 'Select date of birth';
                    label.classList.add('is-placeholder');
                    if (hidden) {
                        hidden.value = '';
                        hidden.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));
                    }
                    closeAll();
                });

                todayBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    selected = {
                        y: now.getFullYear(),
                        m: now.getMonth(),
                        d: now.getDate()
                    };
                    viewYear = selected.y;
                    viewMonth = selected.m;
                    label.textContent = formatDisplay(selected.y, selected.m, selected.d);
                    label.classList.remove('is-placeholder');
                    if (hidden) {
                        hidden.value = formatValue(selected.y, selected.m, selected.d);
                        hidden.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));
                    }
                    closeAll();
                });

                panel.addEventListener('click', function(e) {
                    e.stopPropagation();
                });

                render();
            }

            function initAll() {
                document.querySelectorAll('.custom-datepicker').forEach(initDatepicker);
            }

            document.addEventListener('click', function() {
                closeAll();
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeAll();
            });

            window.addEventListener('scroll', function() {
                document.querySelectorAll('.custom-datepicker.open').forEach(placePanel);
            }, true);

            window.addEventListener('resize', function() {
                document.querySelectorAll('.custom-datepicker.open').forEach(placePanel);
            });

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initAll);
            } else {
                initAll();
            }

            window.initCustomDatepickers = initAll;
        })();
    </script>
</body>

</html>