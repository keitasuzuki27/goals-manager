<div id="delete-task-modal" class="modal">
  <div class="modal-card">
    <!-- モーダルを閉じる -->
    <button type="button" class="modal-close" id="close-delete-task-modal">×</button>

    <!-- 削除対象タスク名を表示 -->
    <h2 class="modal-title"> <span id="delete-task-title"></span> を消去</h2>
    <p class="modal-subtitle">このタスクを本当に削除しますか？</p>

    <!-- 削除処理 -->
    <form method="post" action="/tasks/delete">

      <!-- 削除対象のtask_idをtask_modal.jsでセット -->
      <input id="delete-task-id" type="hidden" name="task_id" value="">

      <!-- goal_idをindex.phpでセット -->
      <?php if (!empty($goal['id'])): ?>
        <input type="hidden" name="goal_id" value="<?= e($goal['id']) ?>">
      <?php endif; ?>

      <div class="modal-actions">
        <!-- モーダルを閉じる -->
        <button type="button" class="cancel-button" id="cancel-delete-task-modal">
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