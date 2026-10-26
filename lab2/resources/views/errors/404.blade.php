<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Сторінку не знайдено | StyleRent</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: #f5f6fa;
            color: #25283a;
            font-family: Arial, sans-serif;
        }

        .error-page {
            width: 100%;
            max-width: 560px;
            text-align: center;
        }

        .error-page__code {
            margin: 0;
            font-size: clamp(100px, 20vw, 180px);
            font-weight: 800;
            line-height: 1;
            color: #6658d3;
        }

        .error-page__title {
            margin: 20px 0 12px;
            font-size: 30px;
        }

        .error-page__description {
            margin: 0 0 32px;
            color: #707487;
            font-size: 17px;
            line-height: 1.6;
        }

        .error-page__button {
            display: inline-block;
            padding: 14px 28px;
            border-radius: 10px;
            background: #6658d3;
            color: white;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s;
        }

        .error-page__button:hover {
            background: #5142b8;
        }
    </style>
</head>

<body>
    <main class="error-page">
        <h1 class="error-page__code">404</h1>

        <h2 class="error-page__title">
            Сторінку не знайдено
        </h2>

        <p class="error-page__description">
            На жаль, сторінка, яку ви шукаєте,
            не існує або була переміщена.
            Поверніться на головну сторінку StyleRent.
        </p>

        <a href="{{ route('home') }}" class="error-page__button">
            На головну
        </a>
    </main>
</body>
</html>
