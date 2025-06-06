<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/557c66cb53.js" crossorigin="anonymous"></script>
    <title>料理一覧画面</title>
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
                    <h1 class="mt-[86px] md:mt-6 text-3xl md:text-5xl font-black">料理一覧</h1>
                </div>
            </div>

            <!-- 料理一覧 -->
            @foreach ($recipes as $recipe)
                <div class="grid grid-cols-12 gap-4 mt-5 md:mt-7 flex items-center">
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
                            @switch($recipe->genre_id)
                                @case(1)
                                    <div class="w-[26px] aspect-[1/1]">
                                        <img class="w-full h-full object-cover"
                                            src="{{ asset('images/junre-icon/genre_fish.png') }}" alt="魚料理">
                                    </div>
                                @break

                                @case(2)
                                    <div class="w-[26px] aspect-[1/1]">
                                        <img class="w-full h-full object-cover"
                                            src="{{ asset('images/junre-icon/genre_fried.png') }}" alt="揚げ物">
                                    </div>
                                @break

                                @case(3)
                                    <div class="w-[26px] aspect-[1/1]">
                                        <img class="w-full h-full object-cover"
                                            src="{{ asset('images/junre-icon/genre_bake.png') }}" alt="炒め物">
                                    </div>
                                @break

                                @case(4)
                                    <div class="w-[26px] aspect-[1/1]">
                                        <img class="w-full h-full object-cover"
                                            src="{{ asset('images/junre-icon/genre_noodles.png') }}" alt="麺料理">
                                    </div>
                                @break

                                @case(5)
                                    <div class="w-[26px] aspect-[1/1]">
                                        <img class="w-full h-full object-cover"
                                            src="{{ asset('images/junre-icon/genre_don.png') }}" alt="丼もの">
                                    </div>
                                @break

                                @case(6)
                                    <div class="w-[26px] aspect-[1/1]">
                                        <img class="w-full h-full object-cover"
                                            src="{{ asset('images/junre-icon/genre_other.png') }}" alt="その他">
                                    </div>
                                @break
                            @endswitch
                        </span>
                        <div
                            class="rounded-none rounded-e-full bg-[#E7F2F7] md:bg-white border text-gray-900 block flex-1 min-w-0 w-full text-lg border-[#E7F2F7] md:border-gray-300 p-2.5">
                            {{ $recipe->name }}
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
</body>

</html>
