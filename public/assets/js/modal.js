const openBtn = document.querySelector(".add-goal");
        const modal = document.getElementById("goal-modal");
        const closeBtn = document.getElementById("close-goal-modal");
        const cancelBtn = document.getElementById("cancel-goal-modal");

        // 追加ボタンで開く

        openBtn.addEventListener("click", () => {
            modal.classList.add("show");
        });

        // ×ボタンで閉じる
        closeBtn.addEventListener("click", () => {
            modal.classList.remove("show");
        });

        // キャンセルボタンで閉じる
        cancelBtn.addEventListener("click", () => {
            modal.classList.remove("show");
        });

        // 背景クリックで閉じる
        modal.addEventListener("click", (e) => {
            if (e.target === modal) {
                modal.classList.remove("show");
            }
        });