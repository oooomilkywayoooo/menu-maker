<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/557c66cb53.js" crossorigin="anonymous"></script>
    <title>履歴詳細画面</title>
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
                    <h1 class="mt-[86px] md:mt-6 text-3xl md:text-5xl font-black">
                        {{ \Carbon\Carbon::parse($startDate)->format('n月j日') }}〜{{ \Carbon\Carbon::parse($endDate)->format('n月j日') }}の献立
                    </h1>
                </div>
            </div>
            <!-- 献立一覧 -->
            @php
                // 曜日を日本語表記＆ジャンル画像のマッピング（必要に応じて変更してください）
                $weekDays = [
                    'sun' => '日',
                    'mon' => '月',
                    'tue' => '火',
                    'wed' => '水',
                    'thu' => '木',
                    'fri' => '金',
                    'sat' => '土',
                ];
                $genreIcons = [
                    1 => 'genre_fish.png',
                    2 => 'genre_fried.png',
                    3 => 'genre_bake.png',
                    4 => 'genre_noodles.png',
                    5 => 'genre_don.png',
                ];
                $defaultIcon = 'genre_other.png';
            @endphp
            @foreach ($menuByDay as $dayKey => $menu)
                @php
                    $iconFile = $genreIcons[$menu['genre_id'] ?? null] ?? $defaultIcon;
                @endphp
                <div class="grid grid-cols-12 gap-4 mt-5 md:mt-7 flex items-center">
                    <div class="flex col-start-2 col-span-10 md:col-span-9 md:col-start-1 {{ $loop->last ? 'mb-5' : '' }}">
                        <span
                            class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#FFC5AC] border rounded-e-0 border-[#FFC5AC] border-e-0 rounded-s-full">
                            <p class="text-xl md:text-2xl pr-2">{{ $weekDays[$dayKey] }}</p>
                            <div class="w-[26px] aspect-[1/1]">
                                <img class="w-full h-full object-cover"
                                    src="{{ asset('images/junre-icon/' . $iconFile) }}" alt="ジャンルアイコン">
                            </div>
                        </span>

                        <a href="{{ $menu['recipe_id'] ? route('recipes.show', ['recipe' => $menu['recipe_id']]) : '#' }}"
                            class="rounded-none border-e-0 bg-[#E7F2F7] md:bg-white border text-gray-900 focus:ring-gray-300 focus:border-gray-300 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                            {{ $menu['recipe_name'] ?? '未登録' }}
                        </a>

                        <span
                            class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#E7F2F7] md:bg-white border rounded-e-full border-[#E7F2F7] md:border-gray-300 border-s-0 rounded-s-0">
                            @if (!empty($menu['recipe_id']))
                                <a href="{{ route('recipes.show', ['recipe' => $menu['recipe_id']]) }}">
                                    <i class="fa-solid fa-circle-info fa-lg mr-2"></i>
                                </a>
                            @endif
                        </span>
                    </div>
                </div>
            @endforeach
        </main>
    </div>
</body>

</html>
