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
                                            data-src="{{ $user->avatar }}"
                                            loading="lazy"
                                            alt="{{ $user->username }} avatar"
                                            width="150"
                                            height="150"
                                            class="bg-white relative rounded-full text-black-transparent-10 mb-4 lg:mb-0 ls-is-cached lazyloaded"
                                            style="width: 100%; max-width: none; box-shadow: currentcolor 0 0 0 10px;"
                                            src="{{ $user->avatar }}"
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
                                        <div class="hidden xl:flex xl:justify-center xl:items-center leading-none"></div>
                                    </div>
                                    <p class="tracking-normal text-2xs mobile:text-sm">
                                        Member Since {{ $user->created_at->diffForHumans() }}
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
    </div>
@endsection
