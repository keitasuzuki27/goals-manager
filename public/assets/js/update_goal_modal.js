// const editGoalBtn = document.querySelector(".edit-goal");
//         const editGoalModal = document.getElementById("edit-goal-modal");
//         const closeEditGoalBtn = document.getElementById("close-edit-goal-modal");
//         const cancelEditGoalBtn = document.getElementById("cancel-edit-goal-modal");

//         // 追加ボタンで開く

//         editGoalBtn.addEventListener("click", () => {
//             editGoalModal.classList.add("show");
//         });

//         // ×ボタンで閉じる
//         closeEditGoalBtn.addEventListener("click", () => {
//             editGoalModal.classList.remove("show");
//         });

//         // キャンセルボタンで閉じる
//         cancelEditGoalBtn.addEventListener("click", () => {
//             editGoalModal.classList.remove("show");
//         });

//         // 背景クリックで閉じる
//         editGoalModal.addEventListener("click", (e) => {
//             if (e.target === editGoalModal) {
//                 editGoalModal.classList.remove("show");
//             }
//         });

const updateGoalBtn = document.querySelector(".update-goal");
const updateGoalModal = document.getElementById("update-goal-modal");
const closeUpdateGoalBtn = document.getElementById("close-update-goal-modal");
const cancelUpdateGoalBtn = document.getElementById("cancel-update-goal-modal");

// ボタンで開く
updateGoalBtn.addEventListener("click", () => {
    updateGoalModal.classList.add("show");
});

// ×ボタンで閉じる
closeUpdateGoalBtn.addEventListener("click", () => {
    updateGoalModal.classList.remove("show");
});

// キャンセルボタンで閉じる
cancelUpdateGoalBtn.addEventListener("click", () => {
    updateGoalModal.classList.remove("show");
});

// 背景クリックで閉じる
updateGoalModal.addEventListener("click", (e) => {
    if (e.target === updateGoalModal) {
        updateGoalModal.classList.remove("show");
    }
});