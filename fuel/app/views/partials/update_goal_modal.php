<!-- <div id="edit-goal-modal" class="modal">
  <div class="modal-card">
    <button type="button" class="modal-close" id="close-edit-goal-modal">×</button>

    <h2 class="modal-title">大目標を編集</h2>
    <p class="modal-subtitle">タイトルと締切日を設定します</p>

    <form class="goal-form" method="post" action="/goals/update">
      <div class="form-group">
        <label for="edit-goal-title">タイトル</label>
        <input
          type="text"
          id="edit-goal-title"
          name="title"
          value="<?= $selected_goal['title'] ?>">
      </div>

      <div class="form-group">
        <label for="edit-goal-deadline">締切日</label>
        <input
          type="date"
          id="edit-goal-deadline"
          name="deadline"
          value="<?= $selected_goal['deadline'] ?>">
      </div>

      <input type="hidden" name="id" value="<?= $selected_goal['id'] ?>">

      <div class="modal-actions">
        <button type="button" class="cancel-button" id="cancel-edit-goal-modal">キャンセル</button>
        <button type="submit" class="save-button">保存する</button>
      </div>
    </form>
  </div>
</div> -->

<div id="update-goal-modal" class="modal">
  <div class="modal-card">
    <button type="button" class="modal-close" id="close-update-goal-modal">×</button>

    <h2 class="modal-title">大目標を編集</h2>
    <p class="modal-subtitle">タイトルと締切日を設定します</p>

    <form class="goal-form" method="post" action="/goals/update">
      <div class="form-group">
        <label for="update-goal-title">タイトル</label>
        <input
          type="text"
          id="update-goal-title"
          name="title"
          value="<?= $selected_goal['title'] ?>">
      </div>

      <div class="form-group">
        <label for="update-goal-deadline">締切日</label>
        <input
          type="date"
          id="update-goal-deadline"
          name="deadline"
          value="<?= $selected_goal['deadline'] ?>">
      </div>

      <input type="hidden" name="id" value="<?= $selected_goal['id'] ?>">

      <div class="modal-actions">
        <button type="button" class="cancel-button" id="cancel-update-goal-modal">キャンセル</button>
        <button type="submit" class="save-button">保存する</button>
      </div>
    </form>
  </div>
</div>