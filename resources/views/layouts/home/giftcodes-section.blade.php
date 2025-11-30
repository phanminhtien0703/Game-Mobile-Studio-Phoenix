<div class="d-flex flex-column gap-5 mt-5" style="margin: 0px 12px;">
    <div class="giftcode_list">
        <div class="d-flex justify-content-between align-items-center mb-3 text-white">
            <h3 class="text-title">GIFTCODE</h3>
            <a class="d-flex align-items-center gap-2" href="" style="color: rgb(108, 114, 127);">
                <span class="text-navigate" style="cursor: pointer;">Xem tất cả</span>
                <img alt="" src="/icons/arrow.svg">
            </a>
        </div>
        <div class="row">
            @forelse($giftcodes as $giftcode)
            <div class="col-12 col-sm-6">
                <a class="item d-flex" href="#">
                    <div class="img">
                        <img alt="{{ $giftcode->game->game_name ?? 'Giftcode' }}" 
                             src="{{ $giftcode->game->avatar_url ? asset($giftcode->game->avatar_url) : asset('home/images/loading.png') }}">
                    </div>
                    <div class="detail">
                        <h2>{{ $giftcode->game->game_name ?? 'Không có tên' }}</h2>
                        <p>Giftcode: {{ $giftcode->total_quantity }}</p>
                        <p>Người nhận: {{ $giftcode->used_quantity }}</p>
                        <button class="btn giftcode-btn" 
                                data-giftcode-id="{{ $giftcode->giftcode_id }}" 
                                data-message="{{ $giftcode->message }}" 
                                type="button">Nhận code</button>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12">
                <p class="text-white" style="text-align: center; padding: 20px;">Không có giftcode nào</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    /**
     * Giftcode Management
     * Handles giftcode claiming and Messenger integration
     */
    document.addEventListener('DOMContentLoaded', function() {
        // ========== CONFIGURATION ==========
        const CONFIG = {
            pageId: '{{ config("social.messenger.page_id") ?? "game.mobile.studio.phoenix" }}',
            apiEndpoint: '/giftcodes',
            claimAction: 'claim',
            csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        };

        // ========== DOM SELECTORS ==========
        const SELECTORS = {
            button: '.giftcode-btn',
            detailContainer: '.detail',
            usedQuantityLabel: 'p'
        };

        // ========== UTILITIES ==========
        const Utils = {
            /**
             * Get CSRF token from meta tag
             * @returns {string} CSRF token
             */
            getCsrfToken() {
                return CONFIG.csrfToken;
            },

            /**
             * Build API endpoint for claiming giftcode
             * @param {string} giftcodeId - The giftcode ID
             * @returns {string} Full API URL
             */
            buildClaimUrl(giftcodeId) {
                return `${CONFIG.apiEndpoint}/${giftcodeId}/${CONFIG.claimAction}`;
            },

            /**
             * Build Messenger URL with pre-filled message
             * @param {string} message - Message to send
             * @returns {string} Messenger URL
             */
            buildMessengerUrl(message) {
                return `https://m.me/${CONFIG.pageId}?text=${encodeURIComponent(message)}`;
            }
        };

        // ========== API HANDLER ==========
        const API = {
            /**
             * Claim giftcode via AJAX
             * @param {string} giftcodeId - The giftcode ID
             * @returns {Promise} Fetch promise
             */
            claimGiftcode(giftcodeId) {
                return fetch(Utils.buildClaimUrl(giftcodeId), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': Utils.getCsrfToken()
                    }
                }).then(response => response.json());
            }
        };

        // ========== UI HANDLER ==========
        const UI = {
            /**
             * Update used quantity display
             * @param {HTMLElement} button - The claim button
             * @param {number} usedQuantity - New used quantity
             */
            updateUsedQuantity(button, usedQuantity) {
                const detailDiv = button.closest('.item').querySelector(SELECTORS.detailContainer);
                const paragraphs = detailDiv.querySelectorAll(SELECTORS.usedQuantityLabel);
                const usedQuantityText = paragraphs[1]; // Second paragraph is used quantity
                
                if (usedQuantityText) {
                    usedQuantityText.textContent = `Người nhận: ${usedQuantity}`;
                }
            },

            /**
             * Show error message
             * @param {string} message - Error message to display
             */
            showError(message) {
                alert(message || 'Lỗi khi nhận giftcode. Vui lòng thử lại!');
            },

            /**
             * Open Messenger window
             * @param {string} message - Message to send
             */
            openMessenger(message) {
                window.open(Utils.buildMessengerUrl(message), '_blank');
            }
        };

        // ========== EVENT HANDLER ==========
        const EventHandler = {
            /**
             * Handle giftcode claim button click
             * @param {Event} e - Click event
             */
            handleClaimClick(e) {
                e.preventDefault();
                const button = this;
                const giftcodeId = button.getAttribute('data-giftcode-id');
                const message = button.getAttribute('data-message');

                API.claimGiftcode(giftcodeId)
                    .then(data => {
                        if (data.success) {
                            UI.updateUsedQuantity(button, data.used_quantity);
                            UI.openMessenger(message);
                        } else {
                            UI.showError(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Giftcode claim error:', error);
                        UI.showError('Lỗi khi nhận giftcode. Vui lòng thử lại!');
                    });
            }
        };

        // ========== INITIALIZATION ==========
        const init = () => {
            const buttons = document.querySelectorAll(SELECTORS.button);
            buttons.forEach(btn => {
                btn.addEventListener('click', EventHandler.handleClaimClick);
            });
        };

        init();
    });
</script>