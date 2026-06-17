@if($activeAnnouncements->isNotEmpty())
{{-- Announcement Modal --}}
<div id="announcement-modal"
     class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
     style="display: none !important;">

    {{-- Backdrop --}}
    <div id="announcement-backdrop"
         class="absolute inset-0 bg-black/70 backdrop-blur-sm"
         onclick="closeAnnouncementModal()"></div>

    {{-- Panel --}}
    <div id="announcement-panel"
         class="relative bg-dark-800 border border-white/10 rounded-2xl shadow-2xl w-auto max-w-[92vw] max-h-[92vh] overflow-hidden flex flex-col
                opacity-0 scale-95 transition-all duration-300"
         style="width: fit-content;">

        {{-- Close button --}}
        <button onclick="closeAnnouncementModal()"
                class="absolute top-3 right-3 z-10 w-8 h-8 flex items-center justify-center rounded-full bg-black/40 hover:bg-white/10 text-white/70 hover:text-white transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        {{-- Slides wrapper --}}
        <div id="announcement-slides">
            @foreach($activeAnnouncements as $index => $ann)
                <div class="announcement-slide" style="{{ $index > 0 ? 'display:none;' : '' }}">
                    {{-- Image --}}
                    @if($ann->image_path)
                        <div style="display:flex; align-items:center; justify-content:center; max-height:70vh; overflow:hidden;">
                            <img src="{{ asset('storage/' . $ann->image_path) }}"
                                 alt="{{ $ann->title }}"
                                 style="max-width:88vw; max-height:70vh; width:auto; height:auto; display:block;">
                        </div>
                    @endif

                    {{-- Content --}}
                    @if($ann->title || $ann->message)
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-white mb-2">{{ $ann->title }}</h2>
                            @if($ann->message)
                                <p class="text-gray-300 text-sm leading-relaxed">{{ $ann->message }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Footer: pagination dots + close button --}}
        <div class="px-6 pb-5 flex items-center justify-between border-t border-white/5 pt-4">
            {{-- Dots (only if multiple) --}}
            @if($activeAnnouncements->count() > 1)
                <div id="announcement-dots" style="display:flex; gap:6px; align-items:center;">
                    @foreach($activeAnnouncements as $i => $_)
                        <button onclick="announcementGoTo({{ $i }})"
                                class="announcement-dot"
                                style="border:none; border-radius:9999px; cursor:pointer; transition: width .3s, background .3s;
                                       height:8px; {{ $i === 0 ? 'width:20px; background:#0f70bf;' : 'width:8px; background:rgba(255,255,255,.3);' }}"></button>
                    @endforeach
                </div>
            @else
                <div></div>
            @endif

            <button onclick="closeAnnouncementModal()"
                    class="text-sm px-4 py-1.5 rounded-lg bg-accent hover:bg-accent-dark text-white transition-colors font-medium">
                Got it
            </button>
        </div>
    </div>
</div>

<script>
(function () {
    const modal  = document.getElementById('announcement-modal');
    const panel  = document.getElementById('announcement-panel');
    const slides = Array.from(document.querySelectorAll('.announcement-slide'));
    const dots   = Array.from(document.querySelectorAll('.announcement-dot'));
    let current  = 0;
    let timer    = null;

    function goTo(index) {
        // Hide all slides, show target
        slides.forEach(function(s) { s.style.display = 'none'; });
        slides[index].style.display = '';

        // Update dots
        dots.forEach(function(d) {
            d.style.width      = '8px';
            d.style.background = 'rgba(255,255,255,.3)';
        });
        if (dots[index]) {
            dots[index].style.width      = '20px';
            dots[index].style.background = '#0f70bf';
        }

        current = index;
    }

    // Expose for inline onclick on dots
    window.announcementGoTo = function(index) {
        clearInterval(timer);
        goTo(index);
        // Restart auto-advance after manual navigation
        if (slides.length > 1) {
            timer = setInterval(function() { goTo((current + 1) % slides.length); }, 5000);
        }
    };

    window.closeAnnouncementModal = function () {
        panel.classList.remove('opacity-100', 'scale-100');
        panel.classList.add('opacity-0', 'scale-95');
        clearInterval(timer);
        setTimeout(function() { modal.style.display = 'none'; }, 300);
    };

    // Open
    modal.style.removeProperty('display');
    requestAnimationFrame(function() {
        requestAnimationFrame(function() {
            panel.classList.remove('opacity-0', 'scale-95');
            panel.classList.add('opacity-100', 'scale-100');
        });
    });

    // Start auto-advance if multiple slides
    if (slides.length > 1) {
        timer = setInterval(function() { goTo((current + 1) % slides.length); }, 5000);
    }
})();
</script>
@endif
