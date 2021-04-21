<ul class="mobile:hidden">
    @foreach($menu as $item)
        <li>
            <a href="{{ url('threads' . $item['query']) }}"
               class="{{ $item['isActive'] ? 'text-blue font-semibold border-blue-light bg-blue-lighter' : '' }} flex items-center mb-2 text-grey-dark text-sm mb-1 hover:text-blue hover:border-blue-light hover:bg-blue-lighter py-2 px-6 border border-solid border-black-transparent-3 rounded-xl"
               style="height: 41px;"
            >
                {!! $item['svg'] !!}
                {{ $item['name'] }}
            </a>
        </li>
    @endforeach
</ul>
