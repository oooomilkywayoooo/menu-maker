<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/557c66cb53.js" crossorigin="anonymous"></script>
    <title>料理編集画面</title>
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
                    <h1 class="mt-[86px] md:mt-6 text-3xl md:text-5xl font-black">{{ $recipe->name }}の編集</h1>
                </div>
            </div>

            <!-- 更新フォーム -->
            <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')  {{-- これが必要！ --}}
                @if ($recipe->image_path)
                <div class="grid grid-cols-12 gap-4 mt-7 md:mt-10">
                    <div class="mt-2 col-start-3 col-span-8 md:col-start-2 md:col-span-3">
                        <img src="{{ asset('storage/' . $recipe->image_path) }}" alt="現在の画像"
                            class="w-48 rounded">
                    </div>
                </div>
                @endif
                <div class="grid grid-cols-12 gap-4 mt-7 md:mt-10">
                    @if ($recipe->image_path)
                        <input type="hidden" name="existing_image" value="{{ $recipe->image_path }}">
                    @endif
                    <div class="col-start-3 md:col-start-2 col-span-8">
                        <!-- 画像選択 PC用 -->
                        <div class="hidden md:flex items-center space-x-2">
                            <!-- ファイル名表示 -->
                            <input type="text" id="filename_display" placeholder="料理画像を選択"
                                class="flex-1 text-sm border-2 border-[#eae4d9] rounded-lg px-3 py-2 bg-white placeholder-gray-300 focus:ring-[#F9C9B4] focus:border-[#F9C9B4]"
                                readonly>

                            <!-- カスタム参照ボタン -->
                            <label for="file_input"
                                class="inline-block px-8 py-2 text-white bg-[#F9C9B4] rounded-lg cursor-pointer hover:bg-[#f9a581] text-sm">
                                参照
                            </label>

                            <!-- 実際のファイル入力（非表示） -->
                            <input type="file" name="image" id="file_input" accept="image/*" class="hidden"
                                onchange="document.getElementById('filename_display').value = this.files[0]?.name || ''">
                        </div>

                        <!-- 画像選択 スマホ用 -->
                        <div class="flex items-center justify-center w-full md:hidden">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-36 border-2 border-[#eae4d9] border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i
                                        class="fa-solid fa-circle-plus fa-2x ps-2 text-[#F9C9B4] hover:text-[#f79f79]"></i>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">料理画像</p>
                                </div>
                                <input id="dropzone-file" type="file" name="image" accept="image/*"
                                    class="hidden" />
                            </label>
                        </div>
                    </div>
                </div>

                <!-- 料理名 -->
                <div class="grid grid-cols-12 gap-4 mt-2 md:mt-5">
                    <div class="col-start-3 md:col-start-2 col-span-8">
                        <input type="text" name="name" id="cooking_name" value="{{ old('name', $recipe->name) }}"
                            class="w-full text-sm border-2 border-[#eae4d9] rounded-lg px-3 py-2 bg-white placeholder-gray-300 focus:ring-[#F9C9B4] focus:border-[#F9C9B4]">
                    </div>
                </div>

                <!-- ジャンル -->
                <div class="grid grid-cols-12 gap-4 mt-2 md:mt-5">
                    <div class="col-start-3 md:col-start-2 col-span-8">
                        <select name="genre_id" id="genre"
                            class="bg-white border-2 border-[#eae4d9] text-gray-300 text-sm rounded-lg focus:ring-[#F9C9B4] focus:border-[#F9C9B4] block w-full p-2.5">
                            <option value="" selected>ジャンル</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}"
                                    {{ old('genre_id', $recipe->genre_id) == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- 材料 -->
                <div id="material_container" class="space-y-2">
                    @foreach (old('materials', json_decode($recipe->materials, true)) as $index => $material)
                        <div class="container grid grid-cols-12 gap-4 mt-2 md:mt-5">
                            <div class="col-start-3 md:col-start-2 col-span-8 flex items-center">
                                <input type="text" name="materials[]" value="{{ $material }}"
                                    class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 bg-white placeholder-gray-300 focus:ring-[#F9C9B4] focus:border-[#F9C9B4]">
                                @if ($index === 0)
                                    <!-- 最初の材料：追加ボタン -->
                                    <button type="button" id="add_material">
                                        <i
                                            class="fa-solid fa-circle-plus fa-2x ps-2 text-[#F9C9B4] hover:text-[#f79f79]"></i>
                                    </button>
                                @else
                                    <button type="button" class="delete_material">
                                        <i class="fa-solid fa-circle-xmark fa-2x ps-2" style="color:#f26f37;"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- 作り方メモ -->
                <div class="grid grid-cols-12 gap-4 mt-2 md:mt-5">
                    <div class="col-start-3 md:col-start-2 col-span-8">
                        <textarea name="memo" id="memo" rows="4"
                            class="block p-2.5 w-full text-sm text-black bg-white rounded-lg border-2 
                                border-[#eae4d9] focus:ring-[#F9C9B4] focus:border-[#F9C9B4] placeholder-gray-300">{{ old('memo', $recipe->memo) }}</textarea>
                    </div>
                </div>

                <!-- 参考URL -->
                <div class="grid grid-cols-12 gap-4 mt-2 md:mt-5">
                    <div class="col-start-3 md:col-start-2 col-span-8">
                        <input type="url" name="url" id="url" value="{{ old('url', $recipe->url) }}"
                            class="w-full text-sm border-2 border-[#eae4d9] rounded-lg px-3 py-2 bg-white placeholder-gray-300 focus:ring-[#F9C9B4] focus:border-[#F9C9B4]">
                    </div>
                </div>

                <!-- 登録ボタン PC用 -->
                <div class="hidden md:grid grid-cols-12 gap-4 mt-5">
                    <div class="col-span-2 col-start-5 flex justify-center">
                        <button type="submit"
                            class="text-white bg-[#FDC3AA] hover:bg-[#f79f79] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-2xl px-5 py-2.5 me-2 mb-2">
                            編集
                        </button>
                    </div>
                </div>
                <!-- 登録ボタン スマホ用 -->
                <div class="md:hidden grid grid-cols-12 gap-4 mt-2">
                    <div class="col-span-8 col-start-3 flex justify-center">
                        <button type="submit"
                            class="text-white bg-[#F9C7C0] focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-2xl px-20 py-4 my-4">
                            編集
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>
    {{-- 画像選択時のinput切り替え --}}
    <script>
        document.querySelector('form').addEventListener('submit', function() {
            const pcInput = document.getElementById('file_input');
            const spInput = document.getElementById('dropzone-file');

            if (pcInput.files.length > 0) {
                pcInput.name = "image";
                spInput.name = "";
            } else if (spInput.files.length > 0) {
                spInput.name = "image";
                pcInput.name = "";
            }
        });
    </script>
</body>

</html>
