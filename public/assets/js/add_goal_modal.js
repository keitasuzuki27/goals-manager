const addGoalBtn = document.querySelector(".add-goal-button");
        const addGoalModal = document.getElementById("add-goal-modal");
        const closeAddGoalBtn = document.getElementById("close-add-goal-modal");
        const cancelAddGoalBtn = document.getElementById("cancel-add-goal-modal");

        // 追加ボタンで開く

        addGoalBtn.addEventListener("click", () => {
            addGoalModal.classList.add("show");
        });

        // ×ボタンで閉じる
        closeAddGoalBtn.addEventListener("click", () => {
            addGoalModal.classList.remove("show");
        });

        // キャンセルボタンで閉じる
        cancelAddGoalBtn.addEventListener("click", () => {
            addGoalModal.classList.remove("show");
        });

        // 背景クリックで閉じる
        addGoalModal.addEventListener("click", (e) => {
            if (e.target === addGoalModal) {
                addGoalModal.classList.remove("show");
            }
        });