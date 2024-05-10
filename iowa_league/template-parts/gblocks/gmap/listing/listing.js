(function($){
    /**
     * initMap
     *
     * Renders a Google Map onto the selected jQuery element
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   jQuery $el The jQuery element.
     * @return  object The map instance.
     * for styling map you can check - https://mapstyle.withgoogle.com/
     */
    function initMap( $el ) {

        // Find marker elements within map.
        var $markers = $el.find('.marker');

        // Create gerenic map.
        var mapArgs = {
            center: new google.maps.LatLng(0, 0),
            zoom: 3,
            minZoom: 1,
            mapTypeId   : google.maps.MapTypeId.ROADMAP,
            styles : []
        };
        var map = new google.maps.Map( $el[0], mapArgs );

        // Add markers.
        map.markers = [];
        $markers.each(function(){
            initMarker( $(this), map );
        });

        // Center map based on markers.
        // centerMap( map );

        // Return map instance.
        return map;
    }

    /**
     * initMarker
     *
     * Creates a marker for the given jQuery element and map.
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   jQuery $el The jQuery element.
     * @param   object The map instance.
     * @return  object The marker instance.
     */
    function initMarker( $marker, map ) {

        // Get position from marker.
        var lat = $marker.data('lat');
        var lng = $marker.data('lng');
        var latLng = {
            lat: parseFloat( lat ),
            lng: parseFloat( lng )
        };
        var dist = $marker.data('district');
        var icon = $marker.data('icon');

        // Create marker instance.
        var marker = new google.maps.Marker({
            position : latLng,
            map: map,
            icon: {
                url: icon, // url
                scaledSize: new google.maps.Size(25, 40), // scaled size
            }
        });

        // Append to reference for later use.
        map.markers.push( marker );

        // If marker contains HTML, add it to an infoWindow.
        if( $marker.html() ){

            // Create info window.
            var infowindow = new google.maps.InfoWindow({
                content: $marker.html()
            });

            // Show info window when marker is clicked.
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open( map, marker );
            });
        }
    }

    /**
     * centerMap
     *
     * Centers the map showing all markers in view.
     *
     * @date    22/10/19
     * @since   5.8.6
     *
     * @param   object The map instance.
     * @return  void
     */
    // function centerMap( map ) {
    //
    //     // Create map boundaries from all map markers.
    //     var bounds = new google.maps.LatLngBounds();
    //     map.markers.forEach(function( marker ){
    //         bounds.extend({
    //             lat: marker.position.lat(),
    //             lng: marker.position.lng()
    //         });
    //     });
    //
    //     // Case: Single marker.
    //     if( map.markers.length == 1 ){
    //         map.setCenter( bounds.getCenter() );
    //
    //         // Case: Multiple markers.
    //     } else{
    //         map.fitBounds( bounds );
    //     }
    // }
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
        $('.acf-map').each(function(){
            var map = initMap( $(this) );
        });
    }

    // Initialize each block on page load (front end).
    $(document).ready(function(){
        $('.blck-inner-rs-slider').each(function(){
            initializeBlock( $(this) );
        });
    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=gmap', initializeBlock );
    }

})(jQuery);