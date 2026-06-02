<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="English Club Voting System — Choose your next leader">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'English Club Voting')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Baloo 2', Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0097b2 0%, #00abc9 50%, #00c4d6 100%);
            color: #fafafa;
            overflow-x: hidden;
        }

        /* Hero Section */
        .hero {
            background: transparent;
            color: #fafafa;
            padding: 80px 0;
            text-align: center;
            position: relative;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 800;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }

        .hero p {
            font-size: 1.2rem;
            margin-top: 10px;
            position: relative;
            z-index: 1;
            opacity: 0.95;
        }

        /* Glass Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
        }

        .glass-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .glass-card img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .glass-card:hover img {
            transform: scale(1.02);
        }

        .glass-card .card-info {
            padding: 20px;
        }

        .glass-card .card-info h5 {
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 4px;
        }

        .glass-card .card-info p {
            opacity: 0.8;
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        .glass-card .card-action {
            padding: 0 20px 20px;
        }

        /* Buttons */
        .btn-vote {
            background: linear-gradient(135deg, #ffffff 0%, #e8f8fa 100%);
            color: #0097b2;
            border: none;
            border-radius: 12px;
            padding: 10px 24px;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
        }

        .btn-vote:hover {
            background: #ffffff;
            color: #007a93;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(255, 255, 255, 0.2);
        }

        .btn-hero {
            background: rgba(255, 255, 255, 0.95);
            color: #0097b2;
            border: none;
            border-radius: 50px;
            padding: 14px 40px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-hero:hover {
            background: #ffffff;
            color: #007a93;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .status-badge.not-started {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.4);
        }

        .status-badge.started {
            background: rgba(40, 167, 69, 0.2);
            color: #6dff9a;
            border: 1px solid rgba(40, 167, 69, 0.4);
        }

        .status-badge.closed {
            background: rgba(220, 53, 69, 0.2);
            color: #ff6b7a;
            border: 1px solid rgba(220, 53, 69, 0.4);
        }

        /* Winner Crown */
        .winner-card {
            position: relative;
        }

        .winner-card .crown-badge {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            background: linear-gradient(135deg, #ffd700, #ffaa00);
            color: #fff;
            padding: 6px 18px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
        }

        .winner-card.president {
            border: 2px solid rgba(255, 215, 0, 0.6);
        }

        .winner-card.vice-president {
            border: 2px solid rgba(192, 192, 192, 0.6);
        }

        .winner-card.vice-president .crown-badge {
            background: linear-gradient(135deg, #c0c0c0, #a0a0a0);
        }

        /* Fade In Animation */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up:nth-child(1) { animation-delay: 0.1s; }
        .fade-in-up:nth-child(2) { animation-delay: 0.2s; }
        .fade-in-up:nth-child(3) { animation-delay: 0.3s; }
        .fade-in-up:nth-child(4) { animation-delay: 0.4s; }
        .fade-in-up:nth-child(5) { animation-delay: 0.5s; }
        .fade-in-up:nth-child(6) { animation-delay: 0.6s; }

        /* Vote Count Bar */
        .vote-bar-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            height: 8px;
            overflow: hidden;
            margin-top: 8px;
        }

        .vote-bar {
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(90deg, #ffd700, #ffaa00);
            transition: width 1s ease;
        }

        /* Footer */
        .footer-text {
            text-align: center;
            padding: 30px 0;
            opacity: 0.6;
            font-size: 0.85rem;
        }

        @yield('extra-styles')
    </style>
</head>

<body>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    @yield('scripts')
</body>

</html>
