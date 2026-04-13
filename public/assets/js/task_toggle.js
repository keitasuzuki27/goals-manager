// 完了ボタンに対してクリックイベントを登録
document.querySelectorAll(".complete-button").forEach((button) => {
  button.addEventListener("click", async function () {
    // data属性からtask_idとgoal_idを取得
    const taskId = this.dataset.taskId;
    const goalId = this.dataset.goalId;

    try {
      // タスクの完了状態をトグルするAPIを呼び出し（非同期通信）
      const res = await fetch("/tasks/toggle", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        // サーバーにtask_idとgoal_idを送信
        body: `task_id=${taskId}&goal_id=${goalId}`,
      });

      // JSONレスポンスを取得
      const data = await res.json();

      // 更新成功時のみUIを変更
      if (data.status === "success") {
        const taskCard = this.closest(".task-card");

        // 完了状態に応じてクラスを付け外し
        if (data.is_done == 1) {
          taskCard.classList.add("done");
        } else {
          taskCard.classList.remove("done");
        }
      }
      // 対象goalの進捗バーを取得
      const progressLine = document.querySelector(
        `.progress-line[data-goal-id="${goalId}"]`,
      );

      if (progressLine) {
        const steps = progressLine.querySelectorAll(".progress-step");

        // 完了タスク数に応じて進捗ステップにactiveクラスを付与
        steps.forEach((step, index) => {
          if (index < data.done_count) {
            step.classList.add("active");
          } else {
            step.classList.remove("active");
          }
        });
      }
    } catch (error) {
      // 通信エラー時のログ
      console.error("更新に失敗しました", error);
    }
  });
});
