@switch($recipe->genre_id)
    @case(1)
        <img class="w-full h-full object-cover" src="{{ asset('images/junre-icon/genre_fish.png') }}" alt="魚料理">
    @break

    @case(2)
        <img class="w-full h-full object-cover" src="{{ asset('images/junre-icon/genre_fried.png') }}" alt="揚げ物">
    @break

    @case(3)
        <img class="w-full h-full object-cover" src="{{ asset('images/junre-icon/genre_bake.png') }}" alt="炒め物">
    @break

    @case(4)
        <img class="w-full h-full object-cover" src="{{ asset('images/junre-icon/genre_noodles.png') }}" alt="麺料理">
    @break

    @case(5)
        <img class="w-full h-full object-cover" src="{{ asset('images/junre-icon/genre_don.png') }}" alt="丼もの">
    @break

    @case(6)
        <img class="w-full h-full object-cover" src="{{ asset('images/junre-icon/genre_other.png') }}" alt="その他">
    @break
@endswitch
