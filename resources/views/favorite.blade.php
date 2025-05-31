<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/557c66cb53.js" crossorigin="anonymous"></script>
    <title>お気に入り画面</title>
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
                    <h1 class="mt-[86px] md:mt-6 text-3xl md:text-5xl font-black">お気に入り</h1>
                </div>
            </div>

            <!-- お気に入り一覧 -->
            <div class="grid grid-cols-12 gap-4 mt-5 md:mt-7 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-9 md:col-start-1">
                    <span
                        class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#E7F2F7] md:bg-white border rounded-e-0 border-[#E7F2F7] md:border-gray-300 rounded-s-full">
                        <button class="star-btn" type="button">
                            <i class="fa-solid fa-star fa-lg text-[#FFBF00] pr-2"></i>
                        </button>
                        <button class="star-btn" type="button">
                            <i class="fa-regular fa-star fa-lg pr-2 !hidden"></i>
                        </button>
                        <div class="w-[26px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_other.png')}}"
                                alt="リクエスト">
                        </div>
                    </span>
                    <div
                        class="rounded-none rounded-e-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        ハヤシライス
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 mt-5 md:mt-7 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-9 md:col-start-1">
                    <span
                        class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#E7F2F7] md:bg-white border rounded-e-0 border-[#E7F2F7] md:border-gray-300 rounded-s-full">
                        <button class="star-btn" type="button">
                            <i class="fa-solid fa-star fa-lg text-[#FFBF00] pr-2"></i>
                        </button>
                        <button class="star-btn" type="button">
                            <i class="fa-regular fa-star fa-lg pr-2 !hidden"></i>
                        </button>
                        <div class="w-[26px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_other.png')}}"
                                alt="リクエスト">
                        </div>
                    </span>
                    <div
                        class="rounded-none rounded-e-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        海鮮丼
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 mt-5 md:mt-7 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-9 md:col-start-1">
                    <span
                        class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#E7F2F7] md:bg-white border rounded-e-0 border-[#E7F2F7] md:border-gray-300 rounded-s-full">
                        <button class="star-btn" type="button">
                            <i class="fa-solid fa-star fa-lg text-[#FFBF00] pr-2"></i>
                        </button>
                        <button class="star-btn" type="button">
                            <i class="fa-regular fa-star fa-lg pr-2 !hidden"></i>
                        </button>
                        <div class="w-[26px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_fried.png')}}"
                                alt="揚げ物">
                        </div>
                    </span>
                    <div
                        class="rounded-none rounded-e-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        エビフライ
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 mt-5 md:mt-7 flex items-center">
                <div class="flex col-start-2 col-span-10 md:col-span-9 md:col-start-1">
                    <span
                        class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#E7F2F7] md:bg-white border rounded-e-0 border-[#E7F2F7] md:border-gray-300 rounded-s-full">
                        <button class="star-btn" type="button">
                            <i class="fa-solid fa-star fa-lg text-[#FFBF00] pr-2"></i>
                        </button>
                        <button class="star-btn" type="button">
                            <i class="fa-regular fa-star fa-lg pr-2 !hidden"></i>
                        </button>
                        <div class="w-[26px] aspect-[1/1]">
                            <img class="w-full h-full object-cover" src="{{asset('images/junre-icon/genre_don.png')}}"
                                alt="丼もの">
                        </div>
                    </span>
                    <div
                        class="rounded-none rounded-e-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                        二食丼
                    </div>
                </div>
            </div>
        </main>
        <script>
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
</body>

</html>
