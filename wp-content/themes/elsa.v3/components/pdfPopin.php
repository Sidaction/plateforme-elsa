

<div id="empty_modal" class="modal modal-empty">
    <div class="modal_inner wrap">

        <button class="close-modal-btn">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="32"  height="32"  viewBox="0 0 24 24"  fill="none"  stroke="black"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                <path d="M18 6l-12 12" />
                <path d="M6 6l12 12" />
            </svg>
        </button>

        <div class="modal_content entry-content">
            <iframe id="pdf-popin-iframe" style="width: 100%; height: 100%; border: none;"></iframe>

            <div id="loading-msg" class="loading-msg">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bx_loader.gif">
                <p>Nous cherchons le contenu demandé....</p>
            </div>
        </div>
    </div>
</div>
