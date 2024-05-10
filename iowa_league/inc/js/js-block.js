/* Unregister style "large" in quote */
// wp.domReady( function() {
//     wp.blocks.unregisterBlockStyle( 'core/quote', 'large' );
// } );

/* Register new styles for gallery */
wp.blocks.registerBlockStyle( 'core/gallery', {
    name: 'slideshow',
    label: 'Slideshow'
} );

/* Register new styles for quote */
wp.blocks.registerBlockStyle( 'core/quote', {
    name: 'center-quote',
    label: 'Centered with quote'
} );

/* Register new styles for paragraph */
wp.blocks.registerBlockStyle( 'core/paragraph', {
    name: 'narrow-width-center',
    label: 'Narrow Width Center'
} );
wp.blocks.registerBlockStyle( 'core/paragraph', {
    name: 'narrow-width-left',
    label: 'Narrow Width Left'
} );

/* Register new styles for headings */
wp.blocks.registerBlockStyle("core/heading", {
  name: "bold",
  label: "Bold",
});
wp.blocks.registerBlockStyle("core/heading", {
  name: "medium",
  label: "Medium",
});
wp.blocks.registerBlockStyle("core/heading", {
  name: "light",
  label: "Light",
});
/* Register new styles for buttons */
wp.blocks.registerBlockStyle("core/button", {
  name: "btn-link-btn-arrow",
  label: "Button Link with Arrow",
});
wp.blocks.registerBlockStyle("core/button", {
  name: "tertiary",
  label: "Tertiary",
});
// wp.blocks.registerBlockStyle("core/button", {
//   name: "large-tertiary",
//   label: "Tertiary Large",
// });
// wp.blocks.registerBlockStyle("core/button", {
//   name: "small",
//   label: "Fill Small",
// });
// wp.blocks.registerBlockStyle("core/button", {
//   name: "small-outline",
//   label: "Outline Small",
// });
// wp.blocks.registerBlockStyle("core/button", {
//   name: "xsmall",
//   label: "Fill Extra Small",
// });
// wp.blocks.registerBlockStyle("core/button", {
//   name: "xsmall-outline",
//   label: "Outline Extra Small",
// });


wp.blocks.registerBlockStyle("core/media-text", {
  name: "image-488",
  label: "Image 488px",
});
wp.blocks.registerBlockStyle("core/media-text", {
  name: "image-600",
  label: "Image 600px",
});
wp.blocks.registerBlockStyle("core/media-text", {
  name: "image-hight",
  label: "Image more than 820px",
});
wp.blocks.registerBlockStyle("core/media-text", {
  name: "image-488-circle",
  label: "Image 488px with circle",
});
wp.blocks.registerBlockStyle("core/media-text", {
  name: "image-600-circle",
  label: "Image 600px with circle",
});
wp.blocks.registerBlockStyle("core/media-text", {
  name: "image-676-circle",
  label: "Image 676px with circle",
});
wp.blocks.registerBlockStyle("core/media-text", {
  name: "image-hight-circle",
  label: "Image more than 820px with circle",
});
wp.blocks.registerBlockStyle("core/table", {
  name: "table_slender",
  label: "Table Slender",
});
wp.blocks.registerBlockStyle("core/table", {
  name: "table_pdf",
  label: "Table PDF",
});
wp.blocks.registerBlockStyle("core/table", {
  name: "table_slender_light",
  label: "Table Slender Light Header",
});



/* Register new styles for slider */
wp.blocks.registerBlockStyle("acf/post-slider", {
  name: "cards",
  label: "Cards",
  // style_handle: 'myguten-style',
  // inline_style: '.wp-block-quote.is-style-fancy-quote { color: blue; }',
});

/**
 * Set ACF block parent
 * @param {obj} settings
 * @param {string} name
 */

function setBlockParentEndorsement(settings, name) {
  if (name !== "acf/endorsement-slider") {
    return settings;
  }

  return lodash.assign({}, settings, {
    parent: ["acf/es-style1"],
  });
}

wp.hooks.addFilter(
  "blocks.registerBlockType",
  "template-parts/endorsement/endorsement_slider",
  setBlockParentEndorsement
);

function setBlockParentResearch(settings, name) {
  if (name !== "acf/research-slider") {
    return settings;
  }

  return lodash.assign({}, settings, {
    parent: ["acf/rs-style1"],
  });
}

wp.hooks.addFilter(
  "blocks.registerBlockType",
  "template-parts/research/slider",
  setBlockParentResearch
);

function setBlockParentTeam(settings, name) {
  if (name !== "acf/team-listing") {
    return settings;
  }

  return lodash.assign({}, settings, {
    parent: ["acf/team-style1"],
  });
}

wp.hooks.addFilter(
  "blocks.registerBlockType",
  "template-parts/team/listing",
  setBlockParentTeam
);

// function setBlockMcParent(settings, name) {
//   if (name !== "acf/mc-listing") {
//     return settings;
//   }
//
//   return lodash.assign({}, settings, {
//     parent: ["acf/mc-style1"],
//   });
// }
// function setBlockMcParent2(settings, name) {
//   if (name !== "acf/mc-listing2") {
//     return settings;
//   }
//
//   return lodash.assign({}, settings, {
//     parent: ["acf/mc-style2"],
//   });
// }

// wp.hooks.addFilter(
//   "blocks.registerBlockType",
//   "template-parts/multi_column/listing",
//   setBlockMcParent
// );
// wp.hooks.addFilter(
//   "blocks.registerBlockType",
//   "template-parts/multi_column/listing",
//   setBlockMcParent2
// );

// function setBlockParent(settings, name) {
//   if (name !== "acf/post-slider") {
//     return settings;
//   }
//
//   return lodash.assign({}, settings, {
//     parent: ["acf/ps-style1"],
//   });
// }
//
// wp.hooks.addFilter(
//   "blocks.registerBlockType",
//   "template-parts/post_slider/post_slider",
//   setBlockParent
// );

function setBlockParentMap(settings, name) {
  if (name !== "acf/gmap") {
    return settings;
  }

  return lodash.assign({}, settings, {
    parent: ["acf/gmap-style1"],
  });
}

wp.hooks.addFilter(
  "blocks.registerBlockType",
  "template-parts/gmap/listing",
  setBlockParentMap
);


function setBlockParentServices(settings, name) {
  if (name !== "acf/services-listing") {
    return settings;
  }

  return lodash.assign({}, settings, {
    parent: ["acf/services-style1"],
  });
}
wp.hooks.addFilter(
  "blocks.registerBlockType",
  "template-parts/services/services_list",
  setBlockParentServices
);


function setBlockParentNewsListing( settings, name ) {
  if ( name !== 'acf/news-listing' ) {
    return settings;
  }

  return lodash.assign( {}, settings, {
    parent: [
      'acf/news-style1'
    ]
  } );
}
wp.hooks.addFilter(
  'blocks.registerBlockType',
  'template-parts/news_style1',
  setBlockParentNewsListing
);

function setBlockParentNewsSearch( settings, name ) {
  if ( name !== 'acf/news-search' ) {
    return settings;
  }

  return lodash.assign( {}, settings, {
    parent: [
      'acf/news-style1'
    ]
  } );
}
wp.hooks.addFilter(
  'blocks.registerBlockType',
  'template-parts/news_style1',
  setBlockParentNewsSearch
);

/**************** Impact ********************/
function setBlockParentImpact( settings, name ) {
    if ( name !== 'acf/impact-listing' ) {
        return settings;
    }

    return lodash.assign( {}, settings, {
        parent: [
            'acf/gblock-impact'
        ]
    } );
}
wp.hooks.addFilter(
    'blocks.registerBlockType',
    'template-parts/gblock_impact',
    setBlockParentImpact
);