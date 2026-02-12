<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Absensi BillMan') }}</title>

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ===== MODERN GUEST LAYOUT STYLES ===== */
        /* Premium Gradient - Blue Kuning */
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
            background: linear-gradient(145deg, #0B2D45 0%, #155E76 40%, #1A7A8C 100%);
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background Pattern */
        .bg-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.1;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.2'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Glassmorphism Container - Premium */
        .glass-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 
                0 25px 40px -15px rgba(0, 0, 0, 0.2),
                0 0 0 1px rgba(255, 255, 255, 0.2) inset;
            border-radius: 32px;
            padding: 2rem;
        }

        /* Logo Container - Blue Kuning */
        .logo-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 88px;
            height: 88px;
            background: linear-gradient(145deg, #FFFFFF, #F8FAFC);
            border-radius: 28px;
            box-shadow: 
                0 15px 30px -8px rgba(11,45,69,0.2),
                0 0 0 1px rgba(255,255,255,0.6) inset;
            margin-bottom: 1.5rem;
            transform: rotate(-2deg);
            transition: all 0.3s ease;
        }

        .logo-container:hover {
            transform: rotate(0deg) scale(1.05);
            box-shadow: 0 20px 35px -10px rgba(250,204,21,0.3);
        }

        /* App Name Gradient - Blue Kuning */
        .app-name {
            font-size: 1.875rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            background: linear-gradient(135deg, #0B2D45 0%, #155E76 50%, #1A7A8C 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-top: 0.5rem;
        }

        .app-name span {
            background: linear-gradient(135deg, #F59E0B, #FBBF24);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Welcome Subtext */
        .welcome-text {
            font-size: 0.875rem;
            color: #64748B;
            margin-top: 0.5rem;
            font-weight: 500;
            letter-spacing: 0.025em;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .welcome-text i {
            color: #FBBF24;
            font-size: 0.75rem;
        }

        /* Card Inner - Premium Glass */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 2rem;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px -6px rgba(0,0,0,0.05);
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.8);
            border-color: rgba(251, 191, 36, 0.3);
            box-shadow: 0 15px 30px -10px rgba(251,191,36,0.1);
        }

        /* Modern Input - Blue Kuning */
        .modern-input {
            width: 100%;
            padding: 0.875rem 1.25rem;
            background: white;
            border: 1.5px solid #E2E8F0;
            border-radius: 20px;
            font-size: 0.95rem;
            color: #1E293B;
            transition: all 0.25s ease;
            outline: none;
        }

        .modern-input:focus {
            border-color: #FBBF24;
            background: white;
            box-shadow: 0 0 0 4px rgba(251, 191, 36, 0.15);
        }

        .modern-input:hover {
            border-color: #F59E0B;
        }

        .modern-input::placeholder {
            color: #94A3B8;
            font-weight: 300;
        }

        /* Input Icon Wrapper */
        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 1.25rem;
            color: #94A3B8;
            font-size: 1rem;
            transition: color 0.2s ease;
        }

        .input-icon-right {
            position: absolute;
            right: 1.25rem;
            color: #94A3B8;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .input-icon-right:hover {
            color: #F59E0B;
        }

        .modern-input-with-icon {
            padding-left: 3rem;
        }

        /* Modern Button - Blue Kuning Gradient */
        .btn-modern {
            width: 100%;
            background: linear-gradient(145deg, #155E76, #0B2D45);
            color: white;
            font-weight: 600;
            padding: 0.875rem 1.75rem;
            border-radius: 40px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px -8px rgba(11,45,69,0.3);
            letter-spacing: 0.3px;
            font-size: 0.95rem;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .btn-modern i {
            color: #FBBF24;
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(251, 191, 36, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-modern:hover {
            background: linear-gradient(145deg, #1A7A8C, #155E76);
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -8px rgba(11,45,69,0.4);
        }

        .btn-modern:hover i {
            transform: translateX(4px);
            color: #FCD34D;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        .btn-modern:active {
            transform: translateY(0);
        }

        /* Link Modern */
        .link-modern {
            color: #155E76;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            transition: all 0.2s ease;
        }

        .link-modern i {
            font-size: 0.75rem;
            transition: transform 0.2s ease;
        }

        .link-modern:hover {
            color: #F59E0B;
        }

        .link-modern:hover i {
            transform: translateX(4px);
        }

        /* Checkbox Modern */
        .checkbox-modern {
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 6px;
            border: 2px solid #CBD5E1;
            accent-color: #FBBF24;
            transition: all 0.15s ease;
            cursor: pointer;
        }

        .checkbox-modern:checked {
            background-color: #FBBF24;
            border-color: #FBBF24;
        }

        .checkbox-modern:focus {
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.2);
        }

        /* Alert Modern */
        .alert-modern {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-left: 4px solid;
            border-radius: 16px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .alert-success {
            border-left-color: #10B981;
            background: rgba(16, 185, 129, 0.1);
            color: #065F46;
        }

        .alert-error {
            border-left-color: #EF4444;
            background: rgba(239, 68, 68, 0.1);
            color: #B91C1C;
        }

        /* Error Message */
        .error-message-modern {
            background: rgba(239, 68, 68, 0.08);
            border-radius: 14px;
            padding: 0.75rem 1rem;
            margin-top: 0.5rem;
            font-size: 0.85rem;
            color: #B91C1C;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        /* Divider */
        .divider-modern {
            display: flex;
            align-items: center;
            text-align: center;
            color: #94A3B8;
            font-size: 0.8rem;
            margin: 1.5rem 0;
        }

        .divider-modern::before,
        .divider-modern::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #E2E8F0;
        }

        .divider-modern::before {
            margin-right: 1rem;
        }

        .divider-modern::after {
            margin-left: 1rem;
        }

        /* Floating Bubbles */
        .floating-bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(251, 191, 36, 0.05);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(251, 191, 36, 0.1);
            pointer-events: none;
            z-index: 0;
        }

        .bubble-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            right: -100px;
            background: radial-gradient(circle, rgba(251,191,36,0.1) 0%, rgba(11,45,69,0.05) 100%);
        }

        .bubble-2 {
            width: 400px;
            height: 400px;
            bottom: -200px;
            left: -150px;
            background: radial-gradient(circle, rgba(251,191,36,0.08) 0%, rgba(21,94,118,0.03) 100%);
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 0.6s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .glass-container {
                padding: 1.5rem !important;
                margin: 1rem;
                border-radius: 24px;
            }
            
            .glass-card {
                padding: 1.5rem !important;
            }
            
            .logo-container {
                width: 72px;
                height: 72px;
            }
            
            .app-name {
                font-size: 1.5rem;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }

        ::-webkit-scrollbar-thumb {
            background: #155E76;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #1A7A8C;
        }
    </style>
</head>
<body class="font-sans antialiased relative min-h-screen overflow-x-hidden">

    <!-- Background Pattern -->
    <div class="bg-pattern"></div>
    
    <!-- Floating Background Decorations -->
    <div class="floating-bubble bubble-1 animate-pulse"></div>
    <div class="floating-bubble bubble-2 animate-pulse" style="animation-delay: 2s;"></div>

    <!-- Main Container -->
    <div class="relative z-10 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4 sm:px-6 lg:px-8">
        
        <!-- Glass Container Utama -->
        <div class="glass-container w-full sm:max-w-md md:max-w-lg fade-in">
            
            <!-- Logo Section -->
            <div class="flex flex-col items-center">
                <div class="logo-container">
                    <a href="/" class="flex items-center justify-center w-full h-full">
                        <i class="fas fa-bolt text-4xl text-[#155E76]"></i>
                    </a>
                </div>
                
                <!-- App Name dengan Blue Kuning -->
                <h2 class="app-name">
                    Absensi<span>Billman</span>
                </h2>
                
                <!-- Welcome Subtext -->
                <div class="welcome-text">
                    <i class="fas fa-circle text-[6px]"></i>
                    Selamat Datang! Silahkan masuk
                    <i class="fas fa-circle text-[6px]"></i>
                </div>
            </div>

            <!-- Content Card -->
            <div class="glass-card mt-8">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-xs text-gray-400 font-medium tracking-wider">
                    © {{ date('Y') }} Absensi<span class="text-[#155E76] font-semibold">Billman</span>
                </p>
                <p class="text-[10px] text-gray-400 mt-1"></p>
            </div>
        </div>
    </div>

    <!-- Password Toggle Helper -->
    <script>
        window.togglePassword = function(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input && icon) {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            }
        };

        // Fade In Animation
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.glass-container');
            if (container) {
                container.classList.add('fade-in');
            }
        });
    </script>

</body>
</html>