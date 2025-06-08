<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/557c66cb53.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <title>1週間献立画面</title>
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
                    <h1 class="mt-[86px] md:mt-6 text-3xl md:text-5xl font-black">1週間の献立</h1>
                </div>
            </div>
            <!-- カレンダー -->
            <div class="mt-5 md:mt-7">
                <div class="flex items-center justify-center md:justify-start">
                    <div class="relative w-36">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input id="datepicker-start" name="start" type="text"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FDC3AA] focus:border-[#FDC3AA] block w-full ps-10 p-2.5 placeholder-gray-300"
                            placeholder="開始日">
                    </div>
                    <span class="mx-4 text-gray-500">〜</span>
                    <div class="relative w-36">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input id="datepicker-end" name="end" type="text"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FDC3AA] focus:border-[#FDC3AA] block w-full ps-10 p-2.5 placeholder-gray-300"
                            placeholder="1週間後" readonly>
                    </div>
                </div>
            </div>

            <!-- 献立一覧 -->
            <form action="">
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
                        <input type="text" id="mon-menu"
                            class="pointer-events-none rounded-none border-e-0 bg-[#E7F2F7] md:bg-white border text-gray-900 focus:ring-gray-300 focus:border-gray-300 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5"
                            placeholder="ブリの照り焼き" readonly>
                        <span
                            class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#E7F2F7] md:bg-white border rounded-e-full border-[#E7F2F7] md:border-gray-300 border-s-0 rounded-s-0">
                            <button class="star-btn" type="button">
                                <i class="fa-regular fa-star fa-lg pr-2"></i>
                            </button>
                            <button class="star-btn" type="button">
                                <i class="fa-solid fa-star fa-lg text-[#FFBF00] pr-2 !hidden"></i>
                            </button>
                            <button id="reload" type="button">
                                <i class="fa-solid fa-arrows-rotate fa-lg"></i>
                            </button>
                        </span>
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
                        <input type="text" id="tue-menu"
                            class="pointer-events-none rounded-none border-e-0 bg-[#E7F2F7] md:bg-white border text-gray-900 focus:ring-gray-300 focus:border-gray-300 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5"
                            placeholder="エビフライ" readonly>
                        <span
                            class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#E7F2F7] md:bg-white border rounded-e-full border-[#E7F2F7] md:border-gray-300 border-s-0 rounded-s-0">
                            <button class="star-btn" type="button">
                                <i class="fa-regular fa-star fa-lg pr-2"></i>
                            </button>
                            <button class="star-btn" type="button">
                                <i class="fa-solid fa-star fa-lg text-[#FFBF00] pr-2 !hidden"></i>
                            </button>
                            <button id="reload" type="button">
                                <i class="fa-solid fa-arrows-rotate fa-lg"></i>
                            </button>
                        </span>
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
                        <input type="text" id="wed-menu"
                            class="pointer-events-none rounded-none border-e-0 bg-[#E7F2F7] md:bg-white border text-gray-900 focus:ring-gray-300 focus:border-gray-300 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5"
                            placeholder="野菜炒め" readonly>
                        <span
                            class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#E7F2F7] md:bg-white border rounded-e-full border-[#E7F2F7] md:border-gray-300 border-s-0 rounded-s-0">
                            <button class="star-btn" type="button">
                                <i class="fa-regular fa-star fa-lg pr-2"></i>
                            </button>
                            <button class="star-btn" type="button">
                                <i class="fa-solid fa-star fa-lg text-[#FFBF00] pr-2 !hidden"></i>
                            </button>
                            <button id="reload" type="button">
                                <i class="fa-solid fa-arrows-rotate fa-lg"></i>
                            </button>
                        </span>
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
                        <input type="text" id="thu-menu"
                            class="pointer-events-none rounded-none border-e-0 bg-[#E7F2F7] md:bg-white border text-gray-900 focus:ring-gray-300 focus:border-gray-300 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5"
                            placeholder="スパゲティ" readonly>
                        <span
                            class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#E7F2F7] md:bg-white border rounded-e-full border-[#E7F2F7] md:border-gray-300 border-s-0 rounded-s-0">
                            <button class="star-btn" type="button">
                                <i class="fa-regular fa-star fa-lg pr-2"></i>
                            </button>
                            <button class="star-btn" type="button">
                                <i class="fa-solid fa-star fa-lg text-[#FFBF00] pr-2 !hidden"></i>
                            </button>
                            <button id="reload" type="button">
                                <i class="fa-solid fa-arrows-rotate fa-lg"></i>
                            </button>
                        </span>
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
                        <input type="text" id="fri-menu"
                            class="pointer-events-none rounded-none border-e-0 bg-[#E7F2F7] md:bg-white border text-gray-900 focus:ring-gray-300 focus:border-gray-300 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5"
                            placeholder="二食丼" readonly>
                        <span
                            class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#E7F2F7] md:bg-white border rounded-e-full border-[#E7F2F7] md:border-gray-300 border-s-0 rounded-s-0">
                            <button class="star-btn" type="button">
                                <i class="fa-regular fa-star fa-lg pr-2"></i>
                            </button>
                            <button class="star-btn" type="button">
                                <i class="fa-solid fa-star fa-lg text-[#FFBF00] pr-2 !hidden"></i>
                            </button>
                            <button id="reload" type="button">
                                <i class="fa-solid fa-arrows-rotate fa-lg"></i>
                            </button>
                        </span>
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
                        <input type="text" id="sat-menu"
                            class="pointer-events-none rounded-none border-e-0 bg-[#E7F2F7] md:bg-white border text-gray-900 focus:ring-gray-300 focus:border-gray-300 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5"
                            placeholder="海鮮丼" readonly>
                        <span
                            class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#E7F2F7] md:bg-white border rounded-e-full border-[#E7F2F7] md:border-gray-300 border-s-0 rounded-s-0">
                            <button class="star-btn" type="button">
                                <i class="fa-regular fa-star fa-lg pr-2"></i>
                            </button>
                            <button class="star-btn" type="button">
                                <i class="fa-solid fa-star fa-lg text-[#FFBF00] pr-2 !hidden"></i>
                            </button>
                            <button id="reload" type="button">
                                <i class="fa-solid fa-arrows-rotate fa-lg"></i>
                            </button>
                        </span>
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
                        <input type="text" id="sun-menu"
                            class="pointer-events-none rounded-none border-e-0 bg-[#E7F2F7] md:bg-white border text-gray-900 focus:ring-gray-300 focus:border-gray-300 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5"
                            placeholder="ハヤシライス" readonly>
                        <span
                            class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#E7F2F7] md:bg-white border rounded-e-full border-[#E7F2F7] md:border-gray-300 border-s-0 rounded-s-0">
                            <button class="star-btn" type="button">
                                <i class="fa-regular fa-star fa-lg pr-2"></i>
                            </button>
                            <button class="star-btn" type="button">
                                <i class="fa-solid fa-star fa-lg text-[#FFBF00] pr-2 !hidden"></i>
                            </button>
                            <button id="reload" type="button">
                                <i class="fa-solid fa-arrows-rotate fa-lg"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <!-- 確定ボタン PC用 -->
                <div class="hidden md:grid grid-cols-12 gap-4">
                    <div class="col-span-6 col-start-6 flex justify-end">
                        <button type="button"
                            class="text-white bg-[#FDC3AA] hover:bg-[#f79f79] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 me-2 mb-2">
                            確定
                        </button>
                    </div>
                </div>
                <!-- 確定ボタン スマホ用 -->
                <div class="md:hidden grid grid-cols-12 gap-4">
                    <div class="col-span-8 col-start-3 flex justify-center">
                        <button type="button"
                            class="text-white bg-[#F9C7C0] focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-2xl px-20 py-4 my-4">
                            確定
                        </button>
                    </div>
                </div>
            </form>
        </main>
        <script>
            // カレンダー選択
            document.addEventListener("DOMContentLoaded", function() {
                const startInput = document.getElementById("datepicker-start");
                const endInput = document.getElementById("datepicker-end");

                flatpickr(startInput, {
                    dateFormat: "Y-m-d",
                    onChange: function(selectedDates) {
                        if (selectedDates.length > 0) {
                            const startDate = selectedDates[0];
                            const endDate = new Date(startDate);
                            endDate.setDate(startDate.getDate() + 7); // 7日後を計算

                            // 終了日に自動で日付を表示（フォーマット変換）
                            endInput.value = endDate.toISOString().split('T')[0];
                        }
                    }
                });
            });
            //お気に入りボタン切り替え
            document.querySelectorAll('.star-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const span = btn.closest('span'); // ボタンが含まれる span を取得
                    const stars = span.querySelectorAll('.star-btn');

                    stars.forEach(starBtn => {
                        const icon = starBtn.querySelector('i');
                        if (icon.classList.contains('!hidden')) {
                            icon.classList.remove('!hidden');
                        } else {
                            icon.classList.add('!hidden');
                        }
                    });
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>
