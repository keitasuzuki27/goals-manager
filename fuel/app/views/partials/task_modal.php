<!-- tasksの新規作成と編集用モーダル -->

<div id="<?= $task_modal_id ?>" class="modal">
  <div class="modal-card">
    <!-- モーダルを閉じる -->
    <button type="button" class="modal-close" id="<?= $close_task_modal_id ?>">×</button>

    <!-- タイトル・説明 -->
    <h2 class="modal-title"><?= $modal_title ?></h2>
    <p class="modal-subtitle"><?= $modal_subtitle ?></p>

    <!-- 新規作成 / 更新フォーム -->
    <form class="modal-form" method="post" action="<?= $task_form_action ?>">
      <!-- タイトル入力 -->
      <div class="form-group">
        <label for="<?= $task_title_id ?>">タイトル</label>
        <input
          value=""
          type="text"
          id="<?= $task_title_id ?>"
          name="title"
          placeholder="<?= isset($task['title']) ? '' : '例：文法の基礎を学ぶ' ?>"
          required>
      </div>

      <!-- 締切日入力 -->
      <div class="form-group">
        <label for="<?= $task_deadline_id ?>">締切日</label>
        <input
          value=""
          type="date"
          id="<?= $task_deadline_id ?>"
          name="deadline"
          required>
      </div>

      <!-- goal_idをControllerに送る -->
      <?php if (!empty($goal['id'])): ?>
        <input type="hidden" name="goal_id" value="<?= e($goal['id']) ?>">
      <?php endif; ?>

      <!-- Updateの時はtask_modal.jsから編集対象のtaskのidをvalueに入れる -->
      <input type="hidden" name="task_id" id="<?= $hidden_input_id ?>">

      <div class="modal-actions">
        <!-- モーダルを閉じる -->
        <button type="button" class="cancel-button" id="<?= $cancel_task_modal_id ?>">キャンセル</button>

        <!-- 保存処理 -->
        <button type="submit" class="save-button">保存する</button>
      </div>
    </form>
  </div>
</div>