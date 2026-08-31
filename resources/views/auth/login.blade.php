<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | CRM Portal</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #3b82f6;

            --bg-dark: #020617;
            --bg-card: rgba(15, 23, 42, 0.88);

            --border: rgba(148, 163, 184, 0.18);
            --input-bg: rgba(2, 6, 23, 0.65);

            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;

            --danger: #f87171;
            --success: #4ade80;
        }

        body {
            min-height: 100vh;
            font-family:
                Inter,
                "Segoe UI",
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                sans-serif;

            background:
                radial-gradient(circle at top left,
                    rgba(37, 99, 235, 0.18),
                    transparent 30%),
                radial-gradient(circle at bottom right,
                    rgba(59, 130, 246, 0.12),
                    transparent 30%),
                #020617;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 20px;

            color: var(--text-primary);
        }

        /* Background decoration */

        body::before,
        body::after {
            content: "";

            position: fixed;

            width: 350px;
            height: 350px;

            border-radius: 50%;

            filter: blur(100px);

            z-index: -1;
        }

        body::before {
            background: rgba(37, 99, 235, 0.18);

            top: -120px;
            left: -120px;
        }

        body::after {
            background: rgba(14, 165, 233, 0.12);

            bottom: -120px;
            right: -120px;
        }

        /* Main container */

        .login-wrapper {
            width: 100%;
            max-width: 440px;
        }

        .login-container {
            background: var(--bg-card);

            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);

            border: 1px solid var(--border);

            border-radius: 22px;

            padding: 42px 38px;

            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.45),
                inset 0 1px 0 rgba(255, 255, 255, 0.04);

            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Logo */

        .logo {
            text-align: center;
            margin-bottom: 34px;
        }

        .logo-icon {
            width: 64px;
            height: 64px;

            margin: 0 auto 16px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 18px;

            background:
                linear-gradient(135deg,
                    var(--primary-light),
                    var(--primary-dark));

            box-shadow:
                0 12px 30px rgba(37, 99, 235, 0.4);
        }

        .logo-icon svg {
            width: 30px;
            height: 30px;

            fill: white;
        }

        .logo h1 {
            font-size: 25px;
            font-weight: 700;

            letter-spacing: -0.5px;

            color: var(--text-primary);
        }

        .logo p {
            margin-top: 7px;

            font-size: 14px;

            color: var(--text-secondary);
        }

        /* Alerts */

        .alert {
            padding: 13px 15px;

            margin-bottom: 20px;

            border-radius: 10px;

            font-size: 13px;

            display: flex;
            align-items: center;

            gap: 8px;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);

            border: 1px solid rgba(34, 197, 94, 0.2);

            color: #86efac;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);

            border: 1px solid rgba(239, 68, 68, 0.2);

            color: #fca5a5;
        }

        /* Form */

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;

            margin-bottom: 8px;

            font-size: 13px;
            font-weight: 600;

            color: #cbd5e1;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;

            height: 50px;

            padding: 0 45px 0 45px;

            border-radius: 12px;

            border: 1px solid #334155;

            background: var(--input-bg);

            color: #f8fafc;

            font-size: 14px;

            outline: none;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .input-wrapper input::placeholder {
            color: #64748b;
        }

        .input-wrapper input:hover {
            border-color: #475569;
        }

        .input-wrapper input:focus {
            border-color: var(--primary-light);

            background: rgba(2, 6, 23, 0.9);

            box-shadow:
                0 0 0 4px rgba(59, 130, 246, 0.12);
        }

        .input-error {
            border-color: #ef4444 !important;
        }

        /* Input icons */

        .input-icon {
            position: absolute;

            left: 15px;
            top: 50%;

            transform: translateY(-50%);

            width: 19px;
            height: 19px;

            fill: #64748b;

            pointer-events: none;
        }

        /* Password toggle */

        .password-toggle {
            position: absolute;

            right: 14px;
            top: 50%;

            transform: translateY(-50%);

            width: 34px;
            height: 34px;

            border: none;

            background: transparent;

            color: #64748b;

            cursor: pointer;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;

            transition: 0.2s;
        }

        .password-toggle:hover {
            color: #cbd5e1;

            background: rgba(148, 163, 184, 0.08);
        }

        .password-toggle svg {
            width: 19px;
            height: 19px;

            fill: currentColor;
        }

        /* Validation error */

        .error-message {
            display: block;

            margin-top: 7px;

            font-size: 12px;

            color: var(--danger);
        }

        /* Options */

        .options {
            display: flex;

            align-items: center;
            justify-content: space-between;

            margin-top: 4px;
            margin-bottom: 24px;
        }

        .remember {
            display: flex;

            align-items: center;

            gap: 8px;

            font-size: 13px;

            color: var(--text-secondary);

            cursor: pointer;
        }

        .remember input {
            width: 16px;
            height: 16px;

            accent-color: var(--primary);

            cursor: pointer;
        }

        .forgot {
            font-size: 13px;

            color: #60a5fa;

            text-decoration: none;

            font-weight: 500;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        /* Login button */

        .btn-login {
            width: 100%;

            height: 50px;

            border: none;

            border-radius: 12px;

            background:
                linear-gradient(135deg,
                    var(--primary-light),
                    var(--primary-dark));

            color: white;

            font-size: 14px;
            font-weight: 600;

            cursor: pointer;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 10px;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                opacity 0.2s ease;

            box-shadow:
                0 8px 22px rgba(37, 99, 235, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 28px rgba(37, 99, 235, 0.45);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            cursor: not-allowed;

            opacity: 0.7;

            transform: none;
        }

        /* Loading spinner */

        .spinner {
            width: 18px;
            height: 18px;

            border: 2px solid rgba(255, 255, 255, 0.35);

            border-top-color: white;

            border-radius: 50%;

            animation: spin 0.7s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Divider */

        .divider {
            display: flex;

            align-items: center;

            gap: 14px;

            margin: 28px 0;

            color: #64748b;

            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: "";

            flex: 1;

            height: 1px;

            background: #334155;
        }

        /* Google */

        .btn-google {
            width: 100%;

            height: 50px;

            border-radius: 12px;

            border: 1px solid #334155;

            background: rgba(255, 255, 255, 0.04);

            color: #e2e8f0;

            font-size: 14px;
            font-weight: 500;

            cursor: pointer;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 12px;

            transition:
                background 0.2s,
                border-color 0.2s;
        }

        .btn-google:hover {
            background: rgba(255, 255, 255, 0.08);

            border-color: #475569;
        }

        .btn-google svg {
            width: 20px;
            height: 20px;
        }

        /* Footer */

        .footer {
            text-align: center;

            margin-top: 30px;

            font-size: 12px;

            color: #64748b;
        }

        .footer a {
            color: #60a5fa;

            text-decoration: none;

            font-weight: 500;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsive */

        @media (max-width: 480px) {

            body {
                padding: 15px;
            }

            .login-container {
                padding: 32px 22px;

                border-radius: 18px;
            }

            .logo {
                margin-bottom: 28px;
            }

            .options {
                flex-direction: column;

                align-items: flex-start;

                gap: 12px;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <div class="login-container">

            <!-- Logo -->

            <div class="logo">

                <div class="logo-icon">

                    <svg viewBox="0 0 24 24">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12
                        s4.48 10 10 10 10-4.48 10-10
                        S17.52 2 12 2zm0 18
                        c-4.41 0-8-3.59-8-8s3.59-8 8-8
                        8 3.59 8 8-3.59 8-8 8z" />
                        <path
                            d="M7 12h10v2H7z" />
                    </svg>

                </div>

                <h1>Welcome Back</h1>

                <p>
                    Sign in to access your CRM dashboard
                </p>

            </div>


            <!-- Success Message -->

            @if(session('success'))

            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>

            @endif


            <!-- Error Message -->

            @if(session('error'))

            <div class="alert alert-danger">
                ⚠ {{ session('error') }}
            </div>

            @endif


            <!-- Login Form -->

            <form
                action="{{ route('login.submit') }}"
                method="POST"
                id="loginForm"
                autocomplete="off">

                @csrf


                <!-- Email -->

                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <div class="input-wrapper">

                        <svg
                            class="input-icon"
                            viewBox="0 0 24 24">
                            <path
                                d="M20 4H4
                            c-1.1 0-2 .9-2 2v12
                            c0 1.1.9 2 2 2h16
                            c1.1 0 2-.9 2-2V6
                            c0-1.1-.9-2-2-2zm0 4
                            -8 5-8-5V6l8 5 8-5v2z" />
                        </svg>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@company.com"
                            autocomplete="email"
                            required

                            @error('email')
                            class="input-error"
                            @enderror>

                    </div>

                    @error('email')

                    <span class="error-message">
                        {{ $message }}
                    </span>

                    @enderror

                </div>


                <!-- Password -->

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="input-wrapper">

                        <svg
                            class="input-icon"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 1
                            C8.69 1 6 3.69 6 7v2H5
                            c-1.1 0-2 .9-2 2v9
                            c0 1.1.9 2 2 2h14
                            c1.1 0 2-.9 2-2v-9
                            c0-1.1-.9-2-2-2h-1V7
                            c0-3.31-2.69-6-6-6zm-4 8V7
                            c0-2.21 1.79-4 4-4
                            s4 1.79 4 4v2H8zm4 8
                            c-1.1 0-2-.9-2-2
                            s.9-2 2-2 2 .9 2 2
                            -.9 2-2 2z" />
                        </svg>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required

                            @error('password')
                            class="input-error"
                            @enderror>


                        <button
                            type="button"
                            class="password-toggle"
                            id="passwordToggle">

                            <svg
                                id="eyeIcon"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 5
                                c-7 0-11 7-11 7
                                s4 7 11 7 11-7 11-7
                                -4-7-11-7zm0 12
                                a5 5 0 1 1 0-10
                                5 5 0 0 1 0 10zm0-8
                                a3 3 0 1 0 0 6
                                3 3 0 0 0 0-6z" />
                            </svg>

                        </button>

                    </div>

                    @error('password')

                    <span class="error-message">
                        {{ $message }}
                    </span>

                    @enderror

                </div>


                <!-- Remember -->

                <div class="options">

                    <label class="remember">

                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <span>
                            Remember me
                        </span>

                    </label>


                    {{-- Uncomment when forgot password route is ready --}}

                    {{--
                <a
                    href="{{ route('password.request') }}"
                    class="forgot"
                    >
                    Forgot password?
                    </a>
                    --}}

                </div>


                <!-- Login Button -->

                <button
                    type="submit"
                    class="btn-login"
                    id="loginButton">

                    <span id="buttonText">
                        Sign In
                    </span>

                </button>

            </form>


            <!-- Divider -->

            <div class="divider">
                <span>
                    OR CONTINUE WITH
                </span>
            </div>


            <!-- Google Login -->

            <button
                type="button"
                class="btn-google"
                onclick="window.location.href='#'">

                <svg
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">

                    <path
                        d="M22.56 12.25
                    c0-.78-.07-1.53-.2-2.25H12
                    v4.26h5.92
                    c-.26 1.37-1.04 2.53-2.21 3.31
                    v2.77h3.57
                    c2.08-1.92 3.28-4.74 3.28-8.09z"
                        fill="#4285F4" />

                    <path
                        d="M12 23
                    c2.97 0 5.46-.98 7.28-2.66
                    l-3.57-2.77
                    c-.98.66-2.23 1.06-3.71 1.06
                    -2.86 0-5.29-1.93-6.16-4.53
                    H2.18v2.84
                    C3.99 20.53 7.7 23 12 23z"
                        fill="#34A853" />

                    <path
                        d="M5.84 14.09
                    c-.22-.66-.35-1.36-.35-2.09
                    s.13-1.43.35-2.09
                    V7.07H2.18
                    C1.43 8.55 1 10.22 1 12
                    s.43 3.45 1.18 4.93
                    l2.85-2.22.81-.62z"
                        fill="#FBBC05" />

                    <path
                        d="M12 5.38
                    c1.62 0 3.06.56 4.21 1.64
                    l3.15-3.15
                    C17.45 2.09 14.97 1 12 1
                    7.7 1 3.99 3.47 2.18 7.07
                    l3.66 2.84
                    c.87-2.6 3.3-4.53 6.16-4.53z"
                        fill="#EA4335" />

                </svg>

                Continue with Google

            </button>


            <!-- Footer -->

            <div class="footer">

                Secure access to your organization CRM

            </div>

        </div>

    </div>


    <script>
        /*
    |--------------------------------------------------------------------------
    | Show / Hide Password
    |--------------------------------------------------------------------------
    */

        const passwordInput =
            document.getElementById('password');

        const passwordToggle =
            document.getElementById('passwordToggle');


        passwordToggle.addEventListener(
            'click',
            function() {

                const isPassword =
                    passwordInput.type === 'password';


                passwordInput.type =
                    isPassword ?
                    'text' :
                    'password';

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Login Loading State
        |--------------------------------------------------------------------------
        */

        const loginForm =
            document.getElementById('loginForm');


        const loginButton =
            document.getElementById('loginButton');


        const buttonText =
            document.getElementById('buttonText');


        loginForm.addEventListener(
            'submit',
            function() {

                if (!loginForm.checkValidity()) {
                    return;
                }


                loginButton.disabled = true;


                buttonText.innerHTML =
                    `
                <span class="spinner"></span>
                Signing in...
                `;

            }
        );
    </script>

</body>

</html>