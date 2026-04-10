<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>新規登録 | goals manager</title>
  <link rel="stylesheet" href="/assets/css/register.css" />
</head>
<body>
  <div class="register-layout">
    <aside class="register-sidebar">
      <div class="sidebar-inner">
        <h1 class="logo">goals manager</h1>
        <p class="sidebar-title">目標を整理して、<br>一歩ずつ進める</p>
        <p class="sidebar-text">
          大きな目標を小さな行動に分解して、
          毎日の進捗を見える化しましょう。
        </p>
      </div>
    </aside>

    <main class="register-main">
      <div class="register-card">
        <div class="register-header">
          <h2>新規アカウント作成</h2>
        </div>

        <form class="register-form" action="/register/create" method="post">
          <div class="form-group">
            <label for="name">ユーザー名</label>
            <input
              type="text"
              id="name"
              name="name"
              placeholder="例: Taro"
            >
          </div>

          <div class="form-group">
            <label for="email">メールアドレス</label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="example@email.com"
            >
          </div>

          <div class="form-group">
            <label for="password">パスワード</label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="8文字以上で入力"
            >
          </div>

          <!-- <div class="form-group">
            <label for="password_confirm">パスワード（確認）</label>
            <input
              type="password"
              id="password_confirm"
              name="password_confirm"
              placeholder="もう一度入力"
            >
          </div> -->

          <button type="submit" class="register-button">アカウントを作成</button>
        </form>

        <p class="login-link">
          すでにアカウントをお持ちですか？
          <a href="/login">ログイン</a>
        </p>
      </div>
    </main>
  </div>
</body>
</html>