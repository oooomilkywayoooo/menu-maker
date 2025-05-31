<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/557c66cb53.js" crossorigin="anonymous"></script>
    <title>献立履歴画面</title>
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
                    <h1 class="mt-[86px] md:mt-6 text-3xl md:text-5xl font-black">献立履歴</h1>
                </div>
            </div>

            <!-- 献立履歴一覧 -->
            <div class="grid grid-cols-12 gap-4 mt-5 md:mt-7 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-5 md:col-start-3">
                    <a href="{{ route('show_menu_history') }}"
                        class="text-center rounded-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        2024年4月15日〜4月21日
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 mt-5 md:mt-7 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-5 md:col-start-3">
                    <a href="{{ route('show_menu_history') }}"
                        class="text-center rounded-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        2024年4月8日〜4月14日
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 mt-5 md:mt-7 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-5 md:col-start-3">
                    <a href="{{ route('show_menu_history') }}"
                        class="text-center rounded-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        2024年4月1日〜4月7日
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 mt-5 md:mt-7 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-5 md:col-start-3">
                    <a href="{{ route('show_menu_history') }}"
                        class="text-center rounded-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        2024年3月25日〜3月31日
                    </a>
                </div>
            </div>
        </main>
</body>

</html>
