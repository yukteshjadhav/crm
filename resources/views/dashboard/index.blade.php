@extends('layouts.app')

@section('title', 'Dashboard • CRM Portal')
@section('page-title', 'Dashboard')

@section('content')
{{-- Paste only the content inside #page-dashboard from your HTML --}}
<div class="welcome-row">
    <div class="welcome">
        <h1>Good afternoon, {{ auth()->user()->name ?? 'Admin' }} 👋</h1>
        <p>Here’s a complete overview of your sales performance today.</p>
    </div>
    <div class="date-badge">{{ now()->format('l, d M Y') }}</div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total Leads</div>
        <div class="stat-value">1,284</div>
        <div class="stat-change up">↑ 12.5% vs last month</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">New This Week</div>
        <div class="stat-value">86</div>
        <div class="stat-change up">↑ 8.2% vs last week</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Conversion Rate</div>
        <div class="stat-value">24.8%</div>
        <div class="stat-change up">↑ 3.1% vs last month</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Won Deals</div>
        <div class="stat-value">47</div>
        <div class="stat-change up">↑ 6 this month</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Avg. Deal Size</div>
        <div class="stat-value">₹9,120</div>
        <div class="stat-change up">↑ 4.2%</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Pipeline Value</div>
        <div class="stat-value">₹428K</div>
        <div class="stat-change down">↓ 2.4% vs last month</div>
    </div>
</div>

<div class="main-grid">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Leads Over Time (Last 7 Days)</h2><a href="#" class="card-link">View report</a>
        </div>
        <div class="card-body">
            <div class="chart-bars">
                <div class="chart-col">
                    <div class="chart-value">18</div>
                    <div class="chart-bar-wrap">
                        <div class="chart-bar" style="height:55%"></div>
                    </div>
                    <div class="chart-label">Thu</div>
                </div>
                <div class="chart-col">
                    <div class="chart-value">24</div>
                    <div class="chart-bar-wrap">
                        <div class="chart-bar" style="height:72%"></div>
                    </div>
                    <div class="chart-label">Fri</div>
                </div>
                <div class="chart-col">
                    <div class="chart-value">12</div>
                    <div class="chart-bar-wrap">
                        <div class="chart-bar" style="height:38%"></div>
                    </div>
                    <div class="chart-label">Sat</div>
                </div>
                <div class="chart-col">
                    <div class="chart-value">9</div>
                    <div class="chart-bar-wrap">
                        <div class="chart-bar" style="height:28%"></div>
                    </div>
                    <div class="chart-label">Sun</div>
                </div>
                <div class="chart-col">
                    <div class="chart-value">31</div>
                    <div class="chart-bar-wrap">
                        <div class="chart-bar" style="height:95%"></div>
                    </div>
                    <div class="chart-label">Mon</div>
                </div>
                <div class="chart-col">
                    <div class="chart-value">27</div>
                    <div class="chart-bar-wrap">
                        <div class="chart-bar" style="height:82%"></div>
                    </div>
                    <div class="chart-label">Tue</div>
                </div>
                <div class="chart-col">
                    <div class="chart-value">22</div>
                    <div class="chart-bar-wrap">
                        <div class="chart-bar" style="height:68%"></div>
                    </div>
                    <div class="chart-label">Wed</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Conversion Funnel</h2><a href="#" class="card-link">Details</a>
        </div>
        <div class="card-body">
            <div class="funnel-item">
                <div class="funnel-label">New</div>
                <div class="funnel-bar-bg">
                    <div class="funnel-bar" style="width:100%;background:#3b82f6">100%</div>
                </div>
                <div class="funnel-count">142</div>
            </div>
            <div class="funnel-item">
                <div class="funnel-label">Contacted</div>
                <div class="funnel-bar-bg">
                    <div class="funnel-bar" style="width:78%;background:#8b5cf6">78%</div>
                </div>
                <div class="funnel-count">111</div>
            </div>
            <div class="funnel-item">
                <div class="funnel-label">Qualified</div>
                <div class="funnel-bar-bg">
                    <div class="funnel-bar" style="width:52%;background:#10b981">52%</div>
                </div>
                <div class="funnel-count">74</div>
            </div>
            <div class="funnel-item">
                <div class="funnel-label">Proposal</div>
                <div class="funnel-bar-bg">
                    <div class="funnel-bar" style="width:34%;background:#f97316">34%</div>
                </div>
                <div class="funnel-count">48</div>
            </div>
            <div class="funnel-item">
                <div class="funnel-label">Won</div>
                <div class="funnel-bar-bg">
                    <div class="funnel-bar" style="width:22%;background:#059669">22%</div>
                </div>
                <div class="funnel-count">31</div>
            </div>
        </div>
    </div>
</div>

<div class="main-grid">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Top Sales Representatives</h2><a href="#" class="card-link">View all</a>
        </div>
        <div class="card-body">
            <div class="rep-row">
                <div class="rep-rank gold">1</div>
                <div class="rep-avatar">SC</div>
                <div class="rep-info">
                    <div class="rep-name">Sarah Chen</div>
                    <div class="rep-deals">14 deals closed</div>
                </div>
                <div class="rep-value">₹128,400</div>
            </div>
            <div class="rep-row">
                <div class="rep-rank silver">2</div>
                <div class="rep-avatar">MT</div>
                <div class="rep-info">
                    <div class="rep-name">Mike Torres</div>
                    <div class="rep-deals">11 deals closed</div>
                </div>
                <div class="rep-value">₹97,200</div>
            </div>
            <div class="rep-row">
                <div class="rep-rank bronze">3</div>
                <div class="rep-avatar">PS</div>
                <div class="rep-info">
                    <div class="rep-name">Priya Sharma</div>
                    <div class="rep-deals">9 deals closed</div>
                </div>
                <div class="rep-value">₹84,600</div>
            </div>
            <div class="rep-row">
                <div class="rep-rank">4</div>
                <div class="rep-avatar">JW</div>
                <div class="rep-info">
                    <div class="rep-name">James Wilson</div>
                    <div class="rep-deals">7 deals closed</div>
                </div>
                <div class="rep-value">₹61,800</div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Upcoming Follow-ups</h2><a href="#" class="card-link">View all</a>
        </div>
        <div class="card-body">
            <div class="task-item">
                <div class="task-check"></div>
                <div class="task-content">
                    <div class="task-title">Call Emma Thompson – TechFlow</div>
                    <div class="task-meta">Today • 3:30 PM</div>
                </div><span class="task-priority high">High</span>
            </div>
            <div class="task-item">
                <div class="task-check"></div>
                <div class="task-content">
                    <div class="task-title">Send proposal to David Kim</div>
                    <div class="task-meta">Today • 5:00 PM</div>
                </div><span class="task-priority high">High</span>
            </div>
            <div class="task-item">
                <div class="task-check"></div>
                <div class="task-content">
                    <div class="task-title">Follow up with James Rodriguez</div>
                    <div class="task-meta">Tomorrow • 11:00 AM</div>
                </div><span class="task-priority medium">Medium</span>
            </div>
            <div class="task-item">
                <div class="task-check"></div>
                <div class="task-content">
                    <div class="task-title">Demo call – CloudPeak</div>
                    <div class="task-meta">Fri, 29 Aug • 2:00 PM</div>
                </div><span class="task-priority medium">Medium</span>
            </div>
            <div class="task-item">
                <div class="task-check"></div>
                <div class="task-content">
                    <div class="task-title">Contract review – BrightPath</div>
                    <div class="task-meta">Mon, 1 Sep • 10:00 AM</div>
                </div><span class="task-priority low">Low</span>
            </div>
        </div>
    </div>
</div>

<div class="bottom-grid">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Monthly Revenue Target</h2>
        </div>
        <div class="card-body">
            <div class="target-header"><span class="target-label">August 2026</span><span class="target-numbers">₹312K / ₹400K</span></div>
            <div class="target-bar-bg">
                <div class="target-bar" style="width:78%"></div>
            </div>
            <div class="target-pct">78% achieved • ₹88K remaining</div>
            <div style="margin-top:16px">
                <div class="target-header"><span class="target-label">Won this month</span><span class="target-numbers">47 deals</span></div>
                <div class="target-header" style="margin-top:6px"><span class="target-label">Avg. sales cycle</span><span class="target-numbers">18 days</span></div>
                <div class="target-header" style="margin-top:6px"><span class="target-label">Win rate</span><span class="target-numbers">24.8%</span></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Recent Activity</h2><a href="#" class="card-link">View all</a>
        </div>
        <div class="card-body">
            <div class="activity-item">
                <div class="activity-dot" style="background:#3b82f6"></div>
                <div>
                    <div class="activity-text"><strong>Emma Thompson</strong> added as new lead</div>
                    <div class="activity-time">2 hours ago • Website</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-dot" style="background:#8b5cf6"></div>
                <div>
                    <div class="activity-text"><strong>James Rodriguez</strong> → Contacted</div>
                    <div class="activity-time">5 hours ago • Mike Torres</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-dot" style="background:#10b981"></div>
                <div>
                    <div class="activity-text"><strong>Priya Patel</strong> marked Qualified</div>
                    <div class="activity-time">Yesterday • Priya Sharma</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-dot" style="background:#f97316"></div>
                <div>
                    <div class="activity-text">Proposal sent to <strong>David Kim</strong></div>
                    <div class="activity-time">2 days ago • ₹56,800</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-dot" style="background:#059669"></div>
                <div>
                    <div class="activity-text"><strong>Sophia Martinez</strong> deal won</div>
                    <div class="activity-time">3 days ago • ₹19,400</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Leads by Source</h2><a href="#" class="card-link">Report</a>
        </div>
        <div class="card-body">
            <div class="source-row">
                <div class="source-left">
                    <div class="source-dot" style="background:#673de6"></div><span class="source-name">Website</span>
                </div><span class="source-value">38% (488)</span>
            </div>
            <div class="source-row">
                <div class="source-left">
                    <div class="source-dot" style="background:#8b5cf6"></div><span class="source-name">Referral</span>
                </div><span class="source-value">24% (308)</span>
            </div>
            <div class="source-row">
                <div class="source-left">
                    <div class="source-dot" style="background:#a78bfa"></div><span class="source-name">LinkedIn</span>
                </div><span class="source-value">16% (205)</span>
            </div>
            <div class="source-row">
                <div class="source-left">
                    <div class="source-dot" style="background:#c4b5fd"></div><span class="source-name">Event</span>
                </div><span class="source-value">12% (154)</span>
            </div>
            <div class="source-row">
                <div class="source-left">
                    <div class="source-dot" style="background:#ddd6fe"></div><span class="source-name">Cold Call</span>
                </div><span class="source-value">10% (129)</span>
            </div>
        </div>
    </div>
</div>
@endsection