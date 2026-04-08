<!-- CreateとUpdateのモーダル -->

<div id="<?= $goal_modal_id ?>" class="modal">
  <div class="modal-card">
    <button type="button" class="modal-close" id="<?= $close_goal_modal_id ?>">×</button>

    <h2 class="modal-title"><?= $modal_title ?></h2>
    <p class="modal-subtitle"><?= $modal_subtitle ?></p>

    <form class="goal-form" method="post" action="<?= $goal_form_action ?>">
      <div class="form-group">
        <label for="<?= $goal_title_id ?>">タイトル</label>
        <input
          value="<?= isset($goal['title']) ? e($goal['title']) : '' ?>"
          type="text"
          id="<?= $goal_title_id ?>"
          name="title"
          placeholder="<?= isset($goal['title']) ? '' : '例：スペイン語を学ぶ' ?>">
      </div>

      <div class="form-group">
        <label for="<?= $goal_deadline_id ?>">締切日</label>
        <input
          value="<?= isset($goal['deadline']) ? e($goal['deadline']) : '' ?>"
          type="date"
          id="<?= $goal_deadline_id ?>"
          name="deadline">
      </div>

      <?php if (!empty($goal['id'])): ?>
        <input type="hidden" name="id" value="<?= e($goal['id']) ?>">
      <?php endif; ?>

      <div class="modal-actions">
        <button type="button" class="cancel-button" id="<?= $cancel_goal_modal_id ?>">キャンセル</button>
        <button type="submit" class="save-button">保存する</button>
      </div>
    </form>
  </div>
</div>