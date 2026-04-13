# Goals Manager

## アプリ概要
Goals Managerは、大きな目標を小さなタスクに分解し、進捗を可視化することで日々の行動を管理するWebアプリケーションです。

---

## 使用技術
- PHP（FuelPHP）
- MySQL
- JavaScript
- Knockout.js

---

## データベース設計

```sql
CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uniq_users_email (email)
);

CREATE TABLE goals (
  id INT NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  deadline DATE DEFAULT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at DATETIME DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_goals_user_id
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE tasks (
  id INT NOT NULL AUTO_INCREMENT,
  goal_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  deadline DATE DEFAULT NULL,
  is_done INT NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at DATETIME DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_tasks_goal_id
    FOREIGN KEY (goal_id) REFERENCES goals(id)
);
```

## 課題条件への対応

### 1. サーバサイド言語はPHPで、フレームワークのFuelPHPを使用すること
- アプリ全体をPHP（FuelPHP）で実装
- Controller / Model / View の構成で開発

---

### 2. beforeメソッドを使う
- `fuel/app/classes/controller/base.php`
- `before()` メソッドでログイン状態をチェックし、未ログイン時はリダイレクト

---

### 3. configファイルをカスタマイズする
- `fuel/app/config/routes.php`
- URLとControllerの対応を定義（例：`/dashboard` → DashboardController）

---

### 4. sessionやcookieを使う
- `fuel/app/classes/controller/auth.php`
- Sessionを用いてログイン状態を管理
- `Session::set()` / `Session::get()` を使用

---

### 5. ネームスペースを使う
- 未実装
- クラス名の衝突を防ぐ仕組みとして理解

---

### 6. \（バックスラッシュ）を使ったグローバル名前空間へのアクセス
- `DB`, `Input`, `Session` などのFuelPHPクラスを使用

---

### 7. データベースとのやり取りはDBクラスを使うこと
- `fuel/app/classes/model/goal.php`
- `fuel/app/classes/model/task.php`
- `fuel/app/classes/model/user.php`
- `DB::select`, `insert`, `update`, `delete` を使用

---

### 8. 1:n関係のテーブル構造があること
- users : goals = 1 : n
- goals : tasks = 1 : n
- 外部キー（user_id, goal_id）で関連付け

---

### 9. CRUDの機能が網羅されている
- `Model_Goal`, `Model_Task`
- create / find / update / delete を実装

---

### 10. フロントエンドのライブラリにknockout.jsが使用されている
- `public/assets/js/pw_validation.js`
- パスワードのエラー表示に使用しました。

---

### 11. UXを考慮して一部動的なUIが実装されている（非同期処理）
- `public/assets/js/task_toggle.js`
- fetch APIを用いてタスクの完了状態を非同期更新
- ページリロードなしでUIを変更

---

### 12. GitHubでコードの管理を行う
- GitHubでリポジトリを作成
- コミット単位で変更履歴を管理

---

### 13. セキュリティ資料を読み必要な実装を行う
- Viewで `e()` を用いたHTMLエスケープ（XSS対策）
- Modelで `user_id` を条件に含めたアクセス制御（不正アクセス防止）