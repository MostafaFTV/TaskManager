<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت‌نام کاربر جدید</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <main class="container mx-auto p-6 max-w-md">
        <section class="bg-white rounded-lg shadow-md p-6">
            <?php if (!empty($error)): ?>
                <p class="text-red-500 text-center mb-4"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">ثبت‌نام کاربر جدید</h2>
            <form method="POST" action="/webproject/register" class="space-y-6">
                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">نام:</label>
                    <input type="text" name="name" id="name" required
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">ایمیل:</label>
                    <input type="email" name="email" id="email" required
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-2">رمز عبور:</label>
                    <input type="password" name="password" id="password" required
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <button type="submit"
                            class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition duration-300">
                        ثبت‌نام
                    </button>
                </div>
            </form>
        </section>
    </main>
    <footer class="bg-green-600 text-white p-4 w-full">
        <div class="container mx-auto text-center">
            <p>© 2025 تمامی حقوق محفوظ است.</p>
        </div>
    </footer>
</body>
</html>