<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Portal • Glass Theme</title>
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
    </style>
</head>

<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <svg viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                </svg>
            </div>
            <span class="sidebar-brand">CRM Portal</span>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Main</div>
                <button class="nav-item active" data-page="dashboard">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                    </svg>
                    Dashboard
                </button>
                <button class="nav-item" data-page="leads">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                    </svg>
                    Leads <span class="nav-badge">48</span>
                </button>
                <button class="nav-item" data-page="contacts">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                    Contacts
                </button>
                <button class="nav-item" data-page="pipeline">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" />
                    </svg>
                    Pipeline
                </button>
            </div>
            <div class="nav-section">
                <div class="nav-section-title">Analytics</div>
                <button class="nav-item" data-page="reports">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3.5 18.49l6-6.01 4 4L22 6.92l-1.41-1.41-7.09 7.97-4-4L2 16.99z" />
                    </svg>
                    Reports
                </button>
                <button class="nav-item" data-page="activities">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" />
                    </svg>
                    Activities
                </button>
            </div>
            <div class="nav-section">
                <div class="nav-section-title">System</div>
                <button class="nav-item" data-page="settings">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19.14 12.94c.04-.31.06-.63.06-.94 0-.31-.02-.63-.06-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.04.31-.06.63-.06.94s.02.63.06.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z" />
                    </svg>
                    Settings
                </button>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">AD</div>
                <div class="user-info">
                    <div class="user-name">Admin User</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">
        <header class="header">
            <div class="header-left">
                <button class="menu-btn" id="menuBtn" aria-label="Open menu">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
                    </svg>
                </button>
                <h1 class="page-title" id="pageTitle">Dashboard</h1>
            </div>
            <div class="header-right">
                <button class="icon-btn" title="Notifications">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z" />
                    </svg>
                </button>
                <button class="btn-primary">
                    <svg viewBox="0 0 24 24">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                    </svg>
                    <span class="btn-text">Add Lead</span>
                </button>
            </div>
        </header>

        <div class="content">

            <!-- DASHBOARD -->
            <div class="page active" id="page-dashboard">
                <div class="welcome-row">
                    <div class="welcome">
                        <h1>Good afternoon, Admin 👋</h1>
                        <p>Here’s a complete overview of your sales performance today.</p>
                    </div>
                    <div class="date-badge">Thursday, 27 Aug 2026</div>
                </div>


            </div>

            <!-- LEADS PAGE -->
            <div class="page" id="page-leads">
                <div class="stats-grid" style="grid-template-columns: repeat(4, 1fr);">
                    <div class="stat-card">
                        <div class="stat-label">Total Leads</div>
                        <div class="stat-value">1,284</div>
                        <div class="stat-change up">↑ 12.5%</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">New This Week</div>
                        <div class="stat-value">86</div>
                        <div class="stat-change up">↑ 8.2%</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Conversion Rate</div>
                        <div class="stat-value">24.8%</div>
                        <div class="stat-change up">↑ 3.1%</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Pipeline Value</div>
                        <div class="stat-value">$428K</div>
                        <div class="stat-change down">↓ 2.4%</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">All Leads</h2>
                        <div class="filters">
                            <select class="filter-select">
                                <option>All Status</option>
                                <option>New</option>
                                <option>Contacted</option>
                                <option>Qualified</option>
                                <option>Proposal</option>
                                <option>Won</option>
                                <option>Lost</option>
                            </select>
                            <select class="filter-select">
                                <option>All Sources</option>
                                <option>Website</option>
                                <option>Referral</option>
                                <option>LinkedIn</option>
                                <option>Cold Call</option>
                                <option>Event</option>
                            </select>
                            <select class="filter-select">
                                <option>All Owners</option>
                                <option>Sarah Chen</option>
                                <option>Mike Torres</option>
                                <option>Priya Sharma</option>
                                <option>James Wilson</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Lead</th>
                                    <th>Company</th>
                                    <th>Source</th>
                                    <th>Status</th>
                                    <th>Value</th>
                                    <th>Assigned To</th>
                                    <th>Last Contact</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="lead-name">Emma Thompson</div>
                                        <div class="lead-email">emma.t@techflow.io</div>
                                    </td>
                                    <td class="company">TechFlow Inc.</td>
                                    <td><span class="source-tag">Website</span></td>
                                    <td><span class="badge new">New</span></td>
                                    <td class="value">$12,500</td>
                                    <td>
                                        <div class="assignee">
                                            <div class="assignee-avatar">SC</div>Sarah Chen
                                        </div>
                                    </td>
                                    <td>2 hours ago</td>
                                    <td>
                                        <div class="actions"><button class="action-btn"><svg viewBox="0 0 24 24">
                                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                                                </svg></button><button class="action-btn"><svg viewBox="0 0 24 24">
                                                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                                </svg></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="lead-name">James Rodriguez</div>
                                        <div class="lead-email">j.rodriguez@novasol.com</div>
                                    </td>
                                    <td class="company">Nova Solutions</td>
                                    <td><span class="source-tag">Referral</span></td>
                                    <td><span class="badge contacted">Contacted</span></td>
                                    <td class="value">$8,200</td>
                                    <td>
                                        <div class="assignee">
                                            <div class="assignee-avatar">MT</div>Mike Torres
                                        </div>
                                    </td>
                                    <td>Yesterday</td>
                                    <td>
                                        <div class="actions"><button class="action-btn"><svg viewBox="0 0 24 24">
                                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                                                </svg></button><button class="action-btn"><svg viewBox="0 0 24 24">
                                                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                                </svg></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="lead-name">Priya Patel</div>
                                        <div class="lead-email">priya@cloudpeak.com</div>
                                    </td>
                                    <td class="company">CloudPeak</td>
                                    <td><span class="source-tag">LinkedIn</span></td>
                                    <td><span class="badge qualified">Qualified</span></td>
                                    <td class="value">$34,000</td>
                                    <td>
                                        <div class="assignee">
                                            <div class="assignee-avatar">PS</div>Priya Sharma
                                        </div>
                                    </td>
                                    <td>3 days ago</td>
                                    <td>
                                        <div class="actions"><button class="action-btn"><svg viewBox="0 0 24 24">
                                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                                                </svg></button><button class="action-btn"><svg viewBox="0 0 24 24">
                                                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                                </svg></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="lead-name">David Kim</div>
                                        <div class="lead-email">david.kim@apexdigital.co</div>
                                    </td>
                                    <td class="company">Apex Digital</td>
                                    <td><span class="source-tag">Event</span></td>
                                    <td><span class="badge proposal">Proposal</span></td>
                                    <td class="value">$56,800</td>
                                    <td>
                                        <div class="assignee">
                                            <div class="assignee-avatar">JW</div>James Wilson
                                        </div>
                                    </td>
                                    <td>1 week ago</td>
                                    <td>
                                        <div class="actions"><button class="action-btn"><svg viewBox="0 0 24 24">
                                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                                                </svg></button><button class="action-btn"><svg viewBox="0 0 24 24">
                                                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                                </svg></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="lead-name">Sophia Martinez</div>
                                        <div class="lead-email">sophia@brightpath.agency</div>
                                    </td>
                                    <td class="company">BrightPath Agency</td>
                                    <td><span class="source-tag">Website</span></td>
                                    <td><span class="badge won">Won</span></td>
                                    <td class="value">$19,400</td>
                                    <td>
                                        <div class="assignee">
                                            <div class="assignee-avatar">SC</div>Sarah Chen
                                        </div>
                                    </td>
                                    <td>2 weeks ago</td>
                                    <td>
                                        <div class="actions"><button class="action-btn"><svg viewBox="0 0 24 24">
                                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                                                </svg></button><button class="action-btn"><svg viewBox="0 0 24 24">
                                                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                                </svg></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="lead-name">Liam O'Connor</div>
                                        <div class="lead-email">liam@greenfield.io</div>
                                    </td>
                                    <td class="company">GreenField Ltd</td>
                                    <td><span class="source-tag">Cold Call</span></td>
                                    <td><span class="badge lost">Lost</span></td>
                                    <td class="value">$7,800</td>
                                    <td>
                                        <div class="assignee">
                                            <div class="assignee-avatar">MT</div>Mike Torres
                                        </div>
                                    </td>
                                    <td>3 weeks ago</td>
                                    <td>
                                        <div class="actions"><button class="action-btn"><svg viewBox="0 0 24 24">
                                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                                                </svg></button><button class="action-btn"><svg viewBox="0 0 24 24">
                                                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                                </svg></button></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div>Showing 1–6 of 48 leads</div>
                        <div class="pagination">
                            <button class="page-btn" disabled>‹</button>
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <button class="page-btn">4</button>
                            <button class="page-btn">›</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Placeholders -->
            <div class="page" id="page-contacts">
                <div class="welcome">
                    <h1>Contacts</h1>
                    <p>Contacts page coming soon.</p>
                </div>
            </div>
            <div class="page" id="page-pipeline">
                <div class="welcome">
                    <h1>Pipeline</h1>
                    <p>Pipeline page coming soon.</p>
                </div>
            </div>
            <div class="page" id="page-reports">
                <div class="welcome">
                    <h1>Reports</h1>
                    <p>Reports page coming soon.</p>
                </div>
            </div>
            <div class="page" id="page-activities">
                <div class="welcome">
                    <h1>Activities</h1>
                    <p>Activities page coming soon.</p>
                </div>
            </div>
            <div class="page" id="page-settings">
                <div class="welcome">
                    <h1>Settings</h1>
                    <p>Settings page coming soon.</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const menuBtn = document.getElementById('menuBtn');
        const pageTitle = document.getElementById('pageTitle');

        const titles = {
            dashboard: 'Dashboard',
            leads: 'Lead Tracking',
            contacts: 'Contacts',
            pipeline: 'Pipeline',
            reports: 'Reports',
            activities: 'Activities',
            settings: 'Settings'
        };

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

        document.querySelectorAll('.nav-item').forEach(btn => {
            btn.addEventListener('click', () => {
                const page = btn.dataset.page;
                document.querySelectorAll('.nav-item').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
                const target = document.getElementById('page-' + page);
                if (target) target.classList.add('active');
                pageTitle.textContent = titles[page] || page;
                if (window.innerWidth <= 992) closeSidebar();
            });
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 992) closeSidebar();
        });
    </script>
</body>

</html>