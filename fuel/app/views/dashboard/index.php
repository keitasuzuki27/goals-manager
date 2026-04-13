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
                    <!-- goals一覧表示 -->
                    <?php foreach ($goals as $goal): ?>
                        <li class="<?= $selected_goal && $selected_goal['id'] == $goal['id'] ? 'active' : '' ?>">
                            <a href="/dashboard?id=<?= $goal['id'] ?>">
                                <?= $goal['title'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- 新規goal作成ボタン -->
                <button class="create-goal-button">＋ 新しい大目標を追加</button>
            </div>

            <div class="sidebar-bottom">
                <div class="sidebar-user">
                    <div class="user-row">
                        <!-- ユーザー名表示 -->
                        <span class="user-name"><?= e($user['name']) ?></span>

                        <!-- ログアウト -->
                        <form method="post" action="/auth/logout">
                            <button type="submit" class="logout-button">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </button>
                        </form>
                    </div>
                </div>
                goals manager
            </div>
        </aside>

        <main class="main">

            <!-- エラーメッセージ表示 -->
            <?php if ($error = Session::get_flash('error')): ?>
                <p class="error"><?= e($error) ?></p>
            <?php endif; ?>

            <?php if ($selected_goal): ?>
                <!-- goal更新・削除ボタン -->
                <div class="top-bar">
                    <button type="button" class="icon-button update-goal-button">
                        <i class="fa-solid fa-pen"></i>
                    </button>

                    <button type="button" class="icon-button delete-goal-button">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>

                <section class="content-card">
                    <!-- goal情報 -->
                    <h1 class="goal-title"><?= $selected_goal['title'] ?></h1>
                    <p class="goal-deadline">期限: <?= $selected_goal['deadline'] ?></p>

                    <!-- 完了タスク数カウント -->
                    <?php $done_count = 0;
                    foreach ($tasks as $task) {
                        if ($task['is_done']) {
                            $done_count++;
                        }
                    } ?>

                    <!-- 進捗バー -->
                    <?php $i = 1; ?>
                    <div class="progress-line" data-goal-id="<?= e($selected_goal['id']) ?>">
                        <?php foreach ($tasks as $task): ?>
                            <div>
                                <div class="progress-step <?= $i <= $done_count ? 'active' : '' ?>">
                                    <?= $i ?>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>

                    <!-- タスク一覧 -->
                    <div class="task-list">
                        <?php foreach ($tasks as $task): ?>
                            <div class="task-card <?= $task['is_done'] ? 'done' : '' ?>">
                                <div class="task-info">
                                    <div class="task-title"><?= $task['title'] ?></div>
                                    <div class="task-meta"><?= $task['deadline'] ?></div>
                                </div>
                                <div class="task-actions">
                                    <!-- タスク完了ボタン（JSで使用） -->
                                    <button
                                        class="complete-button"
                                        data-task-id="<?= e($task['id']) ?>"
                                        data-goal-id="<?= e($selected_goal['id']) ?>">
                                        完了
                                    </button>
                                    <div class="task-edit-delete">
                                        <!-- 編集用データをdata属性で渡す -->
                                        <button
                                            class="update-task-button"
                                            type="button"
                                            data-task-id="<?= $task['id'] ?>"
                                            data-task-title="<?= $task['title'] ?>"
                                            data-task-deadline="<?= $task['deadline'] ?>">
                                            編集
                                        </button>

                                        <!-- 削除用データ -->
                                        <button
                                            class="delete-task-button"
                                            type="button"
                                            data-task-id="<?= $task['id'] ?>"
                                            data-task-title="<?= $task['title'] ?>">
                                            削除
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- タスク作成 -->
                        <button class="create-task-button">＋ 小タスクを追加</button>
                    </div>
                </section>
            <?php endif; ?>
        </main>
    </div>
    <!-- Goal新規作成モーダル -->
    <?php echo View::forge('partials/goal_modal', [
        'goal_modal_id' => 'create-goal-modal',
        'close_goal_modal_id' => 'close-create-goal-modal',
        'modal_title' => '新しい大目標を追加',
        'modal_subtitle' => 'タイトルと締切日を設定します',
        'goal_form_action' => '/goals/create',
        'goal_title_id' => 'create-goal-title',
        'goal_deadline_id' => 'create-goal-deadline',
        'cancel_goal_modal_id' => 'cancel-create-goal-modal',
        'goal' => [],
        'user' => $user,
    ]); ?>
    <!-- Goal編集モーダル -->
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
    <!-- Goal消去モーダル -->
    <?php echo View::forge('partials/delete_goal_modal', [
        'goal' => $selected_goal,
    ], false); ?>

    <!-- Task新規作成モーダル -->
    <?php echo View::forge('partials/task_modal', [
        'task_modal_id' => 'create-task-modal',
        'close_task_modal_id' => 'close-create-task-modal',
        'modal_title' => '新しいタスクを追加',
        'modal_subtitle' => 'タイトルと締切日を設定します',
        'task_form_action' => '/tasks/create',
        'task_title_id' => 'create-task-title',
        'task_deadline_id' => 'create-task-deadline',
        'hidden_input_id' =>  '',
        'cancel_task_modal_id' => 'cancel-create-task-modal',
        'goal' => $selected_goal,
    ], false); ?>
    <!-- Task編集モーダル -->
    <?php echo View::forge('partials/task_modal', [
        'task_modal_id' => 'update-task-modal',
        'close_task_modal_id' => 'close-update-task-modal',
        'modal_title' => 'タスクを編集',
        'modal_subtitle' => 'タイトルと締切日を設定します',
        'task_form_action' => '/tasks/update',
        'task_title_id' => 'update-task-title',
        'task_deadline_id' => 'update-task-deadline',
        'hidden_input_id' =>  'update-task-id',
        'cancel_task_modal_id' => 'cancel-update-task-modal',
        'goal' => $selected_goal,
    ], false); ?>
    <!-- Task消去モーダル -->
    <?php echo View::forge('partials/delete_task_modal', [
        'goal' => $selected_goal,
    ], false); ?>
    <!-- JS読み込み(モーダルの開閉処理) -->
    <script src="/assets/js/goal_modal.js"></script>
    <script src="/assets/js/task_modal.js"></script>
    <script src="/assets/js/task_toggle.js"></script>
</body>

</html>