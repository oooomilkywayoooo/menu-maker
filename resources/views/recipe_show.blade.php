<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/557c66cb53.js" crossorigin="anonymous"></script>
    <title>料理詳細画面</title>
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
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mt-10">
                <div class="md:col-span-2 md:h-[400px]">
                    <img src="{{ asset('storage/' . $recipe->image_path) }}" alt="料理画像">
                </div>
                {{-- 料理詳細 --}}
                <div class="md:col-span-2 bg-[#F5F7FA] shadow-md p-4 rounded-md">
                    <h1 class="p-2.5 font-bold text-3xl">{{ $recipe->name }}</h1>
                    <span class="flex ml-3">
                        {{-- ジャンルごとのジャンル画像 --}}
                        <div class="w-[26px] aspect-[1/1]">
                            @include('components.genre_switch')
                        </div>
                        <p class="pl-2">{{ $recipe->genre->name }}</p>
                    </span>
                    <p class="text-xl p-3">材料</p>
                    <ul class="list-disc pl-10">
                        @foreach (json_decode($recipe->materials, true) as $material)
                            <li>{{ $material }}</li>
                        @endforeach
                    </ul>
                    @if ($recipe->memo)
                        <p class="text-xl p-3">メモ</p>
                        <p class="pl-5">{{ $recipe->memo }}</p>
                    @endif
                    @if ($recipe->url)
                        <a href="{{ $recipe->url }}" target="_blank" rel="noopener noreferrer" class="flex items-center text-base p-3 hover:text-[#42A5F5]">
                            <i class="fa-solid fa-link"></i>
                            <p>参考サイトを開く</p>
                        </a>
                    @endif
                </div>
            </div>
            <div class="hidden md:grid grid-cols-5 gap-4 mt-5">
                <div class="col-start-4 col-span-1 text-end">
                    <!-- 編集ボタン PC用 -->
                    <button type="button"
                        class="text-white bg-[#FDC3AA] hover:bg-[#f79f79] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 me-2 mb-2">
                        編集
                    </button>
                </div>
            </div>
            <!-- 確定ボタン スマホ用 -->
            <div class="md:hidden grid grid-cols-12 gap-4">
                <div class="col-span-8 col-start-3 flex justify-center">
                    <button type="button"
                        class="text-white bg-[#F9C7C0] focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-2xl px-20 py-4 my-4">
                        編集
                    </button>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
