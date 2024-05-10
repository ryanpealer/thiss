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

    // Initialize each block on page load (front end).
    $(document).ready(function(){
        
        $('.blck-featured').each(function(){
            initializeBlock( $(this) );
        });

        var slickOptions = {
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            arrows: true,
            dots: true,
            responsive: [
                {
                    breakpoint: 990,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        centerMode: true,
                        centerPadding: '28px',
                    }
                },
            ]
        };

        if($('.js-carousel-featured').length){
            $('.js-carousel-featured').slick(slickOptions);
        }

        // $(window).on('resize orientationchange', function() {
        //     $('.js-carousel-featured').slick('unslick');
        //     $('.js-carousel-featured').slick(slickOptions);
        // });


        

    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=style1', initializeBlock );
    }

})(jQuery);


// get the element to animate
var element = document.getElementById('circles');
if(element) {
    var elementHeight = element.clientHeight;
}
// console.log(elementHeight);

// listen for scroll event and call animate function
if(element) {
    document.addEventListener('scroll', animate);
}



// check if element is in view
function inView() {
// get window height
var windowHeight = window.innerHeight;
// get number of pixels that the document is scrolled
var scrollY = window.scrollY || window.pageYOffset;

// get current scroll position (distance from the top of the page to the bottom of the current viewport)
var scrollPosition = scrollY + windowHeight;
// get element position (distance from the top of the page to the bottom of the element)
var elementPosition = element.getBoundingClientRect().top + scrollY + elementHeight;

// is scroll position greater than element position? (is element in view?)
if (scrollPosition > elementPosition) {
    return true;
}

return false;
}

// animate element when it is in view
function animate() {
    // is element in view?
    if (inView()) {
        // element is in view, add class to element
        element.classList.add('animate');
    }
}