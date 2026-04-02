<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goals Manager Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Hiragino Sans", "Hiragino Kaku Gothic ProN", Meiryo, sans-serif;
            background: linear-gradient(135deg, #d9f0ff 0%, #cfe8fb 100%);
            min-height: 100vh;
            color: #2f2f2f;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #5a9b61 0%, #4b8752 100%);
            color: #fff;
            padding: 32px 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.08);
        }

        .sidebar-top h2 {
            font-size: 20px;
            margin-bottom: 28px;
            font-weight: 700;
        }

        .goal-menu {
            list-style: none;
        }

        .goal-menu li {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
        }

        .goal-menu li:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .goal-menu li.active {
            background: rgba(255, 255, 255, 0.18);
            font-weight: 600;
        }

        .add-goal {
            margin-top: 16px;
            padding: 14px 16px;
            border: 1px dashed rgba(255, 255, 255, 0.6);
            border-radius: 12px;
            background: transparent;
            color: #fff;
            font-size: 14px;
            text-align: left;
            cursor: pointer;
        }

        .sidebar-bottom {
            font-size: 13px;
            opacity: 0.85;
        }

        .main {
            flex: 1;
            padding: 48px 56px;
            position: relative;
        }

        .top-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 24px;
        }

        .menu-button {
            border: none;
            background: transparent;
            font-size: 28px;
            color: #666;
            cursor: pointer;
            line-height: 1;
        }

        .content-card {
            max-width: 720px;
            margin: 0 auto;
            text-align: center;
        }

        .goal-title {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 10px;
            color: #222;
        }

        .goal-deadline {
            font-size: 14px;
            color: #666;
            margin-bottom: 36px;
        }

        .progress-wrapper {
            margin-bottom: 34px;
        }

        .progress-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            max-width: 500px;
            margin: 0 auto 12px;
        }

        .progress-line::before {
            content: "";
            position: absolute;
            top: 17px;
            left: 30px;
            right: 30px;
            height: 3px;
            background: #d8b389;
            z-index: 1;
        }

        .progress-step {
            position: relative;
            z-index: 2;
            background: #d68b43;
            color: white;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            margin: 0 auto 8px;
        }

        .progress-labels {
            display: flex;
            justify-content: space-between;
            max-width: 500px;
            margin: 0 auto;
            font-size: 12px;
            color: #7a6b5d;
        }

        .task-list {
            max-width: 520px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .task-card {
            background: #f8ecd9;
            border: 1px solid #d9c2a4;
            border-radius: 12px;
            padding: 16px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: left;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        }

        .task-info {
            flex: 1;
            margin-right: 16px;
        }

        .task-title {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 6px;
            color: #2d2d2d;
        }

        .task-meta {
            font-size: 12px;
            color: #a05f3a;
            font-weight: 600;
        }

        .complete-button {
            min-width: 88px;
            padding: 10px 16px;
            border: 1px solid #caa078;
            border-radius: 10px;
            background: #efdbc2;
            color: #8b5d34;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .add-task-button {
            background: #f8ecd9;
            border: 1px solid #d9c2a4;
            border-radius: 12px;
            padding: 14px;
            font-size: 15px;
            font-weight: 700;
            color: #9b6a3e;
            cursor: pointer;
        }

        .star {
            position: absolute;
            right: 60px;
            bottom: 40px;
            font-size: 36px;
            color: rgba(255, 255, 255, 0.7);
        }

        @media (max-width: 900px) {
            .dashboard {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .main {
                padding: 32px 20px;
            }

            .goal-title {
                font-size: 30px;
            }

            .task-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .complete-button {
                width: 100%;
            }
        }
    </style>
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

            <div class="star">✦</div>
        </main>
    </div>
</body>
</html>