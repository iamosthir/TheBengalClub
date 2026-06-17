@if($archives->isNotEmpty())
<!-- Archive Section -->
<section id="archive" class="archive-section py-24 lg:py-32 relative overflow-hidden">
    <div class="archive-bg-glow"></div>
    <div class="container mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16 reveal-up">
            <span class="section-caption">Memories</span>
            <h2 class="section-title">Archive</h2>
            <p class="section-text">
                Cherished moments with distinguished personalities, award recipients, and special guests of The Bengal Club.
            </p>
        </div>

        <div class="archive-grid">
            @foreach($archives as $index => $item)
                @php $delay = ($index % 4) * 0.08 + 0.1; @endphp
                <div class="archive-item reveal-up" style="--delay: {{ $delay }}s"
                     onclick="openArchiveLightbox({{ $index }})"
                     data-src="{{ asset('storage/' . $item->image_path) }}"
                     data-title="{{ $item->title ?? '' }}">
                    <div class="archive-image-wrap">
                        <img src="{{ asset('storage/' . $item->image_path) }}"
                             alt="{{ $item->title ?? 'Archive' }}"
                             loading="lazy">
                        <div class="archive-overlay">
                            <div class="archive-zoom-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0zm-6-3v6m-3-3h6"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    @if($item->title)
                        <p class="archive-caption">{{ $item->title }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Lightbox -->
    <div class="archive-lightbox" id="archiveLightbox" onclick="closeArchiveLightbox(event)">
        <button class="archive-lightbox-close" onclick="closeArchiveLightbox()">&times;</button>
        <button class="archive-lightbox-prev" onclick="archiveLightboxNav(-1, event)">&#8249;</button>
        <button class="archive-lightbox-next" onclick="archiveLightboxNav(1, event)">&#8250;</button>
        <div class="archive-lightbox-content" onclick="event.stopPropagation()">
            <img id="archiveLightboxImg" src="" alt="">
            <p id="archiveLightboxCaption" class="archive-lightbox-caption"></p>
        </div>
    </div>
</section>

<script>
(function () {
    const items = @json($archives->map(fn($a) => ['src' => asset('storage/' . $a->image_path), 'title' => $a->title ?? '']));
    let current = 0;

    window.openArchiveLightbox = function (index) {
        current = index;
        renderLightbox();
        document.getElementById('archiveLightbox').classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    window.closeArchiveLightbox = function (e) {
        if (e && e.target !== document.getElementById('archiveLightbox') && !e.target.classList.contains('archive-lightbox-close')) return;
        document.getElementById('archiveLightbox').classList.remove('active');
        document.body.style.overflow = '';
    };

    window.archiveLightboxNav = function (dir, e) {
        e.stopPropagation();
        current = (current + dir + items.length) % items.length;
        renderLightbox();
    };

    function renderLightbox() {
        document.getElementById('archiveLightboxImg').src = items[current].src;
        const cap = document.getElementById('archiveLightboxCaption');
        cap.textContent = items[current].title;
        cap.style.display = items[current].title ? 'block' : 'none';
    }

    document.addEventListener('keydown', function (e) {
        const lb = document.getElementById('archiveLightbox');
        if (!lb.classList.contains('active')) return;
        if (e.key === 'Escape') { lb.classList.remove('active'); document.body.style.overflow = ''; }
        if (e.key === 'ArrowLeft') { current = (current - 1 + items.length) % items.length; renderLightbox(); }
        if (e.key === 'ArrowRight') { current = (current + 1) % items.length; renderLightbox(); }
    });
})();
</script>
@endif
