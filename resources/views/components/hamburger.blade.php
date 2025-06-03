<header class="md:hidden h-16 w-full bg-[#F2E9D7] flex items-center justify-end pr-4 fixed z-[9999] top-0">
    <nav>
        <button id="button" type="button" class="fixed z-10 top-4 right-4">
            <i id="bars" class="fa-solid fa-bars fa-2x"></i>
            <i id="xmark" class="fa-solid fa-xmark fa-2x !hidden"></i>
        </button>
        <ul id="menu"
            class="z-0 fixed top-0 left-0 w-full text-center bg-[#FFE79F] font-bold
    translate-x-full transition ease-linear">
            <li class="p-2"><a href="{{ route('home') }}">ホーム</a></li>
            <li class="p-2"><a href="{{ route('recipes.create') }}">料理登録</a></li>
            <li class="p-2"><a href="{{ route('one_week_menu') }}">献立</a></li>
            <li class="p-2"><a href="{{ route('shopping_list') }}">買い物リスト</a></li>
            <li class="p-2"><a href="{{ route('favorite') }}">お気に入り</a></li>
            <li class="p-2"><a href="{{ route('menu_history') }}">献立履歴</a></li>
        </ul>
    </nav>
</header>
