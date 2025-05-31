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
                    <h1 class="mt-[86px] md:mt-6 text-3xl md:text-5xl font-black">○○〜○○の献立</h1>
                </div>
            </div>
            <!-- 献立一覧 -->
            <!-- 月曜日 -->
            <div class="grid grid-cols-12 gap-4 mt-5 md:mt-7 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-9 md:col-start-1">
                    <span
                        class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#FFC5AC] border rounded-e-0 border-[#FFC5AC] border-e-0 rounded-s-full">
                        <p class="text-xl md:text-2xl pr-2">月</p>
                        <div class="w-[26px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_fish.png')}}"
                                alt="魚料理">
                        </div>
                    </span>
                    <a href="#"
                        class="rounded-none rounded-e-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        ブリの照り焼き
                    </a>
                </div>
            </div>
            <!-- 火曜日 -->
            <div class="grid grid-cols-12 gap-4 mt-5 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-9 md:col-start-1">
                    <span
                        class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#FFC5AC] border rounded-e-0 border-[#FFC5AC] border-e-0 rounded-s-full">
                        <p class="text-xl md:text-2xl pr-2">火</p>
                        <div class="w-[26px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_fried.png')}}"
                                alt="揚げ物">
                        </div>
                    </span>
                    <a href="#"
                        class="rounded-none rounded-e-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        エビフライ
                    </a>
                </div>
            </div>
            <!-- 水曜日 -->
            <div class="grid grid-cols-12 gap-4 mt-5 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-9 md:col-start-1">
                    <span
                        class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#FFC5AC] border rounded-e-0 border-[#FFC5AC] border-e-0 rounded-s-full">
                        <p class="text-xl md:text-2xl pr-2">水</p>
                        <div class="w-[26px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_bake.png')}}"
                                alt="焼き物">
                        </div>
                    </span>
                    <a href="#"
                        class="rounded-none rounded-e-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        野菜炒め
                    </a>
                </div>
            </div>
            <!-- 木曜日 -->
            <div class="grid grid-cols-12 gap-4 mt-5 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-9 md:col-start-1">
                    <span
                        class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#FFC5AC] border rounded-e-0 border-[#FFC5AC] border-e-0 rounded-s-full">
                        <p class="text-xl md:text-2xl pr-2">木</p>
                        <div class="w-[26px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_noodles.png')}}"
                                alt="麺料理">
                        </div>
                    </span>
                    <a href="#"
                        class="rounded-none rounded-e-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        スパゲティ
                    </a>
                </div>
            </div>
            <!-- 金曜日 -->
            <div class="grid grid-cols-12 gap-4 mt-5 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-9 md:col-start-1">
                    <span
                        class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#FFC5AC] border rounded-e-0 border-[#FFC5AC] border-e-0 rounded-s-full">
                        <p class="text-xl md:text-2xl pr-2">金</p>
                        <div class="w-[26px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_don.png')}}"
                                alt="丼もの">
                        </div>
                    </span>
                    <a href="#"
                        class="rounded-none rounded-e-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        二食丼
                    </a>
                </div>
            </div>
            <!-- 土曜日 -->
            <div class="grid grid-cols-12 gap-4 mt-5 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-9 md:col-start-1">
                    <span
                        class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#FFC5AC] border rounded-e-0 border-[#FFC5AC] border-e-0 rounded-s-full">
                        <p class="text-xl md:text-2xl pr-2">土</p>
                        <div class="w-[26px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_other.png')}}"
                                alt="リクエスト">
                        </div>
                    </span>
                    <a href="#"
                        class="rounded-none rounded-e-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        海鮮丼
                    </a>
                </div>
            </div>
            <!-- 日曜日 -->
            <div class="grid grid-cols-12 gap-4 mt-5 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-9 md:col-start-1">
                    <span
                        class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#FFC5AC] border rounded-e-0 border-[#FFC5AC] border-e-0 rounded-s-full">
                        <p class="text-xl md:text-2xl pr-2">日</p>
                        <div class="w-[26px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_other.png')}}"
                                alt="リクエスト">
                        </div>
                    </span>
                    <a href="#"
                        class="rounded-none rounded-e-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        ハヤシライス
                    </a>
                </div>
            </div>
        </main>
</body>

</html>
