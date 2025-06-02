<?php

function buildProbabilityMatrix($conn)
{
    // گرفتن همه پست‌ها
    $stmt = $conn->query("SELECT id FROM posts ORDER BY id ASC");
    $posts = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $n = count($posts);
    $A = array_fill(0, $n, array_fill(0, $n, 0));
    $postIndex = array_flip($posts); // [post_id => index]

    // گرفتن همه روابط و بازدیدها
    $related = $conn->query("SELECT * FROM related_posts")->fetchAll(PDO::FETCH_ASSOC);
    $views = $conn->query("SELECT * FROM post_views")->fetchAll(PDO::FETCH_ASSOC);

    // گروه‌بندی بازدیدها بر اساس post_1_id
    $viewMap = [];
    foreach ($views as $v) {
        $viewMap[$v['post_1_id']][$v['post_2_id']] = $v['views'];
    }

    // محاسبه عناصر ماتریس A
    foreach ($related as $rel) {
        $i = $postIndex[$rel['post_1_id']];
        $j = $postIndex[$rel['post_2_id']];
        
        // مجموع بازدیدهای مرتبط با پست i
        $total = 0;
        if (isset($viewMap[$rel['post_1_id']])) {
            foreach ($viewMap[$rel['post_1_id']] as $v) {
                $total += $v;
            }

            if ($total > 0 && isset($viewMap[$rel['post_1_id']][$rel['post_2_id']])) {
                $A[$i][$j] = $viewMap[$rel['post_1_id']][$rel['post_2_id']] / $total;
            }
        }
    }

    return [$A, $posts]; // ماتریس A و لیست پست‌ها به ترتیب
}
function powerIteration($A, $maxIter = 100, $epsilon = 1e-6)
{
    $n = count($A);
    $v = array_fill(0, $n, 1 / sqrt($n)); // بردار اولیه نرمال‌شده

    for ($iter = 0; $iter < $maxIter; $iter++) {
        $v_new = array_fill(0, $n, 0);

        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $v_new[$i] += $A[$i][$j] * $v[$j];
            }
        }

        // نرمال‌سازی
        $norm = sqrt(array_sum(array_map(fn($x) => $x * $x, $v_new)));
        if ($norm == 0) break;

        for ($i = 0; $i < $n; $i++) {
            $v_new[$i] /= $norm;
        }

        // چک برای همگرایی
        $diff = 0;
        for ($i = 0; $i < $n; $i++) {
            $diff += abs($v[$i] - $v_new[$i]);
        }

        if ($diff < $epsilon) break;

        $v = $v_new;
    }

    return $v; // بردار ویژه
}
