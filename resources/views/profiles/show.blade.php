@extends('layouts.master', ['fluidSection' => true])

@section('content')
    <div class="profile">
        <section class="pt-0 md:pt-8 pb-2" style="background-image: linear-gradient(to right, rgb(91, 121, 162) 0%, rgb(46, 68, 105) 100%);">
            <div class="pt-0 px-0 pb-1">
                <div class="container">
                    <div class="lg:flex max-w-sm mx-auto lg:max-w-full lg:mx-0">
                        <div class="profile-avatar mobile:mx-auto mobile:mb-6 lg:pr-6">
                            <div class="lg:block text-center">
                                <div class="relative flex flex-col items-center">
                                    <a href="{{ url('users/' . $user->id) }}"
                                       class="relative inline-flex items-start mb-2"
                                       style="width: 150px; height: 150px; padding: 2px;">
                                        <img
                                            :data-src="$auth.avatar"
                                            :src="$auth.avatar"
                                            loading="lazy"
                                            alt="{{ $user->username }} avatar"
                                            width="150"
                                            height="150"
                                            class="bg-white relative rounded-full text-black-transparent-10 mb-4 lg:mb-0 ls-is-cached lazyloaded"
                                            style="width: 100%; max-width: none; box-shadow: currentcolor 0 0 0 10px;"
                                        />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="lg:mr-6">
                            <div class="flex justify-between mb-8">
                                <div class="w-full flex flex-col items-center lg:items-start bg-black-transparent-10 rounded-xl py-4 px-7 text-white">
                                    <div class="flex">
                                        <h1 class="text-xl mobile:font-bold tracking-normal lg:mr-4 mb-1">{{ $user->username }}</h1>
                                        <div class="hidden xl:flex xl:justify-center xl:items-center leading-none">
                                            @isset($user->profile['twitter'])
                                            <a href="https://twitter.com/{{ $user->profile['twitter'] }}" target="_blank" rel="noreferrer" class="twitter block mr-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-transparent-25 hover:text-white" width="17" height="17" viewBox="0 0 30 30">
                                                    <path class="fill-current" fill-rule="nonzero" d="M14.896 0C6.682 0 0 6.674 0 14.877c0 8.202 6.682 14.876 14.896 14.876 8.212 0 14.895-6.674 14.895-14.876C29.791 6.674 23.11 0 14.896 0zm6.645 11.472c.006.147.01.296.01.444 0 4.525-3.448 9.74-9.756 9.74A9.707 9.707 0 0 1 6.54 20.12a6.887 6.887 0 0 0 5.076-1.418 3.431 3.431 0 0 1-3.203-2.378 3.46 3.46 0 0 0 1.548-.058 3.426 3.426 0 0 1-2.75-3.357l.001-.043c.462.255.99.41 1.552.427a3.42 3.42 0 0 1-1.06-4.571A9.739 9.739 0 0 0 14.77 12.3a3.426 3.426 0 0 1 3.34-4.205c.986 0 1.875.417 2.502 1.082a6.849 6.849 0 0 0 2.178-.831c-.258.8-.8 1.47-1.51 1.894a6.823 6.823 0 0 0 1.97-.538 6.891 6.891 0 0 1-1.71 1.77z"></path>
                                                </svg>
                                            </a>
                                            @endisset
                                            @isset($user->profile['github'])
                                            <a href="https://github.com/{{ $user->profile['github'] }}" target="_blank" rel="noreferrer" class="github">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 30 29" class="text-transparent-25 hover:text-white">
                                                    <path class="fill-current" fill-rule="nonzero" d="M27.959 7.434a14.866 14.866 0 0 0-5.453-5.414C20.21.69 17.703.025 14.984.025c-2.718 0-5.226.665-7.521 1.995A14.864 14.864 0 0 0 2.01 7.434C.67 9.714 0 12.202 0 14.901c0 3.242.953 6.156 2.858 8.746 1.906 2.589 4.367 4.38 7.385 5.375.351.064.611.019.78-.136a.755.755 0 0 0 .254-.58l-.01-1.047c-.007-.658-.01-1.233-.01-1.723l-.448.077a5.765 5.765 0 0 1-1.083.068 8.308 8.308 0 0 1-1.356-.136 3.04 3.04 0 0 1-1.308-.58c-.403-.304-.689-.701-.858-1.192l-.195-.445a4.834 4.834 0 0 0-.614-.988c-.28-.362-.563-.607-.85-.736l-.136-.097a1.428 1.428 0 0 1-.253-.233 1.062 1.062 0 0 1-.176-.271c-.039-.09-.007-.165.098-.223.104-.059.292-.087.566-.087l.39.058c.26.052.582.206.965.465.384.258.7.594.947 1.007.299.53.66.933 1.082 1.21.423.278.85.417 1.278.417.43 0 .8-.032 1.112-.097a3.9 3.9 0 0 0 .878-.29c.117-.866.436-1.53.956-1.996a13.447 13.447 0 0 1-2-.348 7.995 7.995 0 0 1-1.833-.756 5.244 5.244 0 0 1-1.571-1.298c-.416-.516-.758-1.195-1.024-2.034-.267-.84-.4-1.808-.4-2.905 0-1.563.514-2.893 1.541-3.99-.481-1.176-.436-2.493.137-3.952.377-.116.936-.03 1.678.261.741.291 1.284.54 1.629.746.345.207.621.381.83.523a13.948 13.948 0 0 1 3.745-.503c1.288 0 2.537.168 3.747.503l.741-.464c.507-.31 1.106-.595 1.795-.853.69-.258 1.216-.33 1.58-.213.586 1.46.638 2.777.156 3.951 1.028 1.098 1.542 2.428 1.542 3.99 0 1.099-.134 2.07-.4 2.916-.267.846-.611 1.524-1.034 2.034-.423.51-.95.94-1.58 1.288a8.01 8.01 0 0 1-1.834.756c-.592.155-1.259.271-2 .349.676.58 1.014 1.498 1.014 2.75v4.087c0 .232.081.426.244.58.163.155.42.2.77.136 3.019-.994 5.48-2.786 7.386-5.375 1.905-2.59 2.858-5.504 2.858-8.746 0-2.698-.671-5.187-2.01-7.466z"></path>
                                                </svg>
                                            </a>
                                            @endisset
                                        </div>
                                    </div>
                                    <p class="tracking-normal text-2xs mobile:text-sm">
                                        Member Since {{ $user->created_at->diffForHumans() }}
                                    </p>
                                    <p class="tracking-normal text-2xs mobile:text-sm">
                                        {{ $user->profile['location'] ?? 'Earth' }}
                                    </p>
                                    <avatar-form :user="{{ $user }}"></avatar-form>
                                </div>
                            </div>
                        </div>
                        <div class="lg:ml-auto">
                            <div class="flex justify-between lg:justify-end mb-4 lg:ml-auto">
                                <div data-tooltip-template="experience-explanation-template" class="experience-level-card transition-all text-center px-2 py-6 rounded-xl">
                                    <div class="flex items-center justify-center mb-2 lg:mb-4" style="height: 102px;">
                                        <img src="{{ asset('images/profiles/xp-level.svg') }}" alt="Experience Points" class="inline-block -mb-2" style="mix-blend-mode: luminosity;" />
                                    </div>
                                    <strong class="text-white text-2xl block mb-2">
                                        700,390
                                    </strong>
                                    <div class="text-sm text-transparent-50 leading-tight">
                                        Total<br />
                                        Experience
                                    </div>
                                    {{-- TODO: Tooltip feature --}}
                                    <div id="experience-explanation-template" class="hidden">
                                        <div class="px-2 w-64">
                                            <p class="italic border-b border-solid border-grey-light pb-2 mb-3"><strong class="text-blue">0</strong> experience to go until the next level!</p>
                                            <p class="mb-2"><strong>In case you were wondering, you earn Laracasts experience when you:</strong></p>
                                            <ul class="pl-4" style="list-style: disc;">
                                                <li>Complete a lesson <span class="text-blue font-bold">— 100pts</span></li>
                                                <li>Create a forum thread <span class="text-blue font-bold">— 50pts</span></li>
                                                <li>Reply to a thread <span class="text-blue font-bold">— 10pts</span></li>
                                                <li>Leave a reply that is liked <span class="text-blue font-bold">— 50pts</span></li>
                                                <li>Receive a "Best Reply" award <span class="text-blue font-bold">— 500pts</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="experience-level-card transition-all text-center px-2 py-6 rounded-xl mx-4">
                                    <div class="flex items-center justify-center mb-2 lg:mb-4" style="height: 102px;">
                                        <img src="{{ asset('images/profiles/xp-lesson.svg') }}" alt="Lessons Completed" class="inline-block -mb-2" style="mix-blend-mode: luminosity;" />
                                    </div>
                                    <strong class="text-white text-2xl block mb-2">288</strong>
                                    <div class="text-sm text-transparent-50 leading-tight">
                                        Lessons <br/>
                                        Completed
                                    </div>
                                </div>
                                <div class="experience-level-card transition-all text-center px-2 py-6 rounded-xl">
                                    <div class="flex items-center justify-center mb-2 lg:mb-4" style="height: 102px;">
                                        <img src="{{ asset('images/profiles/xp-stars.svg') }}" alt="Best Reply Awards" class="inline-block -mb-2" style="mix-blend-mode: luminosity;" />
                                    </div>
                                    <strong class="text-white text-2xl block mb-2">797</strong>
                                    <div class="text-sm text-transparent-50 leading-tight">
                                        Best Reply <br/>
                                        Awards
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @unless($items)
            <div class="section bg-grey-panel">
                <div class="py-3">
                    <div>
                        <ul role="tablist" class="flex justify-center mb-4 border-b border-gray-400 mb-8">
                            <li class="pb-1 lg:px-4 mx-4 mb-1 lg:text-xl border-blue border-b-2 border-solid">
                                <button role="tab"
                                        aria-selected="true"
                                        class="focus:outline-none text-black">
                                    Activity
                                </button>
                            </li>
                        </ul>
                        @include('profiles.activity')
                    </div>
                </div>
            </div>
        @endunless
    </div>
@endsection
