document.querySelectorAll('.complete-button').forEach(button => {
  button.addEventListener('click', async function () {
    const taskId = this.dataset.taskId;
    const goalId = this.dataset.goalId;

    try {
      const res = await fetch('/tasks/toggle', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `task_id=${taskId}&goal_id=${goalId}`
      });

      const data = await res.json();

      if (data.status === 'success') {
        const taskCard = this.closest('.task-card');

        if (data.is_done == 1) {
          taskCard.classList.add('done');
        } else {
          taskCard.classList.remove('done');
        }
      }
    } catch (error) {
      console.error('更新に失敗しました', error);
    }
  });
});