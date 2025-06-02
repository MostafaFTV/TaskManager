<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش تسک</title>
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
            max-width: 600px;
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

        /* استایل پیام خطا */
        .error {
            color: #e74c3c;
            font-size: 1rem;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #fce4e4;
            border-radius: 8px;
            text-align: center;
        }

        /* استایل‌های فرم */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 1.1rem;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s ease;
            font-family: inherit;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            background-color: #3498db;
            color: #ffffff;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* استایل لینک بازگشت */
        .back-link {
            display: inline-block;
            margin-top: 20px;
            font-size: 1rem;
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #2980b9;
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

            input[type="text"],
            textarea,
            button {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <main>
        <h2>ویرایش تسک</h2>

        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" action="/taskmanager/task/edit?id=<?php echo htmlspecialchars($task_to_edit['id']); ?>">
            <label for="title">عنوان تسک:</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($task_to_edit['title']); ?>" required>

            <label for="description">توضیحات:</label>
            <textarea name="description" id="description" rows="5"><?php echo htmlspecialchars($task_to_edit['description']); ?></textarea>

            <button type="submit">ذخیره تغییرات</button>
        </form>
        <p><a href="/taskmanager/task/index" class="back-link">بازگشت به لیست تسک‌ها</a></p>
    </main>
</body>
</html>