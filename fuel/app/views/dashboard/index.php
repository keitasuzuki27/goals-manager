<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goals Manager Dashboard</title>
    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <link rel="stylesheet" href="/assets/css/modal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="sidebar-top">
                <h2>大目標一覧</h2>

                <ul class="goal-menu">
                    <?php foreach ($goals as $goal): ?>
                        <li class="<?= $selected_goal && $selected_goal['id'] == $goal['id'] ? 'active' : '' ?>">
                            <a href="/dashboard?id=<?= $goal['id'] ?>">
                                <?= $goal['title'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <button class="add-goal-button">＋ 新しい大目標を追加</button>
            </div>

            <div class="sidebar-bottom">
                goals manager
            </div>
        </aside>

        <main class="main">

            <!-- update -->
            <div class="top-bar">
                <button type="button" class="icon-button update-goal">
                    <i class="fa-solid fa-pen"></i>
                </button>
                <!-- delete -->

                <button type="button" class="icon-button delete-goal">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>

            <section class="content-card">
                <h1 class="goal-title"><?= $selected_goal['title'] ?></h1>
                <p class="goal-deadline">期限: <?= $selected_goal['deadline'] ?></p>

                <div class="progress-wrapper">
                    <div class="progress-line">
                        <div>
                            <div class="progress-step">1</div>
                        </div>
                        <div>
                            <div class="progress-step">2</div>
                        </div>
                        <div>
                            <div class="progress-step">3</div>
                        </div>
                        <div>
                            <div class="progress-step">4</div>
                        </div>
                        <div>
                            <div class="progress-step">5</div>
                        </div>
                    </div>

                    <div class="progress-labels">
                        <span>10月14日</span>
                        <span>11月26日</span>
                        <span>12月31日</span>
                        <span>2026年2月20日</span>
                        <span>2026年3月15日</span>
                    </div>
                </div>

                <div class="task-list">
                    <div class="task-card">
                        <div class="task-info">
                            <div class="task-title">1. 文法の基礎を学ぶ</div>
                        </div>
                        <button class="complete-button">完了</button>
                    </div>

                    <div class="task-card">
                        <div class="task-info">
                            <div class="task-title">2. YouTube動画を5本見る</div>
                            <div class="task-meta">今日</div>
                        </div>
                        <button class="complete-button">完了</button>
                    </div>

                    <div class="task-card">
                        <div class="task-info">
                            <div class="task-title">3. 小説を3冊読む</div>
                            <div class="task-meta">残り35日</div>
                        </div>
                        <button class="complete-button">完了</button>
                    </div>

                    <div class="task-card">
                        <div class="task-info">
                            <div class="task-title">4. シャドーイング練習</div>
                            <div class="task-meta">残り86日</div>
                        </div>
                        <button class="complete-button">完了</button>
                    </div>

                    <div class="task-card">
                        <div class="task-info">
                            <div class="task-title">5. ネイティブスピーカーと話す</div>
                            <div class="task-meta">残り109日</div>
                        </div>
                        <button class="complete-button">完了</button>
                    </div>

                    <button class="add-task-button">＋ 小タスクを追加</button>
                </div>
            </section>
        </main>
    </div>
    <?php echo View::forge('partials/goal_modal', [
        'goal_modal_id' => 'add-goal-modal',
        'close_goal_modal_id' => 'close-add-goal-modal',
        'modal_title' => '新しい大目標を追加',
        'modal_subtitle' => 'タイトルと締切日を設定します',
        'goal_form_action' => '/goals/create',
        'goal_title_id' => 'add-goal-title',
        'goal_deadline_id' => 'add-goal-deadline',
        'cancel_goal_modal_id' => 'cancel-add-goal-modal',
        'goal' => [],
    ]); ?>
    <?php echo View::forge('partials/goal_modal', [
        'goal_modal_id' => 'update-goal-modal',
        'close_goal_modal_id' => 'close-update-goal-modal',
        'modal_title' => '大目標を編集',
        'modal_subtitle' => 'タイトルと締切日を設定します',
        'goal_form_action' => '/goals/update',
        'goal_title_id' => 'update-goal-title',
        'goal_deadline_id' => 'update-goal-deadline',
        'cancel_goal_modal_id' => 'cancel-update-goal-modal',
        'goal' => $selected_goal,
    ], false); ?>
    <?php echo View::forge('partials/delete_goal_modal', [
        'selected_goal' => $selected_goal,
    ], false); ?>
    <script src="/assets/js/goal_modal.js"></script>
</body>

</html>