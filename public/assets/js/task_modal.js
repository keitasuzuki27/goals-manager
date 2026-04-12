// モーダルの開閉

function setupModal({ openSelector, modalId, closeId, cancelId, onOpen }) {
  const openBtn = document.querySelectorAll(openSelector);
  const modal = document.getElementById(modalId);
  const closeBtn = document.getElementById(closeId);
  const cancelBtn = document.getElementById(cancelId);

  if (!modal || !closeBtn || !cancelBtn) {
    return;
  }

  openBtn.forEach((btn) => {
    btn.addEventListener("click", () => {
      // UpdateとDeleteの時にはtaskのidを渡す
      if (onOpen) {
        onOpen(btn);
      }
      modal.classList.add("show");
    });
  });

  // 閉じる（×）
  closeBtn.addEventListener("click", () => {
    modal.classList.remove("show");
  });

  // 閉じる（キャンセル）
  cancelBtn.addEventListener("click", () => {
    modal.classList.remove("show");
  });

  // 背景クリックで閉じる
  modal.addEventListener("click", (e) => {
    if (e.target === modal) {
      modal.classList.remove("show");
    }
  });
}

// モーダルの開閉(Create)
setupModal({
  openSelector: ".create-task-button",
  modalId: "create-task-modal",
  closeId: "close-create-task-modal",
  cancelId: "cancel-create-task-modal",
});

// モーダルの開閉(Update)
setupModal({
  openSelector: ".update-task-button",
  modalId: "update-task-modal",
  closeId: "close-update-task-modal",
  cancelId: "cancel-update-task-modal",
  // ボタンから取得した値をモーダルのvalueに入れる
  onOpen: (btn) => {
    document.getElementById("update-task-id").value = btn.dataset.taskId;
    document.getElementById("update-task-deadline").value = btn.dataset.taskDeadline;
    document.getElementById("update-task-title").value = btn.dataset.taskTitle;
  },
});

// モーダルの開閉(Delete)
setupModal({
  openSelector: ".delete-task-button",
  modalId: "delete-task-modal",
  closeId: "close-delete-task-modal",
  cancelId: "cancel-delete-task-modal",
  onOpen: (btn) => {
    document.getElementById("delete-task-id").value = btn.dataset.taskId;
    document.getElementById("delete-task-title").textContent = btn.dataset.taskTitle;
  },
});

