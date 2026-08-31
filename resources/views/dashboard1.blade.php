<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Lead Console • Premium Glass</title>
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

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.28);
        }

        .glass-nav {
            background: rgba(15, 23, 48, 0.78);
            backdrop-filter: blur(28px) saturate(160%);
            -webkit-backdrop-filter: blur(28px) saturate(160%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .glass-sidebar {
            background: rgba(255, 255, 255, 0.27);
            backdrop-filter: blur(32px) saturate(180%);
            -webkit-backdrop-filter: blur(32px) saturate(180%);
            border-right: 1px solid rgba(255, 255, 255, 0.45);
            box-shadow: 8px 0 40px rgba(0, 0, 0, 0.06);
        }

        .card-glass {
            background: rgba(255, 255, 255, 0.38);
            backdrop-filter: blur(24px) saturate(160%);
            -webkit-backdrop-filter: blur(24px) saturate(160%);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow:
                0 8px 32px rgba(31, 38, 135, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
            border-radius: 18px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card-glass:hover {
            background: rgba(255, 255, 255, 0.68);
            box-shadow:
                0 16px 48px rgba(31, 38, 135, 0.14),
                inset 0 1px 0 rgba(255, 255, 255, 0.7);
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
    </style>
</head>

<body class="text-ink h-screen overflow-hidden flex flex-col relative">

    <!-- Background Orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- TOP NAV -->
    <nav class="relative z-50 flex justify-between items-center w-full px-6 h-[64px] glass-nav flex-shrink-0 shadow-xl">
        <div class="flex items-center gap-5">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-white/15 flex items-center justify-center shadow-inner">
                    <span class="material-symbols-outlined text-white/90 text-[19px]">workspaces</span>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="eyebrow text-white/45">LEAD · 25 AUG 2026</span>
                    <span class="font-display text-[19px] font-semibold text-white mt-0.5">Yuktesh Jadhav</span>
                </div>
            </div>
            <div class="flex gap-2 ml-2 pl-5 border-l border-white/15">
                <span class="flex items-center gap-1.5 bg-white/12 text-white px-3 py-1.5 rounded-lg font-body text-[12.5px] font-medium backdrop-blur-sm">
                    <span class="material-symbols-outlined text-[15px] text-emerald-300">check_circle</span>
                    Eligible · ₹5,000
                </span>
                <span class="flex items-center gap-1.5 bg-white/6 text-white/55 px-3 py-1.5 rounded-lg font-body text-[12.5px]">
                    Incentive · ₹0
                </span>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <button class="flex items-center gap-2 bg-white/10 hover:bg-white/18 px-4 py-2 rounded-lg text-white font-body text-[13px] font-medium transition-all">
                <span class="material-symbols-outlined text-[16px]">description</span>
                University Document
                <span class="material-symbols-outlined text-[16px] text-white/50">expand_more</span>
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
        <aside class="w-[330px] flex flex-col glass-sidebar flex-shrink-0">
            <div class="px-4 pt-4 pb-3 flex justify-between items-center border-b border-white/30">
                <span class="font-display text-[16px] font-semibold text-ink">Pipeline Overview</span>
                <div class="flex gap-0.5">
                    <button class="p-1.5 hover:bg-white/40 rounded-lg text-ink-faint hover:text-ink transition-colors">
                        <span class="material-symbols-outlined text-[17px]">refresh</span>
                    </button>
                    <button class="p-1.5 hover:bg-white/40 rounded-lg text-ink-faint hover:text-ink transition-colors">
                        <span class="material-symbols-outlined text-[17px]">add</span>
                    </button>
                </div>
            </div>

            <div class="flex p-1.5 gap-1 bg-white/25 mx-3 mt-3 rounded-xl backdrop-blur-sm">
                <button class="flex-1 py-1.5 rounded-lg text-center font-body text-[12.5px] font-semibold text-white bg-navy shadow-md">Dashboard</button>
                <button class="flex-1 py-1.5 rounded-lg text-center font-body text-[12.5px] font-medium text-ink-muted hover:text-ink transition-colors">List</button>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar px-3 pt-4 pb-4">

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

            <div class="border-t border-white/30 p-4 flex justify-between items-center cursor-pointer hover:bg-white/25 transition-colors">
                <span class="font-body text-[13px] font-semibold text-ink">Summary Report</span>
                <span class="material-symbols-outlined text-ink-faint text-[18px]">chevron_right</span>
            </div>
        </aside>

        <!-- MAIN -->
        <main class="flex-1 overflow-y-auto custom-scrollbar p-5">
            <div class="max-w-[1440px] mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 items-start">

                    <!-- COLUMN 1 : Personal & Contact -->
                    <div class="flex flex-col gap-5">
                        <div class="card-glass">
                            <div class="px-5 py-4 border-b border-white/30 flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-accent-soft flex items-center justify-center">
                                    <span class="material-symbols-outlined text-accent text-[16px]">person</span>
                                </span>
                                <h2 class="font-display text-[16px] font-semibold text-ink">Personal &amp; Contact</h2>
                            </div>
                            <div class="p-5 flex flex-col gap-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Name</label>
                                        <input class="field p-2.5 text-[13.5px] rounded-lg" type="text" />
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Middle Name</label>
                                        <input class="field p-2.5 text-[13.5px] rounded-lg" type="text" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Last Name</label>
                                        <input class="field p-2.5 text-[13.5px] rounded-lg" type="text" />
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Gender</label>
                                        <select class="field p-2.5 text-[13.5px] rounded-lg">
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 bg-accent-soft/50 p-3.5 -mx-1 rounded-xl border border-accent/15">
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
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Email</label>
                                        <input class="field p-2.5 text-[13.5px] rounded-lg" type="email" />
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="font-body text-[12px] font-medium text-ink-muted">Date of Birth</label>
                                        <input class="field p-2.5 text-[13.5px] rounded-lg" type="date" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
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
                                <div class="grid grid-cols-2 gap-4">
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
                    <div class="flex flex-col gap-5">
                        <!-- Education & Work -->
                        <div class="card-glass">
                            <div class="px-5 py-4 border-b border-white/30 flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-accent-soft flex items-center justify-center">
                                    <span class="material-symbols-outlined text-accent text-[16px]">school</span>
                                </span>
                                <h2 class="font-display text-[16px] font-semibold text-ink">Education &amp; Work</h2>
                            </div>
                            <div class="p-5 flex flex-col gap-4">
                                <div class="flex flex-col gap-1.5">
                                    <label class="font-body text-[12px] font-medium text-ink-muted">Qualification</label>
                                    <select class="field p-2.5 text-[13.5px] rounded-lg w-full">
                                        <option>Select</option>
                                    </select>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
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

                        <!-- Opportunity -->
                        <div class="card-glass">
                            <div class="px-5 py-4 border-b border-white/30 flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-accent-soft flex items-center justify-center">
                                    <span class="material-symbols-outlined text-accent text-[16px]">business_center</span>
                                </span>
                                <h2 class="font-display text-[16px] font-semibold text-ink">Opportunity</h2>
                            </div>
                            <div class="p-5 flex flex-col gap-4">
                                <div class="flex flex-col gap-1.5 bg-accent-soft/50 p-3.5 -mx-1 rounded-xl border border-accent/15">
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

                        <!-- Origin -->
                        <div class="card-glass">
                            <div class="px-5 py-4 border-b border-white/30 flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-accent-soft flex items-center justify-center">
                                    <span class="material-symbols-outlined text-accent text-[16px]">flight_takeoff</span>
                                </span>
                                <h2 class="font-display text-[16px] font-semibold text-ink">Origin</h2>
                            </div>
                            <div class="p-5 flex flex-col gap-4">
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
                    <div class="flex flex-col gap-5 h-full">
                        <!-- Action & Disposition -->
                        <div class="card-glass">
                            <div class="px-5 py-4 border-b border-white/30 flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-accent-soft flex items-center justify-center">
                                    <span class="material-symbols-outlined text-accent text-[16px]">call_log</span>
                                </span>
                                <h2 class="font-display text-[16px] font-semibold text-ink">Action &amp; Disposition</h2>
                            </div>
                            <div class="p-5 flex flex-col gap-4">
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
                                <div class="grid grid-cols-2 gap-4">
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
                                <div class="flex gap-3 mt-1">
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

                        <!-- History Log -->
                        <div class="card-glass flex flex-col flex-1 min-h-[260px]">
                            <div class="px-5 py-4 border-b border-white/30 flex justify-between items-center">
                                <h2 class="font-display text-[16px] font-semibold text-ink flex items-center gap-2.5">
                                    <span class="w-7 h-7 rounded-lg bg-white/40 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-ink-muted text-[16px]">history</span>
                                    </span>
                                    History Log
                                </h2>
                                <button class="p-1.5 hover:bg-white/40 rounded-lg text-ink-faint hover:text-ink transition-colors">
                                    <span class="material-symbols-outlined text-[17px]">open_in_new</span>
                                </button>
                            </div>
                            <div class="p-4 flex-1">
                                <textarea class="field w-full h-full min-h-[190px] rounded-lg resize-none p-3 font-mono text-[12px] leading-relaxed bg-white/30" placeholder="History records will appear here..." readonly></textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <!-- Floating Help -->
    <button class="fixed bottom-6 right-6 z-50 bg-navy/85 backdrop-blur-xl text-white p-3.5 rounded-full flex items-center justify-center shadow-2xl transition-all hover:scale-110 border border-white/15">
        <span class="material-symbols-outlined text-[22px]">support_agent</span>
    </button>

</body>

</html>