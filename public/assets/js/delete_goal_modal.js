const deleteGoalBtn = document.querySelector(".delete-goal");
const deleteGoalModal = document.getElementById("delete-goal-modal");
const closeDeleteGoalBtn = document.getElementById("close-delete-goal-modal");
const cancelDeleteGoalBtn = document.getElementById("cancel-delete-goal-modal");

// 削除ボタンで開く
deleteGoalBtn.addEventListener("click", () => {
    deleteGoalModal.classList.add("show");
});

// ×ボタンで閉じる
closeDeleteGoalBtn.addEventListener("click", () => {
    deleteGoalModal.classList.remove("show");
});

// キャンセルボタンで閉じる
cancelDeleteGoalBtn.addEventListener("click", () => {
    deleteGoalModal.classList.remove("show");
});

// 背景クリックで閉じる
deleteGoalModal.addEventListener("click", (e) => {
    if (e.target === deleteGoalModal) {
        deleteGoalModal.classList.remove("show");
    }
});