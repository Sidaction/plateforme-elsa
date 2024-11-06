

<div id="empty_modal" class="modal modal-empty">
    <div class="modal_inner wrap">

        <button class="close-modal-btn" aria-label="Fermer la fenêtre">
            <?php get_template_part('svg/svg', 'close', array( 'strokes' => '#FFF' )); ?>
        </button>

        <div class="modal_content entry-content">
            <iframe id="pdf-popin-iframe" style="width: 100%; height: 100%; border: none;" title="Document PDF"></iframe>

            <div id="loading-msg" class="loading-msg">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bx_loader.gif" width="32" height="32" alt="Animation de chargement de contenu">
                <p>Nous cherchons le contenu demandé....</p>
            </div>
        </div>
    </div>
</div>
