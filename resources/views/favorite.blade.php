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
                    <div class="flex items-end justify-end">
                        <a href="{{ route('recipes.index') }}" class="text-[#5C4033] hover:text-[#42A5F5] mr-10 mt-2 md:mr-5 md:mt-0">
                            <i class="fa-solid fa-utensils pr-2"></i>
                            料理一覧
                        </a>
                    </div>
                </div>
            </div>

            <!-- お気に入り一覧 -->
            @foreach ($recipes as $recipe)
                <div class="grid grid-cols-12 gap-4 mt-5 flex items-center">
                    <div class="flex col-start-2 col-span-10 md:col-span-9 md:col-start-1">
                        <span
                            class="inline-flex items-center px-3 text-lg text-gray-900 bg-[#E7F2F7] md:bg-white border rounded-e-0 border-[#E7F2F7] md:border-gray-300 rounded-s-full">
                            <button class="star-btn" type="button" data-recipe-id="{{ $recipe->id }}">
                                @if ($recipe->favorite_flg)
                                    <i class="fa-solid fa-star fa-lg text-[#FFBF00] pr-2"></i>
                                @else
                                    <i class="fa-regular fa-star fa-lg pr-2"></i>
                                @endif
                            </button>
                            <!-- ジャンルIDごとのジャンル画像 -->
                            <div class="w-[26px] aspect-[1/1]">
                                @include('components.genre_switch')
                            </div>
                        </span>
                        <div
                            class="rounded-none rounded-e-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5 pl-10">
                            <a class="hover:text-[#42A5F5]" href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->name }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </main>
        <script>
            // お気に入り切り替え
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.star-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const recipeId = this.dataset.recipeId;

                        fetch(`/recipes/${recipeId}/toggle-favorite`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                const icon = this.querySelector('i');
                                if (data.favorite) {
                                    icon.classList.remove('fa-regular');
                                    icon.classList.add('fa-solid', 'text-[#FFBF00]');
                                } else {
                                    icon.classList.remove('fa-solid', 'text-[#FFBF00]');
                                    icon.classList.add('fa-regular');
                                }
                            });
                    });
                });
            });
        </script>
    </div>
</body>

</html>
