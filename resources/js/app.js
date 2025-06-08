import './bootstrap';

// ハンバーガーメニューのJS
button.addEventListener('click', event => {
  bars.classList.toggle('!hidden');
  xmark.classList.toggle('!hidden');
  menu.classList.toggle('translate-x-full');
});

// セレクトタグの文字色JS
const select = document.getElementById('genre');

// 初期判定（リロード対策）
if (select.value !== '') {
  select.classList.remove('text-gray-300');
  select.classList.add('text-black');
}

// 選択時に色を変える
select.addEventListener('change', function () {
  if (this.value === '') {
    this.classList.remove('text-black');
    this.classList.add('text-gray-300');
  } else {
    this.classList.remove('text-gray-300');
    this.classList.add('text-black');
  }
});

// 材料入力テキストボックスの操作
document.addEventListener('DOMContentLoaded', function () {
  const container1 = document.getElementById('material_container');

  // 動的に追加されたボタンにも対応するように委任イベント
  container1.addEventListener('click', function (event) {
    // ＋ボタン押下時
    if (event.target.closest('#add_material')) {
      const container2 = document.createElement('div');
      container2.className = 'container grid grid-cols-12 gap-4 mt-2 md:mt-5';

      const container3 = document.createElement('div');
      container3.className = 'col-start-3 md:col-start-2 col-span-8 flex items-center';

      container3.innerHTML = `
        <input type="text" name="materials[]" placeholder="材料"
          class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 bg-white placeholder-gray-300 focus:ring-[#F9C9B4] focus:border-[#F9C9B4]">
        <button type="button" class="delete_material">
          <i class="fa-solid fa-circle-xmark fa-2x ps-2" style="color:#f26f37;"></i>
        </button>
      `;

      container2.appendChild(container3);
      container1.appendChild(container2);
    }

    // ×ボタン押下時
    if (event.target.closest('.delete_material')) {
      const targetBtn = event.target.closest('.delete_material');
      const containerToRemove = targetBtn.closest('.container');
      if (containerToRemove) {
        containerToRemove.remove();
      }
    }
  });
});