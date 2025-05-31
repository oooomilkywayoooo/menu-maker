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
                    <button type="button"
                        class="hidden md:block text-white bg-[#FDC3AA] hover:bg-[#f79f79] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-2xl px-5 py-2.5 me-2 mb-2">
                        <i class="fa-solid fa-circle-plus"></i>
                        追加
                    </button>
                    <!-- タブレット・スマホ用ボタン -->
                    <button type="button" class="block md:hidden">
                        <i class="fa-solid fa-circle-plus fa-2x"></i>
                    </button>
                </div>
            </div>

            <!-- チェックリスト -->
            <div class="grid grid-cols-12 gap-4 mt-5">
                <div class="col-start-2 col-span-10 md:col-start-1">
                    <div
                        class="flex items-center ps-4 border border-gray rounded-lg bg-[#E7F2F7] md:rounded-sm md:bg-white">
                        <input id="bordered-checkbox-1" type="checkbox" value="" name="bordered-checkbox"
                            class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                        <label for="bordered-checkbox-1" class="w-full py-2 ms-2 text-2xl text-[#000000]">玉ねぎ</label>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-4 mt-3">
                <div class="col-start-2 col-span-10 md:col-start-1">
                    <div
                        class="flex items-center ps-4 border border-gray rounded-lg bg-[#E7F2F7] md:rounded-sm md:bg-white">
                        <input id="bordered-checkbox-1" type="checkbox" value="" name="bordered-checkbox"
                            class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                        <label for="bordered-checkbox-1" class="w-full py-2 ms-2 text-2xl text-[#000000]">にんじん</label>
                    </div>
                </div>
            </div>

            <!-- 購入済み -->
            <div class="grid grid-cols-12 gap-4 mt-5 md:mt-10">
                <div class="col-start-2 col-span-4 md:col-start-1">
                    <p class="text-2xl md:text-3xl font-bold">購入済み</p>
                </div>
            </div>

            <!-- チェックリスト -->
            <div class="grid grid-cols-12 gap-4 mt-5">
                <div class="col-start-2 col-span-10 md:col-start-1">
                    <div
                        class="flex items-center ps-4 border border-gray rounded-lg bg-[#E7F2F7] md:rounded-sm md:bg-white">
                        <input id="bordered-checkbox-1" type="checkbox" value="" name="bordered-checkbox"
                            class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2"
                            checked>
                        <label for="bordered-checkbox-1"
                            class="w-full py-2 ms-2 text-2xl text-[#000000] line-through">牛乳</label>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-4 mt-3">
                <div class="col-start-2 col-span-10 md:col-start-1">
                    <div
                        class="flex items-center ps-4 border border-gray rounded-lg bg-[#E7F2F7] md:rounded-sm md:bg-white">
                        <input id="bordered-checkbox-1" type="checkbox" value="" name="bordered-checkbox"
                            class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2"
                            checked>
                        <label for="bordered-checkbox-1"
                            class="w-full py-2 ms-2 text-2xl text-[#000000] line-through">ヨーグルト</label>
                    </div>
                </div>
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
</body>
</html>
