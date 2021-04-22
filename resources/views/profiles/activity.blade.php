<div role="tabpanel">
    <div class="container">
        <div class="lg:w-2/3 lg:mx-auto">
            @foreach($items as $date => $activities)
                @php
                    $date = Illuminate\Support\Carbon::createFromDate($date);
                @endphp
                <div class="flex timeline-section">
                    <div class="timeline-date mr-3">
                        <div class="text-right inline-block">
                            <div class="flex font-bold uppercase text-xs lg:text-sm text-black mb-1">
                                <div
                                    class="flex items-center justify-center font-semibold bg-white border border-solid border-blue-light rounded-lg w-10 mr-1 text-xs h-7"
                                    style="box-shadow: rgba(36, 37, 38, 0.08) 4px 4px 15px 0px;"
                                >
                                    {{ $date->isoFormat('MMM') }}
                                </div>
                                <div
                                    class="flex items-center justify-center bg-white border border-solid border-blue-light rounded-lg w-10 text-lg h-7"
                                    style="box-shadow: rgba(36, 37, 38, 0.08) 4px 4px 15px 0px;"
                                >
                                    {{ $date->isoFormat('DD') }}
                                </div>
                            </div>
                            <div class="text-grey-dark font-semibold text-2xs">
                                {{ $date->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    <div class="timeline-contents flex-1">
                        @foreach($activities as $activity)
                            @includeWhen(view()->exists($view = "profiles.activities.{$activity->type}"), $view)
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.user-content pre code')
                .forEach(function (dom) {
                    return hljs.highlightBlock(dom)
                })
        })
    </script>
@endpush
