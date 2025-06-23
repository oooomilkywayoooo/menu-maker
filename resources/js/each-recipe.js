// 曜日ごとに対応するジャンルID（サーバー側と一致させる）
const genreMap = {
    mon: 1,
    tue: 2,
    wed: 3,
    thu: 4,
    fri: 5,
    sat: 6,
    sun: 6
};

// イベント委任で曜日ごとのボタンに対応
const reloadButtons = document.querySelectorAll("button[id^='reload-']");

reloadButtons.forEach((btn) => {
    btn.addEventListener("click", async (e) => {
        const day = btn.id.replace("reload-", "");
        const genreId = genreMap[day];

        try {
            const response = await fetch(`/each-create?day=${day}&genre_id=${genreId}`);
            const data = await response.json();

            // input欄と詳細リンクを更新
            document.querySelector(`#${day}-menu`).value = data.name;

            const detailIconContainer = btn.parentElement; // 詳細リンクの親span

            // 既存のaタグ削除（あれば）
            const existingLink = detailIconContainer.querySelector("a");
            if (existingLink) {
                existingLink.remove();
            }

            // レシピIDがある場合のみ追加
            if (data.id) {
                const newLink = document.createElement("a");
                newLink.href = `/recipes/${data.id}`;
                newLink.innerHTML = '<i class="fa-solid fa-circle-info fa-lg mr-2"></i>';
                detailIconContainer.prepend(newLink);
            }
        } catch (error) {
            console.error("エラーが発生しました", error);
        }
    });
});
