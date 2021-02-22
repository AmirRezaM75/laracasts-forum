@push('styles')
    <style type="text/css">
        .v--modal-block-scroll {
            overflow: hidden;
            width: 100vw;
        }
        .v--modal-overlay {
            position: fixed;
            box-sizing: border-box;
            left: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.2);
            z-index: 999;
            opacity: 1;
        }
        .v--modal-overlay.scrollable {
            height: 100%;
            min-height: 100vh;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }
        .v--modal-overlay .v--modal-background-click {
            width: 100%;
            min-height: 100%;
            height: auto;
        }
        .v--modal-overlay .v--modal-box {
            position: relative;
            overflow: hidden;
            box-sizing: border-box;
        }
        .v--modal-overlay.scrollable .v--modal-box {
            margin-bottom: 2px;
        }
        .v--modal {
            background-color: white;
            text-align: left;
            border-radius: 3px;
            box-shadow: 0 20px 60px -2px rgba(27, 33, 58, 0.4);
            padding: 0;
        }
        .v--modal.v--modal-fullscreen {
            width: 100vw;
            height: 100vh;
            margin: 0;
            left: 0;
            top: 0;
        }
        .v--modal-top-right {
            display: block;
            position: absolute;
            right: 0;
            top: 0;
        }
        .overlay-fade-enter-active,
        .overlay-fade-leave-active {
            transition: all 0.2s;
        }
        .overlay-fade-enter,
        .overlay-fade-leave-active {
            opacity: 0;
        }
        .nice-modal-fade-enter-active,
        .nice-modal-fade-leave-active {
            transition: all 0.4s;
        }
        .nice-modal-fade-enter,
        .nice-modal-fade-leave-active {
            opacity: 0;
            transform: translateY(-20px);
        }

        .v--modal-overlay[data-modal="reply-modal"] {
            background: transparent !important;
            pointer-events: none;
        }
    </style>
@endpush

<div aria-expanded="true" data-modal="{{ $id }}" class="v--modal-overlay hidden">
    <div class="v--modal-background-click">
        <div class="v--modal-top-right"></div>
        <div role="dialog" aria-modal="true" class="v--modal-box v--modal conversation-modal" style="top: 319px; left: 235px; width: 800px; height: auto;">
            <div class="pointer-events-auto flex py-8 px-10 md:px-8 md:py-6">
                <div class="flex-1">
                    <form method="POST" action="{{ $action }}" autocomplete="off">
                        @csrf
                        @if($id === 'reply-modal')
                            <div class="control flex items-center">
                                <svg height="16px" version="1.1" viewBox="0 0 16 16" width="16px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current text-grey-dark mr-2">
                                    <g fill="none" fill-rule="evenodd" id="Icons with numbers" stroke="none" stroke-width="1">
                                        <g id="Group" transform="translate(0.000000, -336.000000)" class="fill-current">
                                            <path d="M0,344 L6,339 L6,342 C10.5,342 14,343 16,348 C13,345.5 10,345 6,346 L6,349 L0,344 L0,344 Z M0,344"></path>
                                        </g>
                                    </g>
                                </svg>
                                <p class="font-bold">
                                    Reply to
                                    <strong class="text-blue uppercase"></strong>
                                </p>
                            </div>
                        @else
                            <div class="md:flex-1 mr-4 mb-2 md:mb-0">
                                <label for="title">
                                    <input
                                        type="text"
                                        id="title"
                                        name="title"
                                        placeholder="Add a Title"
                                        required
                                        class="input placeholder-grey-darkest font-bold text-black border-0 p-0 py-2 h-auto"
                                    />
                                </label>
                            </div>
                        @endif
                        <div class="control">
                            <textarea
                                name="body"
                                id="body"
                                data-autosize=""
                                required="required"
                                class="textarea mb-1 border-l-0 border-r-0 px-0 py-4 text-sm focus:border-grey-light"
                                data-tribute="true"
                                style="min-height: 150px; max-height: 45vh; overflow: hidden; overflow-wrap: break-word; resize: none; height: 150px;"
                            ></textarea>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="mobile:hidden flex items-center text-xs mb-2">
                                    <label for="show_profile" class="switch mr-2">
                                        <input id="show_profile" name="show_profile" type="checkbox" disabled="disabled" />
                                        <div class="slider round cursor-not-allowed"></div>
                                    </label>
                                    <span class="mr-3 font-semibold text-2xs text-grey-30">Markdown Preview OFF</span>
                                </div>
                                <div class="flex">
                                    <div class="flex-1 help">
                                        <p class="mobile:hidden text-grey-30 text-2xs">
                                            * You may use Markdown with
                                            <a href="https://help.github.com/articles/creating-and-highlighting-code-blocks/" target="_blank" rel="noreferrer noopener">
                                                GitHub-flavored
                                            </a>
                                            code blocks.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mobile:flex mobile:w-full mobile:justify-center">
                                <button data-toggle="modal" data-target="{{ $id }}" class="btn mr-4 md:py-25">
                                    Cancel
                                </button>
                                <button type="submit" title="Cmd + Enter" class="md:py-25 mobile:flex-1 btn btn-blue">
                                    Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!---->
        </div>
    </div>
</div>
