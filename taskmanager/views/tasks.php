<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسک‌های من - Task Manager</title>
    <style>
        /* استایل‌های کلی */
        body {
            font-family: 'Vazir', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
            color: #333;
        }

        /* استایل‌های main */
        main {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: right;
        }

        /* استایل‌های سرتیتر */
        h2 {
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 20px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        /* استایل دکمه افزودن تسک */
        .add-task-btn {
            display: inline-block;
            background-color: #3498db;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1rem;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .add-task-btn:hover {
            background-color: #2980b9;
        }

        /* استایل پیام خالی */
        p.empty {
            font-size: 1.1rem;
            color: #555;
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        /* استایل لیست تسک‌ها */
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            padding: 15px;
            border-bottom: 1px solid #dcdcdc;
            margin-bottom: 10px;
            background-color: #f8f9fa;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        li:last-child {
            border-bottom: none;
        }

        li:hover {
            background-color: #e9ecef;
        }

        li strong {
            font-size: 1.2rem;
            color: #2c3e50;
        }

        li p {
            font-size: 1rem;
            color: #555;
            margin: 8px 0;
            line-height: 1.6;
        }

        li .status {
            font-size: 0.95rem;
            color: #7f8c8d;
        }

        /* استایل لینک‌ها و دکمه‌ها */
        li a, li span {
            font-size: 0.95rem;
            margin-left: 10px;
            text-decoration: none;
        }

        li a.mark-done {
            color: #27ae60;
        }

        li a.mark-done:hover {
            color: #219653;
            text-decoration: underline;
        }

        li span.done {
            color: #27ae60;
        }

        li a.edit {
            color: #3498db;
        }

        li a.edit:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        li a.delete {
            color: #e74c3c;
        }

        li a.delete:hover {
            color: #c0392b;
            text-decoration: underline;
        }

        /* پاسخ‌گویی برای صفحه‌نمایش‌های کوچک */
        @media (max-width: 600px) {
            main {
                margin: 20px;
                padding: 15px;
            }

            h2 {
                font-size: 1.5rem;
            }

            .add-task-btn {
                font-size: 0.9rem;
                padding: 8px 15px;
            }

            li {
                padding: 10px;
            }

            li strong {
                font-size: 1.1rem;
            }

            li p,
            li .status,
            li a,
            li span {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <main>
        <h2>تسک‌های من</h2>
        <a href="index.php?url=task/create" class="add-task-btn">افزودن تسک جدید</a>

        <?php if (empty($tasks)): ?>
            <p class="empty">تسکی یافت نشد.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($tasks as $task): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                        <p><?php echo nl2br(htmlspecialchars($task['description'])); ?></p>
                        <p class="status">وضعیت: <?php echo htmlspecialchars($task['status']); ?></p>

                        <?php if ($task['status'] !== 'done'): ?>
                            <a href="index.php?url=task/markdone&id=<?php echo htmlspecialchars($task['id']); ?>" class="mark-done">✅ انجام شد</a>
                        <?php else: ?>
                            <span class="done">✔ انجام‌شده</span>
                        <?php endif; ?>
                        <a href="index.php?url=task/edit&id=<?php echo htmlspecialchars($task['id']); ?>" class="edit">ویرایش</a>
                        <a href="index.php?url=task/delete&id=<?php echo htmlspecialchars($task['id']); ?>" class="delete" onclick="return confirm('آیا از حذف این تسک مطمئن هستید؟')">حذف</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>
</body>
</html>
