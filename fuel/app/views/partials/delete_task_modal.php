<div id="delete-task-modal" class="modal">
  <div class="modal-card">
    <button type="button" class="modal-close" id="close-delete-task-modal">×</button>

    <h2 class="modal-title"> <span id="delete-task-title"></span>  を消去</h2>
    <p class="modal-subtitle">このタスクを本当に削除しますか？</p>

    <form method="post" action="/tasks/delete">
      
      <!-- どのデータを削除するか -->
      <input id="delete-task-id" type="hidden" name="task_id" value="">

      <?php if (!empty($goal['id'])): ?>
        <input type="hidden" name="goal_id" value="<?= e($goal['id']) ?>">
      <?php endif; ?>

      <div class="modal-actions">
        <button type="button" class="cancel-button" id="cancel-delete-task-modal">
          キャンセル
        </button>
        <button type="submit" class="save-button">
          削除する
        </button>
      </div>
    </form>
  </div>
</div>