@extends('layouts.master', ['fluidSection' => true])

@section('content')
    <section style="background-image: linear-gradient(to right, rgb(91, 121, 162) 0%, rgb(46, 68, 105) 100%); height: 220px;">
        <header class="container text-center mx-auto h-full">
            <img src="{{ asset('images/lary-settings-banner.png') }}"
                 alt="Lary the mascot as a settings gear icon."
                 class="hidden md:inline-block absolute"
                 style="left: -70px; bottom: -40px; width: 50%; max-width: 696px; mix-blend-mode: luminosity;">
            <h3 class="text-white text-4xl font-semibold lg:font-normal">Account Settings</h3>
            <p class="text-transparent-50 text-lg">If you've got something to tweak.</p>
        </header>
    </section>
    <div class="section mb-10 pt-0">
        <div class="container border border-solid border-grey-panel bg-white rounded-xl p-8" style="margin-top: -40px; max-width: 970px;">
            <div class="md:flex mx-auto">
                @include('profiles.settings._nav')
                <div class="setting-section px-8 pb-0 lg:pr-0 flex-1 md:pt-0">
                    <div class="mb-10">
                        <user-account-form :user="{{ $user }}"></user-account-form>
                        <div class="mb-9"></div>
                        <user-profile-form></user-profile-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
