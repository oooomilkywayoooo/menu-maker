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

            <!-- 献立フォーム -->
            <form action="">
                <div class="grid grid-cols-12 gap-4 mt-5 md:mt-10 flex items-center">
                    <!-- 月曜日 -->
                    <div class="col-start-2 col-span-1 md:col-start-1">
                        <p class="text-xl md:text-3xl">月</p>
                    </div>
                    <!-- ジャンルアイコン -->
                    <div class="col-span-1">
                        <div class="w-[26px] md:w-[36px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_fish.png')}}"
                                alt="魚料理">
                        </div>
                    </div>
                    <!-- テキストエリア -->
                    <div class="col-span-8 md:col-span-9">
                        <input type="text" id="mon-create"
                            class="border border-gray-300 text-xs md:text-lg rounded-lg focus:ring-[#FDC3AA] focus:border-[#FDC3AA] block w-full p-2.5 placeholder-gray-300"
                            placeholder="食べたい料理を入力" required />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4 mt-6 flex items-center">
                    <!-- 火曜日 -->
                    <div class="col-start-2 col-span-1 md:col-start-1">
                        <p class="text-xl md:text-3xl">火</p>
                    </div>
                    <!-- ジャンルアイコン -->
                    <div class="col-span-1">
                        <div class="w-[26px] md:w-[36px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_fried.png')}}"
                                alt="揚げ物">
                        </div>
                    </div>
                    <!-- テキストエリア -->
                    <div class="col-span-8 md:col-span-9">
                        <input type="text" id="tue-create"
                            class="border border-gray-300 text-xs md:text-lg rounded-lg focus:ring-[#FDC3AA] focus:border-[#FDC3AA] block w-full p-2.5 placeholder-gray-300"
                            placeholder="食べたい料理を入力" required />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4 mt-6 flex items-center">
                    <!-- 水曜日 -->
                    <div class="col-start-2 col-span-1 md:col-start-1">
                        <p class="text-xl md:text-3xl">水</p>
                    </div>
                    <!-- ジャンルアイコン -->
                    <div class="col-span-1">
                        <div class="w-[26px] md:w-[36px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_bake.png')}}"
                                alt="焼き物">
                        </div>
                    </div>
                    <!-- テキストエリア -->
                    <div class="col-span-8 md:col-span-9">
                        <input type="text" id="wed-create"
                            class="border border-gray-300 text-xs md:text-lg rounded-lg focus:ring-[#FDC3AA] focus:border-[#FDC3AA] block w-full p-2.5 placeholder-gray-300"
                            placeholder="食べたい料理を入力" required />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4 mt-6 flex items-center">
                    <!-- 木曜日 -->
                    <div class="col-start-2 col-span-1 md:col-start-1">
                        <p class="text-xl md:text-3xl">木</p>
                    </div>
                    <!-- ジャンルアイコン -->
                    <div class="col-span-1">
                        <div class="w-[26px] md:w-[36px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_noodles.png')}}"
                                alt="麺料理">
                        </div>
                    </div>
                    <!-- テキストエリア -->
                    <div class="col-span-8 md:col-span-9">
                        <input type="text" id="thu-create"
                            class="border border-gray-300 text-xs md:text-lg rounded-lg focus:ring-[#FDC3AA] focus:border-[#FDC3AA] block w-full p-2.5 placeholder-gray-300"
                            placeholder="食べたい料理を入力" required />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4 mt-6 flex items-center">
                    <!-- 金曜日 -->
                    <div class="col-start-2 col-span-1 md:col-start-1">
                        <p class="text-xl md:text-3xl">金</p>
                    </div>
                    <!-- ジャンルアイコン -->
                    <div class="col-span-1">
                        <div class="w-[26px] md:w-[36px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_don.png')}}"
                                alt="丼もの">
                        </div>
                    </div>
                    <!-- テキストエリア -->
                    <div class="col-span-8 md:col-span-9">
                        <input type="text" id="fri-create"
                            class="border border-gray-300 text-xs md:text-lg rounded-lg focus:ring-[#FDC3AA] focus:border-[#FDC3AA] block w-full p-2.5 placeholder-gray-300"
                            placeholder="食べたい料理を入力" required />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4 mt-6 flex items-center">
                    <!-- 土曜日 -->
                    <div class="col-start-2 col-span-1 md:col-start-1">
                        <p class="text-xl md:text-3xl">土</p>
                    </div>
                    <!-- ジャンルアイコン -->
                    <div class="col-span-1">
                        <div class="w-[26px] md:w-[36px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_other.png')}}"
                                alt="リクエスト">
                        </div>
                    </div>
                    <!-- テキストエリア -->
                    <div class="col-span-8 md:col-span-9">
                        <input type="text" id="ast-create"
                            class="border border-gray-300 text-xs md:text-lg rounded-lg focus:ring-[#FDC3AA] focus:border-[#FDC3AA] block w-full p-2.5 placeholder-gray-300"
                            placeholder="食べたい料理を入力" required />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4 mt-6 flex items-center">
                    <!-- 日曜日 -->
                    <div class="col-start-2 col-span-1 md:col-start-1">
                        <p class="text-xl md:text-3xl">日</p>
                    </div>
                    <!-- ジャンルアイコン -->
                    <div class="col-span-1">
                        <div class="w-[26px] md:w-[36px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_other.png')}}"
                                alt="リクエスト">
                        </div>
                    </div>
                    <!-- テキストエリア -->
                    <div class="col-span-8 md:col-span-9">
                        <input type="text" id="sun-create"
                            class="border border-gray-300 text-xs md:text-lg rounded-lg focus:ring-[#FDC3AA] focus:border-[#FDC3AA] block w-full p-2.5 placeholder-gray-300"
                            placeholder="食べたい料理を入力" required />
                    </div>
                </div>
                <!-- 生成ボタン PC用 -->
                <div class="hidden md:grid grid-cols-12 gap-4 mt-3">
                    <div class="col-span-6 col-start-6 flex justify-end">
                        <button type="button"
                            class="text-white bg-[#FDC3AA] hover:bg-[#f79f79] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-2xl px-5 py-2.5 me-2 mb-2">
                            献立を生成
                        </button>
                    </div>
                </div>
                <!-- 生成ボタン スマホ用 -->
                <div class="md:hidden grid grid-cols-12 gap-4">
                    <div class="col-span-8 col-start-3 flex justify-center">
                        <button type="button"
                            class="text-white bg-[#F9C7C0] focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-2xl px-10 py-4 my-4">
                            献立を生成
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</body>

</html>
