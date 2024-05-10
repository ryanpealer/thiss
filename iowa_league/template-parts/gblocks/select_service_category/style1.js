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
    }

    jQuery.fn.collaps = function() {
        return this.each(function() {
          var box = $(this).parent().find('.collaps');
          var header = $(this).find('.collaps-header a');
          var content = $(this).find('.collaps-content');
          
          header.on('click', function(e) {
            e.preventDefault();
            content.slideToggle(50);
            box.toggleClass('open')
          });
        });
      }
        
    // Initialize each block on page load (front end).
    $(document).ready(function(){
        $('.blck-select-service-category').each(function(){
            initializeBlock( $(this) );
            
            $('div.collaps').collaps();
    
            // $('.dataTables_filter label').text('Search Service Directory');
        });
        
    });
    
   

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=style1', initializeBlock );
    }

})(jQuery);