<div class="timeline-contents-item bg-white rounded-xl mb-5 p-6">
    <div class="timeline-contents-activity h-full absolute flex justify-center" style="top: 60px; left: -53px;">
        <div
            class="timeline-contents-activity-icon flex items-center justify-center rounded-full bg-white p-2 w-10 h-10"
            style="box-shadow: rgba(36, 37, 38, 0.08) 4px 4px 15px 0px;"
        >
            <img src="{{ url('images/profiles/replied_to_conversation_icon.svg') }}" alt="Activity icon" />
        </div>
    </div>
    <p class="text-lg text-black font-semibold rounded-lg mb-4 tracking-normal" style="word-break: break-word;">
        Replied to
        <a href="{{ $activity->subject->thread->path() }}" class="font-normal">
            {{ $activity->subject->thread->title }}
        </a>
    </p>
    <div class="content user-content text-black text-sm">{{ $activity->subject->body }}</div>
</div>
