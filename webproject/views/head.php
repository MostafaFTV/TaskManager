<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سایت تحلیل پست‌ها</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-green-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">تحلیل پست‌های کاربران</h1>
            <nav class="space-x-4 space-x-reverse">
                <a href="/webproject/home" class="hover:text-gray-200">خانه</a>
                <a href="/webproject/about" class="hover:text-gray-200">درباره</a>
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="/webproject/dashboard" class="hover:text-gray-200">داشبورد</a>
                    <a href="/webproject/logout" class="hover:text-gray-200">خروج</a>
                <?php else: ?>
                    <a href="/webproject/login" class="hover:text-gray-200">ورود</a>
                    <a href="/webproject/register" class="hover:text-gray-200">ثبت‌نام</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container mx-auto p-4">
        <!-- Content placeholder for main content -->
    </main>
</body>
</html>