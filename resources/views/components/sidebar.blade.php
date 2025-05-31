<aside class="hidden md:flex items-center justify-center col-span-3">
    <div>
        <div class="m-3">
            <a href="{{ route('home') }}"
                class="w-20 h-20  bg-[#E7DBDA] text-white font-semibold rounded-full hover:bg-[#e8c7c5] flex items-center justify-center">
                <img class="w-14 h-14" src="{{ asset('images/sidebar-icon/sidebar_home.png') }}" alt="ホームボタン">
            </a>
        </div>
        <div class="m-3">
            <a href="{{ route('add_cooking') }}"
                class="w-20 h-20  bg-[#E7DBDA] text-white font-semibold rounded-full hover:bg-[#e8c7c5] flex items-center justify-center">
                <img class="w-14 h-14" src="{{ asset('images/sidebar-icon/sidebar_add.png') }}" alt="料理追加ボタン">
            </a>
        </div>
        <div class="m-3">
            <a href="{{ route('one_week_menu') }}"
                class="w-20 h-20  bg-[#E7DBDA] text-white font-semibold rounded-full hover:bg-[#e8c7c5] flex items-center justify-center">
                <img class="w-14 h-14" src="{{ asset('images/sidebar-icon/sidebar_dinner.png') }}" alt="献立ボタン">
            </a>
        </div>
        <div class="m-3">
            <a href="{{ route('shopping_list') }}"
                class="w-20 h-20  bg-[#E7DBDA] text-white font-semibold rounded-full hover:bg-[#e8c7c5] flex items-center justify-center">
                <img class="w-14 h-14" src="{{ asset('images/sidebar-icon/sidebar_list.png') }}" alt="買い物リストボタン">
            </a>
        </div>
        <div class="m-3">
            <a href="{{ route('favorite') }}"
                class="w-20 h-20  bg-[#E7DBDA] text-white font-semibold rounded-full hover:bg-[#e8c7c5] flex items-center justify-center">
                <img class="w-14 h-14" src="{{ asset('images/sidebar-icon/sidebar_star.png') }}" alt="お気に入りボタン">
            </a>
        </div>
        <div class="m-3">
            <a href="{{ route('menu_history') }}"
                class="w-20 h-20  bg-[#E7DBDA] text-white font-semibold rounded-full hover:bg-[#e8c7c5] flex items-center justify-center">
                <img class="w-14 h-14" src="{{ asset('images/sidebar-icon/sidebar_history.png') }}" alt="献立履歴ボタン">
            </a>
        </div>
    </div>
</aside>
