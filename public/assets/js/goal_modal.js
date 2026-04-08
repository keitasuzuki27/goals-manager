// モーダルの開閉

function setupModal({
    openSelector,
    modalId,
    closeId,
    cancelId
}) {
    const openBtn = document.querySelector(openSelector);
    const modal = document.getElementById(modalId);
    const closeBtn = document.getElementById(closeId);
    const cancelBtn = document.getElementById(cancelId);

    if (!openBtn || !modal || !closeBtn || !cancelBtn) {
        return;
    }

    // 開く
    openBtn.addEventListener("click", () => {
        modal.classList.add("show");
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
    openSelector: ".add-goal-button",
    modalId: "add-goal-modal",
    closeId: "close-add-goal-modal",
    cancelId: "cancel-add-goal-modal"
});

// モーダルの開閉(Update)
setupModal({
    openSelector: ".update-goal",
    modalId: "update-goal-modal",
    closeId: "close-update-goal-modal",
    cancelId: "cancel-update-goal-modal"
});

// モーダルの開閉(Delete)
setupModal({
    openSelector: ".delete-goal",
    modalId: "delete-goal-modal",
    closeId: "close-delete-goal-modal",
    cancelId: "cancel-delete-goal-modal"
});