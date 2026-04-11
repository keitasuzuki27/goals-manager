<!-- tasksのCreateとUpdateのモーダル -->

<div id="<?= $task_modal_id ?>" class="modal">
  <div class="modal-card">
    <button type="button" class="modal-close" id="<?= $close_task_modal_id ?>">×</button>

    <h2 class="modal-title"><?= $modal_title ?></h2>
    <p class="modal-subtitle"><?= $modal_subtitle ?></p>

    <form class="modal-form" method="post" action="<?= $task_form_action ?>">
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

      <div class="form-group">
        <label for="<?= $task_deadline_id ?>">締切日</label>
        <input
          value=""
          type="date"
          id="<?= $task_deadline_id ?>"
          name="deadline"
          required>
      </div>

      <?php if (!empty($goal['id'])): ?>
        <input type="hidden" name="goal_id" value="<?= e($goal['id']) ?>">
      <?php endif; ?>

      <!-- UpdateとDeleteの時はtask_modal.jsからtaskのidをvalueに入れる -->
      <input type="hidden" name="task_id" id="<?= $hidden_input_id ?>">

      <div class="modal-actions">
        <button type="button" class="cancel-button" id="<?= $cancel_task_modal_id ?>">キャンセル</button>
        <button type="submit" class="save-button">保存する</button>
      </div>
    </form>
  </div>
</div>