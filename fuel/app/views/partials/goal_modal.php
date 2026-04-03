<div id="goal-modal" class="modal">
  <div class="modal-card">
    <button type="button" class="modal-close" id="close-goal-modal">×</button>

    <h2 class="modal-title">新しい大目標を追加</h2>
    <p class="modal-subtitle">タイトルと締切日を設定します</p>

    <form class="goal-form" method="post" action="/goals/create">
      <div class="form-group">
        <label for="goal-title">タイトル</label>
        <input
          type="text"
          id="goal-title"
          name="title"
          placeholder="例：スペイン語を学ぶ">
      </div>

      <div class="form-group">
        <label for="goal-deadline">締切日</label>
        <input
          type="date"
          id="goal-deadline"
          name="deadline">
      </div>

      <div class="modal-actions">
        <button type="button" class="cancel-button" id="cancel-goal-modal">キャンセル</button>
        <button type="submit" class="save-button">保存する</button>
      </div>
    </form>
  </div>
</div>