<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>新規登録 | goals manager</title>
  <link rel="stylesheet" href="/assets/css/auth.css" />
</head>

<body>
  <div class="auth-layout">
    <aside class="auth-sidebar">
      <div class="sidebar-inner">
        <h1 class="logo">goals manager</h1>
        <p class="sidebar-title">目標を整理して、<br>一歩ずつ進める</p>
        <p class="sidebar-text">
          大きな目標を小さな行動に分解して、
          毎日の進捗を見える化しましょう。
        </p>
      </div>
    </aside>

    <main class="auth-main">
      <div class="auth-card">
        <div class="auth-header">
          <h2>新規アカウント作成</h2>
        </div>

        <!-- ユーザ名の入力 -->
        <form class="auth-form" action="/auth/create" method="post">
          <div class="form-group">
            <label for="name">ユーザー名</label>
            <input
              value="<?= e($old['username'] ?? '') ?>"
              type="text"
              id="name"
              name="name"
              placeholder="例: Taro"
              required>
            <!-- ユーザー名のエラー -->
            <?php if (!empty($errors['username'])): ?>
              <p class="error"><?= e($errors['username']) ?></p>
            <?php endif; ?>
          </div>

          <!-- メールアドレスの入力 -->
          <div class="form-group">
            <label for="email">メールアドレス</label>
            <input
              value="<?= e($old['email'] ?? '') ?>"
              type="email"
              id="email"
              name="email"
              placeholder="example@email.com"
              required>
            <!-- メールアドレスのエラー -->
            <?php if (!empty($errors['email'])): ?>
              <p class="error"><?= e($errors['email']) ?></p>
            <?php endif; ?>
          </div>

          <!-- パスワードの入力 -->
          <div class="form-group">
            <label for="password">パスワード</label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="8文字以上で入力"
              minlength="8"
              required>
            <!-- パスワードのエラー -->
            <?php if (!empty($errors['password'])): ?>
              <p class="error"><?= e($errors['password']) ?></p>
            <?php endif; ?>
          </div>

          <button type="submit" class="auth-button">アカウントを作成</button>
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