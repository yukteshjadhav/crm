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

    <style>
        :root {
            --sidebar-width: 240px;
            --header-height: 64px;
            --primary: #673de6;
            --primary-hover: #5a2fd1;
            --text: #1a1a2e;
            --text-secondary: #4a4a68;
            --text-muted: #6b6b85;
            --glass-bg: rgba(255, 255, 255, 0.55);
            --glass-border: rgba(255, 255, 255, 0.45);
            --glass-shadow: 0 8px 32px rgba(31, 38, 135, 0.12);
            --glass-blur: blur(20px);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 30%, #fce7f3 60%, #e0f2fe 100%);
            background-attachment: fixed;
            color: var(--text);
            display: flex;
            min-height: 100vh;
            font-size: 14px;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        /* ========== SIDEBAR (Glass) ========== */
        .sidebar {
            width: var(--sidebar-width);
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border-right: 1px solid var(--glass-border);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 200;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            height: var(--header-height);
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
            flex-shrink: 0;
        }

        .sidebar-logo {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #673de6, #8b5cf6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(103, 61, 230, 0.35);
        }

        .sidebar-logo svg {
            width: 16px;
            height: 16px;
            fill: white;
        }

        .sidebar-brand {
            font-size: 15px;
            font-weight: 600;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .nav-section {
            margin-bottom: 24px;
        }

        .nav-section-title {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            padding: 0 12px 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 12px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            transition: all 0.2s;
            margin-bottom: 2px;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-family: inherit;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.5);
            color: var(--text);
        }

        .nav-item.active {
            background: rgba(103, 61, 230, 0.12);
            color: var(--primary);
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(103, 61, 230, 0.1);
        }

        .nav-item svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--primary);
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 10px;
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.4);
            flex-shrink: 0;
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.4);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #673de6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 12px;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
        }

        .user-role {
            font-size: 11.5px;
            color: var(--text-muted);
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(4px);
            z-index: 150;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* ========== MAIN ========== */
        .main {
            flex: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            min-width: 0;
            transition: margin-left 0.3s ease;
        }

        /* Header - Glass */
        .header {
            height: var(--header-height);
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border-bottom: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px 0 16px;
            position: sticky;
            top: 0;
            z-index: 50;
            gap: 12px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .menu-btn {
            display: none;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            border: 1px solid var(--glass-border);
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            align-items: center;
            justify-content: center;
            cursor: pointer;
            flex-shrink: 0;
        }

        .menu-btn:hover {
            background: rgba(255, 255, 255, 0.7);
        }

        .menu-btn svg {
            width: 20px;
            height: 20px;
            fill: var(--text-secondary);
        }

        .page-title {
            font-size: 17px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .icon-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid var(--glass-border);
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .icon-btn:hover {
            background: rgba(255, 255, 255, 0.75);
        }

        .icon-btn svg {
            width: 16px;
            height: 16px;
            fill: var(--text-secondary);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            height: 36px;
            padding: 0 14px;
            background: linear-gradient(135deg, #673de6, #8b5cf6);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            white-space: nowrap;
            box-shadow: 0 4px 14px rgba(103, 61, 230, 0.35);
            transition: all 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(103, 61, 230, 0.45);
        }

        .btn-primary svg {
            width: 15px;
            height: 15px;
            fill: white;
        }

        .btn-text {
            display: inline;
        }

        .content {
            padding: 20px;
            flex: 1;
        }

        .page {
            display: none;
        }

        .page.active {
            display: block;
        }

        /* Welcome */
        .welcome-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .welcome h1 {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.03em;
            margin-bottom: 2px;
        }

        .welcome p {
            font-size: 13.5px;
            color: var(--text-muted);
        }

        .date-badge {
            font-size: 12.5px;
            font-weight: 500;
            color: var(--text-secondary);
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            padding: 6px 12px;
            border-radius: 10px;
        }

        /* Glass Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }

        .stat-card,
        .card {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            box-shadow: var(--glass-shadow);
            transition: all 0.25s ease;
        }

        .stat-card:hover,
        .card:hover {
            background: rgba(255, 255, 255, 0.7);
            box-shadow: 0 12px 40px rgba(31, 38, 135, 0.15);
            transform: translateY(-2px);
        }

        .stat-card {
            padding: 14px 16px;
        }

        .stat-label {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .stat-change {
            font-size: 11px;
            font-weight: 500;
            margin-top: 4px;
        }

        .stat-change.up {
            color: #059669;
        }

        .stat-change.down {
            color: #dc2626;
        }

        .main-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
        }

        .card-header {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255, 255, 255, 0.35);
            gap: 8px;
        }

        .card-title {
            font-size: 14px;
            font-weight: 600;
        }

        .card-link {
            font-size: 12.5px;
            font-weight: 500;
            color: var(--primary);
            text-decoration: none;
            white-space: nowrap;
        }

        .card-body {
            padding: 16px;
        }

        /* Chart */
        .chart-bars {
            display: flex;
            align-items: flex-end;
            gap: 6px;
            height: 150px;
            padding-top: 8px;
        }

        .chart-col {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            min-width: 0;
        }

        .chart-bar-wrap {
            width: 100%;
            height: 120px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        .chart-bar {
            width: 70%;
            max-width: 32px;
            border-radius: 6px 6px 2px 2px;
            background: linear-gradient(180deg, #a78bfa, #673de6);
            box-shadow: 0 4px 10px rgba(103, 61, 230, 0.3);
        }

        .chart-label {
            font-size: 10.5px;
            font-weight: 500;
            color: var(--text-muted);
        }

        .chart-value {
            font-size: 10.5px;
            font-weight: 600;
            color: var(--text-secondary);
        }

        /* Funnel */
        .funnel-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .funnel-item:last-child {
            margin-bottom: 0;
        }

        .funnel-label {
            width: 75px;
            font-size: 12.5px;
            font-weight: 500;
            color: var(--text-secondary);
            flex-shrink: 0;
        }

        .funnel-bar-bg {
            flex: 1;
            height: 20px;
            background: rgba(0, 0, 0, 0.06);
            border-radius: 6px;
            overflow: hidden;
        }

        .funnel-bar {
            height: 100%;
            border-radius: 6px;
            display: flex;
            align-items: center;
            padding-left: 8px;
            font-size: 11px;
            font-weight: 600;
            color: white;
        }

        .funnel-count {
            width: 32px;
            text-align: right;
            font-size: 12.5px;
            font-weight: 600;
        }

        /* Leaderboard */
        .rep-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .rep-row:last-child {
            border-bottom: none;
        }

        .rep-rank {
            width: 20px;
            height: 20px;
            border-radius: 6px;
            background: rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10.5px;
            font-weight: 700;
            color: var(--text-muted);
            flex-shrink: 0;
        }

        .rep-rank.gold {
            background: #fef3c7;
            color: #b45309;
        }

        .rep-rank.silver {
            background: #f1f5f9;
            color: #475569;
        }

        .rep-rank.bronze {
            background: #ffedd5;
            color: #c2410c;
        }

        .rep-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(103, 61, 230, 0.15);
            color: #5b21b6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10.5px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .rep-info {
            flex: 1;
            min-width: 0;
        }

        .rep-name {
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .rep-deals {
            font-size: 11.5px;
            color: var(--text-muted);
        }

        .rep-value {
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* Tasks */
        .task-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 9px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .task-item:last-child {
            border-bottom: none;
        }

        .task-check {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(0, 0, 0, 0.15);
            border-radius: 5px;
            margin-top: 2px;
            flex-shrink: 0;
            cursor: pointer;
        }

        .task-content {
            flex: 1;
            min-width: 0;
        }

        .task-title {
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 1px;
        }

        .task-meta {
            font-size: 11.5px;
            color: var(--text-muted);
        }

        .task-priority {
            font-size: 10.5px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .task-priority.high {
            background: rgba(239, 68, 68, 0.12);
            color: #b91c1c;
        }

        .task-priority.medium {
            background: rgba(249, 115, 22, 0.12);
            color: #c2410c;
        }

        .task-priority.low {
            background: rgba(34, 197, 94, 0.12);
            color: #15803d;
        }

        /* Activity */
        .activity-item {
            display: flex;
            gap: 8px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-top: 5px;
            flex-shrink: 0;
        }

        .activity-text {
            font-size: 12.5px;
            margin-bottom: 1px;
        }

        .activity-text strong {
            font-weight: 600;
        }

        .activity-time {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* Target */
        .target-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 6px;
            gap: 8px;
        }

        .target-label {
            font-size: 12.5px;
            font-weight: 500;
            color: var(--text-secondary);
        }

        .target-numbers {
            font-size: 12.5px;
            font-weight: 600;
        }

        .target-bar-bg {
            height: 8px;
            background: rgba(0, 0, 0, 0.06);
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 4px;
        }

        .target-bar {
            height: 100%;
            border-radius: 4px;
            background: linear-gradient(90deg, #673de6, #8b5cf6);
        }

        .target-pct {
            font-size: 11.5px;
            color: var(--text-muted);
        }

        /* Source */
        .source-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 7px 0;
            gap: 8px;
        }

        .source-left {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
        }

        .source-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .source-name {
            font-size: 12.5px;
            font-weight: 500;
        }

        .source-value {
            font-size: 12.5px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* ========== LEADS TABLE ========== */
        .filters {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-select {
            height: 34px;
            padding: 0 12px;
            border: 1px solid var(--glass-border);
            border-radius: 10px;
            font-size: 13px;
            font-family: inherit;
            font-weight: 500;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(8px);
            color: var(--text-secondary);
            outline: none;
            cursor: pointer;
        }

        .filter-select:focus {
            border-color: #c4b5fd;
            background: rgba(255, 255, 255, 0.75);
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }

        thead {
            background: rgba(255, 255, 255, 0.3);
        }

        th {
            text-align: left;
            padding: 11px 16px;
            font-weight: 600;
            color: var(--text-muted);
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            white-space: nowrap;
            border-bottom: 1px solid rgba(255, 255, 255, 0.35);
        }

        td {
            padding: 13px 16px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            vertical-align: middle;
            color: var(--text-secondary);
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.35);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .lead-name {
            font-weight: 600;
            color: var(--text);
            font-size: 13.5px;
        }

        .lead-email {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .company {
            font-weight: 500;
            color: var(--text);
        }

        .source-tag {
            display: inline-block;
            padding: 3px 9px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            background: rgba(0, 0, 0, 0.05);
            color: #5a5a7a;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .badge.new {
            background: rgba(59, 130, 246, 0.12);
            color: #1d4ed8;
        }

        .badge.new::before {
            background: #3b82f6;
        }

        .badge.contacted {
            background: rgba(139, 92, 246, 0.12);
            color: #6d28d9;
        }

        .badge.contacted::before {
            background: #8b5cf6;
        }

        .badge.qualified {
            background: rgba(16, 185, 129, 0.12);
            color: #047857;
        }

        .badge.qualified::before {
            background: #10b981;
        }

        .badge.proposal {
            background: rgba(249, 115, 22, 0.12);
            color: #c2410c;
        }

        .badge.proposal::before {
            background: #f97316;
        }

        .badge.won {
            background: rgba(5, 150, 105, 0.15);
            color: #065f46;
        }

        .badge.won::before {
            background: #059669;
        }

        .badge.lost {
            background: rgba(239, 68, 68, 0.12);
            color: #b91c1c;
        }

        .badge.lost::before {
            background: #ef4444;
        }

        .value {
            font-weight: 600;
            color: var(--text);
        }

        .assignee {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .assignee-avatar {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: rgba(103, 61, 230, 0.15);
            color: #5b21b6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10.5px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .actions {
            display: flex;
            gap: 6px;
        }

        .action-btn {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            border: 1px solid var(--glass-border);
            background: rgba(255, 255, 255, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .action-btn:hover {
            background: rgba(255, 255, 255, 0.8);
        }

        .action-btn svg {
            width: 14px;
            height: 14px;
            fill: var(--text-muted);
        }

        .card-footer {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid rgba(255, 255, 255, 0.35);
            font-size: 13px;
            color: var(--text-muted);
            flex-wrap: wrap;
            gap: 10px;
        }

        .pagination {
            display: flex;
            gap: 4px;
        }

        .page-btn {
            min-width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid var(--glass-border);
            background: rgba(255, 255, 255, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            font-family: inherit;
            color: var(--text-secondary);
        }

        .page-btn:hover:not(:disabled):not(.active) {
            background: rgba(255, 255, 255, 0.8);
        }

        .page-btn.active {
            background: linear-gradient(135deg, #673de6, #8b5cf6);
            border-color: transparent;
            color: white;
            box-shadow: 0 4px 12px rgba(103, 61, 230, 0.3);
        }

        .page-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 1400px) {
            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 1100px) {
            .main-grid {
                grid-template-columns: 1fr;
            }

            .bottom-grid {
                grid-template-columns: 1fr 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main {
                margin-left: 0;
            }

            .menu-btn {
                display: flex;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .bottom-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .content {
                padding: 14px;
            }

            .header {
                padding: 0 12px;
            }

            .welcome h1 {
                font-size: 18px;
            }

            .btn-text {
                display: none;
            }

            .btn-primary {
                padding: 0 12px;
            }

            .stat-value {
                font-size: 18px;
            }
        }

        @media (max-width: 400px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Logout Modal */
        .logout-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.25s ease;
        }

        .logout-modal.active {
            opacity: 1;
            visibility: visible;
        }

        .logout-modal-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            padding: 28px 32px;
            width: 90%;
            max-width: 360px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            transform: scale(0.9);
            transition: transform 0.25s ease;
        }

        .logout-modal.active .logout-modal-content {
            transform: scale(1);
        }

        .logout-modal-icon {
            margin-bottom: 12px;
        }

        .logout-modal-content h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 6px;
            color: #1a1a2e;
        }

        .logout-modal-content p {
            font-size: 14px;
            color: #6b6b85;
            margin-bottom: 22px;
        }

        .logout-modal-actions {
            display: flex;
            gap: 10px;
        }

        .btn-cancel,
        .btn-confirm {
            flex: 1;
            height: 40px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .btn-cancel {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-cancel:hover {
            background: #e2e8f0;
        }

        .btn-confirm {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        .btn-confirm:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.4);
        }

        /* Filter grid */
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
            gap: 14px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            height: 36px;
            padding: 0 11px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 9px;
            background: rgba(255, 255, 255, 0.7);
            font-size: 13px;
            font-family: inherit;
            color: var(--text);
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-control:focus {
            outline: none;
            border-color: #a78bfa;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.12);
            background: #fff;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%236b7280' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 28px;
        }

        .filter-actions {
            display: flex;
            gap: 10px;
            margin-top: 18px;
            flex-wrap: wrap;
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            height: 36px;
            padding: 0 16px;
            border-radius: 10px;
            background: transparent;
            border: 1px solid rgba(0, 0, 0, 0.1);
            color: var(--text-muted);
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            text-decoration: none;
        }

        .btn-outline:hover {
            background: rgba(0, 0, 0, 0.03);
        }
    </style>
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const menuBtn = document.getElementById('menuBtn');

            if (!sidebar || !menuBtn) return;

            function openSidebar() {
                sidebar.classList.add('open');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            menuBtn.addEventListener('click', () => {
                sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
            });

            overlay.addEventListener('click', closeSidebar);

            window.addEventListener('resize', () => {
                if (window.innerWidth > 992) closeSidebar();
            });

            // Logout Modal
            const logoutBtn = document.getElementById('logoutBtn');
            const logoutForm = document.getElementById('logoutForm');
            const logoutModal = document.getElementById('logoutModal');
            const cancelLogout = document.getElementById('cancelLogout');
            const confirmLogout = document.getElementById('confirmLogout');

            if (logoutBtn && logoutModal) {
                logoutBtn.addEventListener('click', () => {
                    logoutModal.classList.add('active');
                });

                cancelLogout.addEventListener('click', () => {
                    logoutModal.classList.remove('active');
                });

                confirmLogout.addEventListener('click', () => {
                    logoutForm.submit();
                });

                // Close when clicking outside the box
                logoutModal.addEventListener('click', (e) => {
                    if (e.target === logoutModal) {
                        logoutModal.classList.remove('active');
                    }
                });

                // Close on Escape key
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && logoutModal.classList.contains('active')) {
                        logoutModal.classList.remove('active');
                    }
                });
            }

        });
    </script>

</body>

</html>