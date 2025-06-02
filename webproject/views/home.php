<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت پست‌ها و کاربران</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <main class="container mx-auto p-6 max-w-5xl">
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- تب‌ها -->
            <div class="flex border-b mb-4">
                <button class="tab-button px-4 py-2 font-medium text-gray-700 border-b-2 border-transparent hover:border-green-600 focus:outline-none active" onclick="openTab('users')">کاربران</button>
                <button class="tab-button px-4 py-2 font-medium text-gray-700 border-b-2 border-transparent hover:border-green-600 focus:outline-none" onclick="openTab('posts')">پست‌ها</button>
                <button class="tab-button px-4 py-2 font-medium text-gray-700 border-b-2 border-transparent hover:border-green-600 focus:outline-none" onclick="openTab('relations')">روابط</button>
                <button class="tab-button px-4 py-2 font-medium text-gray-700 border-b-2 border-transparent hover:border-green-600 focus:outline-none" onclick="openTab('views')">بازدیدها</button>
                <button class="tab-button px-4 py-2 font-medium text-gray-700 border-b-2 border-transparent hover:border-green-600 focus:outline-none" onclick="openTab('ranking')">رتبه‌بندی</button>
            </div>

            <!-- محتوای تب‌ها -->
            <!-- بخش کاربران -->
            <div id="users" class="tab-content active">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">لیست کاربران</h2>
                <?php if (!empty($users)): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="p-3 text-right">نام کاربر</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="p-3 text-gray-700"><?= htmlspecialchars($user['name']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-gray-600">هیچ کاربری یافت نشد.</p>
                <?php endif; ?>
            </div>

            <!-- بخش پست‌ها -->
            <div id="posts" class="tab-content">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">لیست پست‌ها</h2>
                <?php if (!empty($posts)): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="p-3 text-right">عنوان</th>
                                    <th class="p-3 text-right">نویسنده</th>
                                    <th class="p-3 text-right">محتوا</th>
                                    <th class="p-3 text-right">تاریخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($posts as $post): ?>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="p-3 text-gray-800 font-semibold"><?= htmlspecialchars($post['title']) ?></td>
                                        <td class="p-3 text-gray-600"><?= htmlspecialchars($post['author']) ?></td>
                                        <td class="p-3 text-gray-700 italic"><?= nl2br(htmlspecialchars($post['content'])) ?></td>
                                        <td class="p-3 text-gray-500 text-sm"><?= $post['Createdat'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    $totalPages = ceil($totalPosts / $perPage);
                    if ($totalPages > 1):
                    ?>
                    <div class="mt-6 flex justify-center">
                        <p class="text-center">
                            صفحه:
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <a href="?post_page=<?= $i ?>" class="inline-block px-3 py-1 mx-1 bg-blue-500 text-white rounded hover:bg-blue-600"><?= $i ?></a>
                            <?php endfor; ?>
                        </p>
                    </div>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="text-gray-600">هیچ پستی یافت نشد.</p>
                <?php endif; ?>
            </div>

            <!-- بخش روابط بین پست‌ها -->
            <div id="relations" class="tab-content">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">روابط بین پست‌ها</h2>
                <?php if (!empty($relations)): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="p-3 text-right">پست اول</th>
                                    <th class="p-3 text-right">پست دوم</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($relations as $rel): ?>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="p-3 text-gray-700 font-semibold"><?= htmlspecialchars($rel['post1_title']) ?></td>
                                        <td class="p-3 text-gray-700 font-semibold"><?= htmlspecialchars($rel['post2_title']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-gray-600">هنوز هیچ رابطه‌ای بین پست‌ها ثبت نشده است.</p>
                <?php endif; ?>
            </div>

            <!-- بخش تعداد بازدید -->
            <div id="views" class="tab-content">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">تعداد بازدید پست‌ها از طریق پست دیگر</h2>
                <?php if (!empty($postViews)): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="p-3 text-right">پست مقصد</th>
                                    <th class="p-3 text-right">پست مبدا</th>
                                    <th class="p-3 text-right">تعداد بازدید</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($postViews as $v): ?>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="p-3 text-gray-700 font-semibold"><?= htmlspecialchars($v['to_post']) ?></td>
                                        <td class="p-3 text-gray-700 font-semibold"><?= htmlspecialchars($v['from_post']) ?></td>
                                        <td class="p-3 text-gray-700"><?= htmlspecialchars($v['views']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-gray-600">هیچ بازدیدی ثبت نشده است.</p>
                <?php endif; ?>
            </div>

            <!-- بخش رتبه‌بندی -->
            <div id="ranking" class="tab-content">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">رتبه‌بندی پست‌ها بر اساس اهمیت (بردار ویژه)</h2>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-3 text-right">شناسه پست</th>
                                <th class="p-3 text-right">نمره اهمیت</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ranked = [];
                            foreach ($postIDs as $i => $pid) {
                                $ranked[] = ['id' => $pid, 'score' => $importance[$i]];
                            }
                            usort($ranked, fn($a, $b) => $b['score'] <=> $a['score']);
                            foreach ($ranked as $r):
                            ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3 text-gray-700">پست ID <?= $r['id'] ?></td>
                                    <td class="p-3 text-gray-700 font-semibold"><?= round($r['score'], 4) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer class="bg-green-600 text-white p-4 w-full">
        <div class="container mx-auto text-center">
            <p>© 2025 تمامی حقوق محفوظ است.</p>
        </div>
    </footer>
    <script>
        function openTab(tabName) {
            // مخفی کردن تمام تب‌ها
            const tabs = document.getElementsByClassName('tab-content');
            for (let tab of tabs) {
                tab.classList.remove('active');
            }
            // غیرفعال کردن استایل فعال تب‌ها
            const buttons = document.getElementsByClassName('tab-button');
            for (let button of buttons) {
                button.classList.remove('border-green-600', 'text-green-800');
            }
            // نمایش تب انتخاب‌شده و فعال کردن استایل دکمه
            document.getElementById(tabName).classList.add('active');
            event.currentTarget.classList.add('border-green-600', 'text-green-800');
        }
    </script>
</body>
</html>