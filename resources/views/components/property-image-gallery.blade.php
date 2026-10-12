@props([
    'images',
    'alt' => 'Property photo',
])

@php
    $urls = $images->map(fn ($image) => asset('storage/uploads/properties/'.$image->image_path))->values();
@endphp

<div class="property-gallery @if($urls->isEmpty()) property-gallery--empty @endif" @if($urls->isNotEmpty()) data-gallery-images='@json($urls)' @endif>
    @if($urls->isEmpty())
        <div class="property-gallery__empty">
            <i class="flaticon-house"></i>
            <span>No photos available</span>
        </div>
    @else
        <div class="property-gallery__main">
            <button type="button" class="property-gallery__arrow property-gallery__arrow--prev" aria-label="Previous photo">
                <i class="icon-arrow-left2"></i>
            </button>
            <button type="button" class="property-gallery__stage" aria-label="Open full-screen gallery">
                <img class="property-gallery__hero" src="{{ $urls[0] }}" alt="{{ $alt }}" loading="eager" decoding="async">
                <span class="property-gallery__expand">
                    <i class="flaticon-magnifiying-glass"></i>
                    View gallery
                </span>
                <span class="property-gallery__counter"><span class="property-gallery__counter-current">1</span> / {{ $urls->count() }}</span>
            </button>
            <button type="button" class="property-gallery__arrow property-gallery__arrow--next" aria-label="Next photo">
                <i class="icon-arrow-right2"></i>
            </button>
        </div>
        <div class="property-gallery__thumbs-wrap">
            <div class="property-gallery__thumbs" role="tablist" aria-label="Property photos">
                @foreach($urls as $index => $url)
                    <button type="button"
                            class="property-gallery__thumb @if($index === 0) is-active @endif"
                            data-index="{{ $index }}"
                            aria-label="Photo {{ $index + 1 }}"
                            aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                        <img src="{{ $url }}" alt="" loading="lazy" decoding="async">
                    </button>
                @endforeach
            </div>
        </div>
    @endif
</div>

@once
<div class="property-gallery-lightbox" hidden aria-hidden="true" role="dialog" aria-modal="true" aria-label="Property photo gallery">
    <div class="property-gallery-lightbox__backdrop" data-gallery-close></div>
    <div class="property-gallery-lightbox__inner">
        <button type="button" class="property-gallery-lightbox__close" data-gallery-close aria-label="Close gallery">
            <i class="icon-close"></i>
        </button>
        <button type="button" class="property-gallery-lightbox__arrow property-gallery-lightbox__arrow--prev" aria-label="Previous photo">
            <i class="icon-arrow-left2"></i>
        </button>
        <div class="property-gallery-lightbox__stage">
            <img class="property-gallery-lightbox__image" src="" alt="">
        </div>
        <button type="button" class="property-gallery-lightbox__arrow property-gallery-lightbox__arrow--next" aria-label="Next photo">
            <i class="icon-arrow-right2"></i>
        </button>
        <div class="property-gallery-lightbox__footer">
            <span class="property-gallery-lightbox__counter"></span>
            <div class="property-gallery-lightbox__thumbs"></div>
        </div>
    </div>
</div>
    @push('styles')
    <style>
    .property-gallery {
        margin-bottom: 40px;
    }

    .property-gallery--empty .property-gallery__empty {
        height: 280px;
        border-radius: 16px;
        background: #f1f3f5;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: #868e96;
        font-size: 15px;
    }

    .property-gallery--empty .property-gallery__empty i {
        font-size: 40px;
    }

    .property-gallery__main {
        position: relative;
        display: flex;
        align-items: stretch;
        gap: 8px;
    }

    .property-gallery__stage {
        flex: 1;
        min-width: 0;
        height: 440px;
        padding: 0;
        border: none;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        cursor: zoom-in;
        background: #e9ecef;
        display: block;
    }

    .property-gallery__hero {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        display: block;
        transition: transform 0.35s ease;
    }

    .property-gallery__stage:hover .property-gallery__hero {
        transform: scale(1.02);
    }

    .property-gallery__expand {
        position: absolute;
        bottom: 16px;
        left: 16px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.72);
        color: #fff;
        font-size: 13px;
        font-weight: 500;
        pointer-events: none;
        backdrop-filter: blur(6px);
    }

    .property-gallery__counter {
        position: absolute;
        top: 16px;
        right: 16px;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.72);
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        pointer-events: none;
        backdrop-filter: blur(6px);
    }

    .property-gallery__arrow {
        flex-shrink: 0;
        width: 44px;
        border: none;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        color: #212529;
        cursor: pointer;
        align-self: center;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s ease, box-shadow 0.15s ease;
    }

    .property-gallery__arrow:hover {
        background: #f8f9fa;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
    }

    .property-gallery__thumbs-wrap {
        margin-top: 12px;
    }

    .property-gallery__thumbs {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding-bottom: 4px;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }

    .property-gallery__thumbs::-webkit-scrollbar {
        height: 6px;
    }

    .property-gallery__thumbs::-webkit-scrollbar-thumb {
        background: #ced4da;
        border-radius: 999px;
    }

    .property-gallery__thumb {
        flex: 0 0 auto;
        width: 96px;
        height: 72px;
        padding: 0;
        border: 2px solid transparent;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        background: #e9ecef;
        scroll-snap-align: start;
        transition: border-color 0.15s ease, opacity 0.15s ease;
        opacity: 0.75;
    }

    .property-gallery__thumb.is-active {
        border-color: #1563df;
        opacity: 1;
    }

    .property-gallery__thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .property-gallery-lightbox {
        position: fixed;
        inset: 0;
        z-index: 100000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }

    .property-gallery-lightbox[hidden] {
        display: none !important;
    }

    .property-gallery-lightbox__backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.92);
    }

    .property-gallery-lightbox__inner {
        position: relative;
        z-index: 1;
        width: min(1200px, 100%);
        height: min(90vh, 900px);
        display: flex;
        flex-direction: column;
        pointer-events: none;
    }

    .property-gallery-lightbox__inner > * {
        pointer-events: auto;
    }

    .property-gallery-lightbox__close {
        position: absolute;
        top: -8px;
        right: 0;
        z-index: 5;
        width: 44px;
        height: 44px;
        border: none;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s ease;
    }

    .property-gallery-lightbox__close:hover {
        background: rgba(255, 255, 255, 0.28);
    }

    .property-gallery-lightbox__stage {
        flex: 1;
        min-height: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 48px 56px 16px;
        cursor: default;
    }

    .property-gallery-lightbox__image {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 8px;
        user-select: none;
    }

    .property-gallery-lightbox__arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 48px;
        height: 48px;
        border: none;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s ease;
    }

    .property-gallery-lightbox__arrow:hover {
        background: rgba(255, 255, 255, 0.22);
    }

    .property-gallery-lightbox__arrow--prev { left: 0; }
    .property-gallery-lightbox__arrow--next { right: 0; }

    .property-gallery-lightbox__footer {
        flex-shrink: 0;
        text-align: center;
        color: rgba(255, 255, 255, 0.9);
    }

    .property-gallery-lightbox__counter {
        display: block;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .property-gallery-lightbox__thumbs {
        display: flex;
        gap: 8px;
        justify-content: flex-start;
        overflow-x: auto;
        padding: 4px 8px 8px;
        max-width: 100%;
        -webkit-overflow-scrolling: touch;
    }

    .property-gallery-lightbox__thumbs button {
        flex: 0 0 auto;
        width: 64px;
        height: 48px;
        padding: 0;
        border: 2px solid transparent;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        opacity: 0.55;
        background: #333;
    }

    .property-gallery-lightbox__thumbs button.is-active {
        border-color: #fff;
        opacity: 1;
    }

    .property-gallery-lightbox__thumbs button img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media (max-width: 768px) {
        .property-gallery__main {
            gap: 0;
        }

        .property-gallery__arrow {
            display: none;
        }

        .property-gallery__stage {
            height: min(52vw, 320px);
            min-height: 240px;
            border-radius: 12px;
        }

        .property-gallery__expand {
            font-size: 12px;
            padding: 6px 12px;
            bottom: 12px;
            left: 12px;
        }

        .property-gallery__counter {
            top: 12px;
            right: 12px;
            font-size: 12px;
        }

        .property-gallery__thumb {
            width: 80px;
            height: 60px;
        }

        .property-gallery-lightbox {
            padding: 0;
        }

        .property-gallery-lightbox__inner {
            width: 100%;
            height: 100%;
            max-height: none;
        }

        .property-gallery-lightbox__close {
            top: 12px;
            right: 12px;
            background: rgba(0, 0, 0, 0.5);
        }

        .property-gallery-lightbox__stage {
            margin: 56px 12px 12px;
        }

        .property-gallery-lightbox__arrow {
            width: 40px;
            height: 40px;
            background: rgba(0, 0, 0, 0.45);
        }

        .property-gallery-lightbox__arrow--prev { left: 8px; }
        .property-gallery-lightbox__arrow--next { right: 8px; }

        .property-gallery-lightbox__footer {
            padding-bottom: env(safe-area-inset-bottom, 12px);
        }
    }
    </style>
    @endpush

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var root = document.querySelector('.property-gallery[data-gallery-images]');
        var lightbox = document.querySelector('.property-gallery-lightbox');
        if (!root || !lightbox) {
            return;
        }

        var images = [];
        try {
            images = JSON.parse(root.getAttribute('data-gallery-images') || '[]');
        } catch (e) {
            return;
        }
        if (!images.length) {
            return;
        }

        var index = 0;
        var hero = root.querySelector('.property-gallery__hero');
        var counterCurrent = root.querySelector('.property-gallery__counter-current');
        var thumbButtons = Array.from(root.querySelectorAll('.property-gallery__thumb'));
        var lbImage = lightbox.querySelector('.property-gallery-lightbox__image');
        var lbCounter = lightbox.querySelector('.property-gallery-lightbox__counter');
        var lbThumbs = lightbox.querySelector('.property-gallery-lightbox__thumbs');
        var touchStartX = null;

        function renderLightboxThumbs() {
            lbThumbs.innerHTML = '';
            images.forEach(function (url, i) {
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = i === index ? 'is-active' : '';
                btn.setAttribute('aria-label', 'Photo ' + (i + 1));
                var img = document.createElement('img');
                img.src = url;
                img.alt = '';
                btn.appendChild(img);
                btn.addEventListener('click', function () {
                    setIndex(i, { openLightbox: true });
                });
                lbThumbs.appendChild(btn);
            });
        }

        function syncUi() {
            var url = images[index];
            if (hero) {
                hero.src = url;
            }
            if (counterCurrent) {
                counterCurrent.textContent = String(index + 1);
            }
            thumbButtons.forEach(function (btn, i) {
                var active = i === index;
                btn.classList.toggle('is-active', active);
                btn.setAttribute('aria-selected', active ? 'true' : 'false');
            });
            if (lbImage) {
                lbImage.src = url;
            }
            if (lbCounter) {
                lbCounter.textContent = (index + 1) + ' / ' + images.length;
            }
            Array.from(lbThumbs.children).forEach(function (btn, i) {
                btn.classList.toggle('is-active', i === index);
            });
            var activeThumb = thumbButtons[index];
            if (activeThumb && typeof activeThumb.scrollIntoView === 'function') {
                activeThumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            }
        }

        function setIndex(next, options) {
            options = options || {};
            index = (next + images.length) % images.length;
            syncUi();
            if (options.openLightbox) {
                openLightbox();
            }
        }

        function openLightbox() {
            renderLightboxThumbs();
            syncUi();
            lightbox.hidden = false;
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            lightbox.hidden = true;
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        root.querySelector('.property-gallery__arrow--prev')?.addEventListener('click', function () {
            setIndex(index - 1);
        });
        root.querySelector('.property-gallery__arrow--next')?.addEventListener('click', function () {
            setIndex(index + 1);
        });
        root.querySelector('.property-gallery__stage')?.addEventListener('click', function () {
            openLightbox();
        });
        thumbButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                setIndex(parseInt(btn.getAttribute('data-index'), 10), { openLightbox: true });
            });
        });

        lightbox.querySelector('.property-gallery-lightbox__arrow--prev')?.addEventListener('click', function () {
            setIndex(index - 1);
        });
        lightbox.querySelector('.property-gallery-lightbox__arrow--next')?.addEventListener('click', function () {
            setIndex(index + 1);
        });
        lightbox.querySelectorAll('[data-gallery-close]').forEach(function (el) {
            el.addEventListener('click', closeLightbox);
        });

        lightbox.querySelector('.property-gallery-lightbox__stage')?.addEventListener('click', function (event) {
            if (event.target === lbImage) {
                return;
            }
        });

        document.addEventListener('keydown', function (event) {
            if (lightbox.hidden) {
                return;
            }
            if (event.key === 'Escape') {
                closeLightbox();
            } else if (event.key === 'ArrowLeft') {
                setIndex(index - 1);
            } else if (event.key === 'ArrowRight') {
                setIndex(index + 1);
            }
        });

        lightbox.addEventListener('touchstart', function (event) {
            touchStartX = event.changedTouches[0].screenX;
        }, { passive: true });

        lightbox.addEventListener('touchend', function (event) {
            if (touchStartX === null) {
                return;
            }
            var diff = event.changedTouches[0].screenX - touchStartX;
            if (Math.abs(diff) > 50) {
                setIndex(diff > 0 ? index - 1 : index + 1);
            }
            touchStartX = null;
        }, { passive: true });

        root.addEventListener('touchstart', function (event) {
            if (lightbox.hidden) {
                touchStartX = event.changedTouches[0].screenX;
            }
        }, { passive: true });

        root.addEventListener('touchend', function (event) {
            if (!lightbox.hidden || touchStartX === null) {
                return;
            }
            var diff = event.changedTouches[0].screenX - touchStartX;
            if (Math.abs(diff) > 50) {
                setIndex(diff > 0 ? index - 1 : index + 1);
            }
            touchStartX = null;
        }, { passive: true });

        syncUi();
    });
    </script>
    @endpush
@endonce
