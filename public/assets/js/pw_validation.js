// Knockout.jsを用いたViewModel定義
function ViewModel() {
  // パスワード入力値（observableで管理）
  this.password = ko.observable("");

  // パスワードのバリデーションメッセージ
  this.passwordError = ko.computed(() => {
    // 未入力時はエラー表示しない
    if (this.password().length === 0) return "";

    // 8文字未満ならエラー
    if (this.password().length < 8) return "パスワードは8文字以上必要です";

    // 問題なければエラーなし
    return "";
  });
}

ko.applyBindings(new ViewModel());
