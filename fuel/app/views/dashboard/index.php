<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goals Manager Dashboard</title>
    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <link rel="stylesheet" href="/assets/css/modal.css">
</head>

<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="sidebar-top">
                <h2>大目標一覧</h2>

                <ul class="goal-menu">
                    <li class="active">🇪🇸 スペイン語を学ぶ</li>
                    <li>👟 フルマラソン完走</li>
                    <li>🪴 家庭菜園を始める</li>
                </ul>

                <button class="add-goal">＋ 新しい大目標を追加</button>
            </div>

            <div class="sidebar-bottom">
                goals manager
            </div>
        </aside>

        <main class="main">
            <div class="top-bar">
                <button class="menu-button">⋮</button>
            </div>

            <section class="content-card">
                <h1 class="goal-title">🇪🇸 スペイン語を学ぶ</h1>
                <p class="goal-deadline">期限: 2026年11月24日</p>

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
    <?php echo View::forge('partials/goal_modal'); ?>
    <script src="/assets/js/modal.js"></script>
</body>

</html>