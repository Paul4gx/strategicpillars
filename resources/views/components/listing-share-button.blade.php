@props([
    'url',
    'title',
    'text' => null,
])

@php
    $shareUrl = $url;
    if (! str_starts_with($shareUrl, 'http')) {
        $shareUrl = url($shareUrl);
    }
    $shareText = $text ?: $title;
@endphp

<button type="button"
        class="item listing-share-btn"
        data-share-url="{{ $shareUrl }}"
        data-share-title="{{ $title }}"
        data-share-text="{{ $shareText }}"
        aria-label="Share {{ $title }}">
    <div class="icon">
        <i class="flaticon-outbox"></i>
    </div>
    <p>Share</p>
</button>

@once
    @push('styles')
    <style>
    button.item.listing-share-btn {
        border: none;
        background: transparent;
        padding: 0;
        cursor: pointer;
        font: inherit;
        color: inherit;
        text-align: inherit;
    }

    .listing-share-popover {
        position: fixed;
        inset: 0;
        z-index: 100001;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }

    .listing-share-popover[hidden] {
        display: none !important;
    }

    .listing-share-popover__backdrop {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, 0.45);
    }

    .listing-share-popover__panel {
        position: relative;
        z-index: 1;
        width: min(420px, 100%);
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    .listing-share-popover__head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 16px;
    }

    .listing-share-popover__head h4 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        line-height: 1.3;
    }

    .listing-share-popover__close {
        border: none;
        background: #f1f3f5;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        cursor: pointer;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .listing-share-popover__field {
        display: flex;
        gap: 8px;
        margin-bottom: 20px;
    }

    .listing-share-popover__field input {
        flex: 1;
        min-width: 0;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 13px;
        color: #495057;
        background: #f8f9fa;
    }

    .listing-share-popover__copy {
        flex-shrink: 0;
        border: none;
        border-radius: 10px;
        padding: 10px 16px;
        background: #1563df;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
    }

    .listing-share-popover__copy.is-copied {
        background: #198754;
    }

    .listing-share-popover__label {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #868e96;
        margin-bottom: 10px;
    }

    .listing-share-popover__social {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .listing-share-popover__social a {
        flex: 1 1 calc(33.333% - 10px);
        min-width: 100px;
        text-align: center;
        padding: 10px 8px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        color: #fff;
    }

    .listing-share-popover__social a.share-whatsapp { background: #25d366; }
    .listing-share-popover__social a.share-facebook { background: #1877f2; }
    .listing-share-popover__social a.share-x { background: #0f1419; }

    .listing-share-toast {
        position: fixed;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%) translateY(12px);
        z-index: 100002;
        background: #212529;
        color: #fff;
        padding: 12px 20px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 500;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.25s ease, transform 0.25s ease;
    }

    .listing-share-toast.is-visible {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }
    </style>
    @endpush

    <div class="listing-share-popover" hidden aria-hidden="true" role="dialog" aria-labelledby="listing-share-popover-title">
        <div class="listing-share-popover__backdrop" data-share-close></div>
        <div class="listing-share-popover__panel">
            <div class="listing-share-popover__head">
                <h4 id="listing-share-popover-title">Share this listing</h4>
                <button type="button" class="listing-share-popover__close" data-share-close aria-label="Close">
                    <i class="icon-close"></i>
                </button>
            </div>
            <div class="listing-share-popover__field">
                <input type="text" class="listing-share-popover__url" readonly aria-label="Listing link">
                <button type="button" class="listing-share-popover__copy">Copy link</button>
            </div>
            <div class="listing-share-popover__label">Share via</div>
            <div class="listing-share-popover__social">
                <a href="#" class="share-whatsapp" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                <a href="#" class="share-facebook" target="_blank" rel="noopener noreferrer">Facebook</a>
                <a href="#" class="share-x" target="_blank" rel="noopener noreferrer">X</a>
            </div>
        </div>
    </div>
    <div class="listing-share-toast" role="status" aria-live="polite"></div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var popover = document.querySelector('.listing-share-popover');
        var toast = document.querySelector('.listing-share-toast');
        if (!popover) {
            return;
        }

        var urlInput = popover.querySelector('.listing-share-popover__url');
        var copyBtn = popover.querySelector('.listing-share-popover__copy');
        var whatsapp = popover.querySelector('.share-whatsapp');
        var facebook = popover.querySelector('.share-facebook');
        var shareX = popover.querySelector('.share-x');
        var toastTimer = null;

        function encodeQuery(params) {
            return Object.keys(params)
                .map(function (key) {
                    return encodeURIComponent(key) + '=' + encodeURIComponent(params[key]);
                })
                .join('&');
        }

        function showToast(message) {
            if (!toast) {
                return;
            }
            toast.textContent = message;
            toast.classList.add('is-visible');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(function () {
                toast.classList.remove('is-visible');
            }, 2800);
        }

        function openPopover(data) {
            urlInput.value = data.url;
            whatsapp.href = 'https://wa.me/?' + encodeQuery({ text: data.text + ' ' + data.url });
            facebook.href = 'https://www.facebook.com/sharer/sharer.php?' + encodeQuery({ u: data.url });
            shareX.href = 'https://twitter.com/intent/tweet?' + encodeQuery({ url: data.url, text: data.text });
            copyBtn.textContent = 'Copy link';
            copyBtn.classList.remove('is-copied');
            popover.hidden = false;
            popover.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            urlInput.focus();
            urlInput.select();
        }

        function closePopover() {
            popover.hidden = true;
            popover.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        async function copyUrl(url) {
            try {
                if (navigator.clipboard && window.isSecureContext) {
                    await navigator.clipboard.writeText(url);
                    return true;
                }
            } catch (e) {}

            urlInput.value = url;
            urlInput.focus();
            urlInput.select();
            try {
                return document.execCommand('copy');
            } catch (e) {
                return false;
            }
        }

        document.querySelectorAll('.listing-share-btn').forEach(function (btn) {
            btn.addEventListener('click', async function () {
                var data = {
                    url: btn.getAttribute('data-share-url') || window.location.href,
                    title: btn.getAttribute('data-share-title') || document.title,
                    text: btn.getAttribute('data-share-text') || btn.getAttribute('data-share-title') || document.title,
                };

                if (navigator.share) {
                    try {
                        await navigator.share({
                            title: data.title,
                            text: data.text,
                            url: data.url,
                        });
                        return;
                    } catch (err) {
                        if (err && err.name === 'AbortError') {
                            return;
                        }
                    }
                }

                openPopover(data);
            });
        });

        copyBtn.addEventListener('click', async function () {
            var ok = await copyUrl(urlInput.value);
            if (ok) {
                copyBtn.textContent = 'Copied!';
                copyBtn.classList.add('is-copied');
                showToast('Link copied to clipboard');
            } else {
                showToast('Select the link and copy manually');
            }
        });

        popover.querySelectorAll('[data-share-close]').forEach(function (el) {
            el.addEventListener('click', closePopover);
        });

        document.addEventListener('keydown', function (event) {
            if (!popover.hidden && event.key === 'Escape') {
                closePopover();
            }
        });
    });
    </script>
    @endpush
@endonce
