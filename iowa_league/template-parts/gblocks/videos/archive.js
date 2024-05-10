(function($){

    /**
     * initializeBlock
     *
     * Adds custom JavaScript to the block HTML.
     *
     * @date    22/12/2020
     * @since   1.0.0
     *
     * @param   object $block The block jQuery element.
     * @param   object attributes The block attributes (only available when editing).
     * @return  void
     */
    var initializeBlock = function( $block ) {
        //doSomething
        var filterSelect = $block.find(jQuery('#video-cat-select')),
            popup = $block.find(jQuery('.js-video-popup'));
        if (filterSelect.length) {
            filterSelect.on('change', function () {
                document.forms['search-filter'].submit();
            });
        }
        popup.each(function () {
            var url = jQuery(this).attr('href');
            jQuery(this).magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,

                fixedContentPos: false,
                closeMarkup: '<button title="%title%" type="button" class="mfp-close">close <span>x</span></button>',
                callbacks: {
                    open: function() {
                        jQuery('body').addClass('mfp-body-open');
                    },
                    close: function() {
                        jQuery('body').removeClass('mfp-body-open');
                    }
                }
            });
        });
    }

    // Initialize each block on page load (front end).
    $(document).ready(function(){
        $('.blck-video-archive-wrapper').each(function(){
            initializeBlock( $(this) );
        });
    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=videos_archive', initializeBlock );
    }

})(jQuery);