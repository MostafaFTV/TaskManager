<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-green-600 text-white p-4 shadow-md w-full">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">داشبورد</h1>
        </div>
    </header>
    <main class="container mx-auto p-6 max-w-4xl mt-4">
        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">خوش آمدید</h2>
            <p class="text-gray-700 text-lg">سلام <?= htmlspecialchars($_SESSION['user']['name']) ?> 👋</p>
            <p class="text-gray-600">ایمیل شما: <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
            <a href="/webproject/add_post" class="inline-block mt-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                ➕ افزودن پست جدید
            </a>
        </section>

        <section class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">پست‌های شما</h2>
            <?php if (!empty($posts)): ?>
                <ul class="space-y-4">
                    <?php foreach ($posts as $post): ?>
                        <li class="border-b pb-4">
                            <strong class="text-lg text-gray-800"><?= htmlspecialchars($post['title']) ?></strong>
                            <p class="text-gray-700 mt-2"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                            <p class="text-sm text-gray-500 mt-2">تاریخ: <?= $post['Createdat'] ?></p>
                            <div class="mt-2 space-x-2 space-x-reverse">
                                <a href="/webproject/edit_post?id=<?= $post['id'] ?>" class="text-blue-600 hover:underline">✏️ ویرایش</a>
                                <a href="/webproject/delete_post?id=<?= $post['id'] ?>" onclick="return confirm('آیا مطمئنی؟');" class="text-red-600 hover:underline">🗑️ حذف</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-gray-600">شما هنوز پستی ایجاد نکرده‌اید.</p>
            <?php endif; ?>
        </section>
    </main>
    <footer class="bg-green-600 text-white p-4 w-full">
        <div class="container mx-auto text-center">
            <p>© 2025 تمامی حقوق محفوظ است.</p>
        </div>
    </footer>
</body>
</html>