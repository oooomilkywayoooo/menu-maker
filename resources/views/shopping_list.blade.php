<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/557c66cb53.js" crossorigin="anonymous"></script>
    <title>買い物リスト画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#fdfbf7] font-Kiwi">

    <!-- ヘッダー タブレット・スマホのみ表示 -->
    @include('components.hamburger')

    <div class="grid grid-cols-12 gap-4">
        <!-- サイドバー -->
        @include('components.sidebar')

        <!-- メイン -->
        <main class="col-span-12 md:col-span-9 h-dvh">
            <div class="md:grid grid-cols-8 text-center">
                <div class="col-start-1 col-span-6 text-center">
                    <h1 class="mt-[86px] md:mt-6 text-3xl md:text-5xl font-black">買い物リスト</h1>
                </div>
            </div>

            <!-- 買うもの -->
            <div class="grid grid-cols-12 gap-4 mt-5 md:mt-10 flex items-center">
                <div class="col-start-2 col-span-4 md:col-start-1">
                    <p class="text-2xl md:text-3xl font-bold">買うもの</p>
                </div>
                <div class="col-start-9 col-span-3 md:col-start-8 flex justify-end">
                    <!-- PC用ボタン -->
                    <button id="addItemBtn"
                        class="hidden md:block text-white bg-[#FDC3AA] hover:bg-[#f79f79] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-2xl px-5 py-2.5 me-2 mb-2">
                        <i class="fa-solid fa-circle-plus"></i>
                        追加
                    </button>
                    <!-- タブレット・スマホ用ボタン -->
                    <button id="addItemBtn" class="block md:hidden">
                        <i class="fa-solid fa-circle-plus fa-2x"></i>
                    </button>
                </div>
            </div>

            <!-- チェックリスト -->
            <div id="checklist-wrapper">
                @foreach ($buyMaterials as $index => $material)
                    @if (!$material['check'])
                        <div class="grid grid-cols-12 gap-4 mt-3">
                            <div class="col-start-2 col-span-10 md:col-start-1">
                                <div
                                    class="flex items-center ps-4 border border-gray rounded-lg bg-[#E7F2F7] md:rounded-sm md:bg-white">
                                    <input id="checkbox-{{ $index }}" type="checkbox"
                                        value="{{ $material['text'] }}" name="buy_materials[]"
                                        {{ $material['check'] ? 'checked' : '' }}
                                        class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                                    <label for="checkbox-{{ $index }}"
                                        class="w-full py-2 ms-2 text-2xl text-[#000000]">
                                        {{ $material['text'] }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- 購入済み -->
            <div class="grid grid-cols-12 gap-4 mt-5 md:mt-10">
                <div class="col-start-2 col-span-4 md:col-start-1">
                    <p class="text-2xl md:text-3xl font-bold">購入済み</p>
                </div>
            </div>

            <!-- チェックリスト -->
            <div id="bought-wrapper">
                @foreach ($buyMaterials as $index => $material)
                    @if ($material['check'])
                        <div class="grid grid-cols-12 gap-4 mt-3">
                            <div class="col-start-2 col-span-10 md:col-start-1">
                                <div
                                    class="flex items-center ps-4 border border-gray rounded-lg bg-[#E7F2F7] md:rounded-sm md:bg-white">
                                    <input id="checkbox-{{ $index }}" type="checkbox"
                                        value="{{ $material['text'] }}" name="buy_materials[]" checked
                                        class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                                    <label for="checkbox-{{ $index }}"
                                        class="w-full py-2 ms-2 text-2xl text-[#000000] line-through">
                                        {{ $material['text'] }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- 戻るボタン スマホ用 -->
            <div class="md:hidden grid grid-cols-12 gap-4 mt-5">
                <div class="col-span-8 col-start-3 flex justify-center">
                    <button type="button"
                        class="text-white bg-[#F9C7C0] focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-2xl px-20 py-4 my-4">
                        戻る
                    </button>
                </div>
            </div>
        </main>
    </div>
    <!-- モーダル全体 -->
    <div id="customModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <!-- モーダルボックス -->
        <div class="bg-white p-6 rounded-lg w-11/12 max-w-md shadow-lg">
            <h2 class="text-xl font-bold mb-4">買い物リストに追加</h2>
            <input id="modalInput" type="text"
                class="w-full p-2 border border-gray-300 rounded-md mb-4 text-lg placeholder-gray-400"
                placeholder="例：牛乳" />
            <div class="flex justify-end gap-2">
                <button id="cancelModalBtn"
                    class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-black">キャンセル</button>
                <button id="submitModalBtn"
                    class="px-4 py-2 rounded bg-[#FDC3AA] hover:bg-[#f79f79] text-white">追加</button>
            </div>
        </div>
    </div>
    <script>
        // 「買うもの」リストのチェックボックスにイベントを付ける関数
        function addCheckboxListener(checkbox) {
            checkbox.addEventListener('change', function() {
                const itemDiv = checkbox.closest('.grid');
                const label = itemDiv.querySelector('label');

                if (checkbox.checked) {
                    // チェックされたら取り消し線＋購入済みに移動
                    label.classList.add('line-through');
                    document.getElementById('bought-wrapper').appendChild(itemDiv);
                } else {
                    // チェック外したら元に戻す（オプション）
                    label.classList.remove('line-through');
                    document.getElementById('checklist-wrapper').prepend(itemDiv);
                }

                checkIfAllChecked();

                fetch("{{ route('materials.update') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        text: checkbox.value,
                        check: checkbox.checked
                    })
                });
            });
        }

        // チェックが全て完了したかどうかを確認
        function checkIfAllChecked() {
            const checklist = document.querySelectorAll('#checklist-wrapper input[type="checkbox"]');
            if (checklist.length === 0) {
                // 全て購入済みに移動していたら10秒後に削除処理
                setTimeout(() => {
                    const boughtWrapper = document.getElementById('bought-wrapper');
                    boughtWrapper.innerHTML = '';

                    // セッション削除のための非同期リクエスト
                    fetch("{{ route('materials.clear') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data.message); // 確認用ログ
                        });
                }, 10000); // 10秒後
            }
        }

        // 最初にチェックが全て済んでるかも確認（初期表示用）
        checkIfAllChecked();

        // 「買うもの」と「購入済み」両方のチェックボックスにイベントをつける
        document.querySelectorAll('#checklist-wrapper input[type="checkbox"], #bought-wrapper input[type="checkbox"]')
            .forEach(cb => {
                addCheckboxListener(cb);
            });

        // 追加ボタンでアイテムを追加する処理
        const modal = document.getElementById('customModal');
        const input = document.getElementById('modalInput');
        const addBtns = document.querySelectorAll('#addItemBtn');
        const cancelBtn = document.getElementById('cancelModalBtn');
        const submitBtn = document.getElementById('submitModalBtn');
        const checklistWrapper = document.getElementById('checklist-wrapper');

        // モーダルを開く
        addBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                input.value = '';
                modal.classList.remove('hidden');
                input.focus();
            });
        });

        // モーダルを閉じる
        cancelBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // 追加ボタン押下時
        submitBtn.addEventListener('click', () => {
            const value = input.value.trim();
            if (value !== '') {
                const index = Date.now();

                const newItem = document.createElement('div');
                newItem.className = "grid grid-cols-12 gap-4 mt-3";
                newItem.innerHTML = `
                <div class="col-start-2 col-span-10 md:col-start-1">
                    <div class="flex items-center ps-4 border border-gray rounded-lg bg-[#E7F2F7] md:rounded-sm md:bg-white">
                        <input id="checkbox-${index}" type="checkbox" value="${value}" name="buy_materials[]"
                            class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                        <label for="checkbox-${index}" class="w-full py-2 ms-2 text-2xl text-[#000000]">
                            ${value}
                        </label>
                    </div>
                </div>
            `;
                checklistWrapper.prepend(newItem);

                // 新しいチェックボックスにリスナーを付ける
                const newCheckbox = newItem.querySelector('input[type="checkbox"]');
                addCheckboxListener(newCheckbox);

                // セッションに保存（AJAX）
                fetch("{{ route('materials.add') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            text: value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.message);
                    });

                modal.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
