<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <style>
        /* استایل‌های کلی */
        body {
            font-family: 'Vazir', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
            color: #333;
        }

        /* استایل‌های هدر */
        header {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            color: #2c3e50;
            margin: 0 0 15px;
        }

        /* استایل‌های نوار ناوبری */
        nav {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        nav a {
            font-size: 1rem;
            color: #3498db;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 6px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        nav a:hover {
            background-color: #3498db;
            color: #ffffff;
        }

        /* استایل متن خوش‌آمدگویی */
        nav span {
            font-size: 1rem;
            color: #2c3e50;
            padding: 8px 12px;
        }

        /* استایل خط جداکننده */
        hr {
            border: none;
            height: 1px;
            background-color: #dcdcdc;
            margin: 20px 0;
        }

        /* پاسخ‌گویی برای صفحه‌نمایش‌های کوچک */
        @media (max-width: 600px) {
            header {
                padding: 15px;
            }

            h1 {
                font-size: 1.5rem;
            }

            nav {
                gap: 10px;
            }

            nav a,
            nav span {
                font-size: 0.9rem;
                padding: 6px 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Task Manager</h1>
        <nav>
            <a href="/taskmanager/front/about">درباره ما</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="/taskmanager/task/index">تسک‌های من</a>
                <span>خوش آمدید، <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="/taskmanager/user/logout">خروج</a>
            <?php else: ?>
                <a href="/taskmanager/user/login">ورود</a>
                <a href="/taskmanager/user/register">ثبت نام</a>
            <?php endif; ?>
        </nav>
        <hr>
    </header>
</body>
</html>