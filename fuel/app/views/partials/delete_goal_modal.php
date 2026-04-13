<div id="delete-goal-modal" class="modal">
  <div class="modal-card">
    <!-- モーダルを閉じる -->
    <button type="button" class="modal-close" id="close-delete-goal-modal">×</button>

    <!-- 削除対象の目標名を表示 -->
    <h2 class="modal-title"><?= e($goal['title']) ?> を削除</h2>
    <p class="modal-subtitle">この大目標を本当に削除しますか？</p>

    <!-- 削除処理 -->
    <form method="post" action="/goals/delete">

      <!-- 削除対象のgoal_idをindex.phpからセット -->
      <input type="hidden" name="goal_id" value="<?= e($goal['id']) ?>">

      <div class="modal-actions">
        <!-- モーダルを閉じる -->
        <button type="button" class="cancel-button" id="cancel-delete-goal-modal">
          キャンセル
        </button>
        <!-- 削除実行 -->
        <button type="submit" class="save-button">
          削除する
        </button>
      </div>
    </form>
  </div>
</div>