<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فوتر Task Manager</title>
    <style>
        /* استایل‌های کلی */
        body {
            font-family: 'Vazir', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
            color: #333;
        }

        /* استایل خط جداکننده */
        hr {
            border: none;
            height: 1px;
            background-color: #dcdcdc;
            margin: 40px 0;
        }

        /* استایل‌های فوتر */
        footer {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            background-color: #ffffff;
            border-top: 2px solid #3498db;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.05);
        }

        footer p {
            font-size: 1rem;
            color: #2c3e50;
            margin: 0;
        }

        /* پاسخ‌گویی برای صفحه‌نمایش‌های کوچک */
        @media (max-width: 600px) {
            footer {
                padding: 15px;
            }

            footer p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <hr>
    <footer>
        <p>© <?php echo date("Y"); ?> Task Manager</p>
    </footer>
</body>
</html>