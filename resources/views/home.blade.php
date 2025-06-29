<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/557c66cb53.js" crossorigin="anonymous"></script>
    <title>献立生成画面</title>
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
                    <h1 class="mt-[86px] md:mt-6 text-3xl md:text-5xl font-black">1週間の献立を生成</h1>
                </div>
            </div>

            {{-- アラートメッセージ --}}
            @if (session('success'))
                <div class="grid grid-cols-12 gap-4 mt-5 md:mt-7">
                    <div class="col-span-12 md:col-span-3">
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-[#caf3e1]" role="alert">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            <!-- 献立フォーム -->
            {{-- 曜日の連想配列宣言 --}}
            @php
                $days = [
                    'mon' => ['label' => '月', 'icon' => 'genre_fish.png'],
                    'tue' => ['label' => '火', 'icon' => 'genre_fried.png'],
                    'wed' => ['label' => '水', 'icon' => 'genre_bake.png'],
                    'thu' => ['label' => '木', 'icon' => 'genre_noodles.png'],
                    'fri' => ['label' => '金', 'icon' => 'genre_don.png'],
                    'sat' => ['label' => '土', 'icon' => 'genre_other.png'],
                    'sun' => ['label' => '日', 'icon' => 'genre_other.png'],
                ];
            @endphp
            <form action="{{ route('menu-items.menusCreate') }}" method="POST">
                @csrf
                @foreach ($days as $dayKey => $dayData)
                    <div class="grid grid-cols-12 gap-4 mt-5 md:mt-7 flex items-center">
                        <!-- 曜日 -->
                        <div class="col-start-2 col-span-1 md:col-start-1">
                            <p class="text-xl md:text-3xl">{{ $dayData['label'] }}</p>
                        </div>
                        <!-- ジャンルアイコン -->
                        <div class="col-span-1">
                            <div class="w-[26px] md:w-[36px] aspect-[1/1]">
                                <img class="w-full h-full object-cover"
                                    src="{{ asset('images/junre-icon/' . $dayData['icon']) }}" alt="ジャンル">
                            </div>
                        </div>
                        <!-- テキストエリア -->
                        <div class="col-span-8 md:col-span-9 relative">
                            <input type="text" name="{{ $dayKey }}" id="{{ $dayKey }}-create"
                                class="border border-gray-300 text-xs md:text-lg rounded-lg focus:ring-[#FDC3AA] focus:border-[#FDC3AA] block w-full p-2.5 placeholder-gray-300"
                                placeholder="食べたい料理を入力" />
                            <ul id="{{ $dayKey }}-suggestions"
                                class="absolute z-10 bg-white border border-gray-300 w-full mt-1 rounded shadow hidden text-sm">
                            </ul>
                        </div>
                    </div>
                @endforeach

                <!-- 生成ボタン PC用 -->
                <div class="hidden md:grid grid-cols-12 gap-4 mt-3">
                    <div class="col-span-6 col-start-6 flex justify-end">
                        <button type="submit"
                            class="text-white bg-[#FDC3AA] hover:bg-[#f79f79] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-2xl px-5 py-2.5 me-2 mb-2">
                            献立を生成
                        </button>
                    </div>
                </div>
                <!-- 生成ボタン スマホ用 -->
                <div class="md:hidden grid grid-cols-12 gap-4 mt-3">
                    <div class="col-span-8 col-start-3 flex justify-center">
                        <button type="submit"
                            class="text-white bg-[#F9C7C0] focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-2xl px-10 py-4 my-4">
                            献立を生成
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>

    {{-- ▼ スクリプト --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];

            days.forEach(day => {
                const input = document.getElementById(`${day}-create`);
                const list = document.getElementById(`${day}-suggestions`);

                if (!input || !list) return; // 念のため null チェック

                let timer;

                input.addEventListener('input', () => {
                    const keyword = input.value.trim();
                    clearTimeout(timer);

                    timer = setTimeout(() => {
                        if (keyword === '') {
                            list.innerHTML = '';
                            list.classList.add('hidden');
                            return;
                        }

                        fetch(`/search-recipes?keyword=${encodeURIComponent(keyword)}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.length === 0) {
                                    list.innerHTML =
                                        '<li class="p-2 text-gray-500">候補なし</li>';
                                } else {
                                    list.innerHTML = data.map(recipe =>
                                        `<li class="p-2 hover:bg-blue-100 cursor-pointer" data-name="${recipe.name}">
                                        ${recipe.name}
                                    </li>`
                                    ).join('');
                                }
                                list.classList.remove('hidden');

                                list.querySelectorAll('li').forEach(li => {
                                    li.addEventListener('click', () => {
                                        input.value = li.dataset.name;
                                        list.innerHTML = '';
                                        list.classList.add('hidden');
                                    });
                                });
                            });
                    }, 300);
                });

                input.addEventListener('blur', () => {
                    setTimeout(() => list.classList.add('hidden'), 100);
                });

                input.addEventListener('focus', () => {
                    if (list.innerHTML.trim() !== '') {
                        list.classList.remove('hidden');
                    }
                });
            });
        });
    </script>
</body>

</html>
