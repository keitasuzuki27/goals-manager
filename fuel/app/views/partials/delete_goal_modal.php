<div id="delete-goal-modal" class="modal">
  <div class="modal-card">
    <button type="button" class="modal-close" id="close-delete-goal-modal">×</button>

    <h2 class="modal-title"><?= $goal['title'] ?>  を削除</h2>
    <p class="modal-subtitle">この大目標を本当に削除しますか？</p>

    <form method="post" action="/goals/delete">
      
      <!-- どのデータを削除するか -->
      <input type="hidden" name="goal_id" value="<?= $goal['id'] ?>">

      <div class="modal-actions">
        <button type="button" class="cancel-button" id="cancel-delete-goal-modal">
          キャンセル
        </button>
        <button type="submit" class="save-button">
          削除する
        </button>
      </div>
    </form>
  </div>
</div>