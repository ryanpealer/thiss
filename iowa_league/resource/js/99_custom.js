var windowWidth = jQuery(window).width(),
  containerWidth = jQuery(".container").width(),
  headerO = jQuery(".js-header-box").offset(),
  headerH = jQuery(".js-header-box").outerHeight(),
  hash = window.location.hash,
  href = window.location.href,
  host = window.location.hostname,
  printDivCSS = new String(
    '<link href="https://' +
      host +
      '/wp-content/themes/iowa_league/assets/css/style.css" rel="stylesheet" type="text/css">'
  );

// var fixHeader = function () {
//     if (jQuery(window).scrollTop() > 1) {
//         jQuery('.js-header-box').addClass('sticky-header');
//     } else {
//         jQuery('.js-header-box').removeClass('sticky-header');
//     }
//     if (jQuery(window).scrollTop() > headerO.top + headerH) {
//         jQuery('.js-header-box').addClass('small-header');
//     } else {
//         jQuery('.js-header-box').removeClass('small-header');
//     }
// }
//
// var headerHeight = function () {
//     var headerH = jQuery('.js-header-box').outerHeight();
//     jQuery('.site-header').height(headerH);
//     jQuery('.site-header-style2').height(headerH);
// }
//
// var bodyAnimate = function () {
//     if (jQuery('#wpadminbar').length) {
//         barH = jQuery('#wpadminbar').outerHeight();
//     }
//     if (hash) {
//         var id = hash.substr(1);
//
//         jQuery('[href*=' + id + ']').click();
//         var top = jQuery('[href*=' + id + ']').offset().top - headerH - barH;
//         jQuery('html,body').animate({
//             scrollTop: top
//         }, 100)
//     }
//
//     if (href.indexOf("filter") > -1) {
//         if (jQuery('#wpadminbar').length) {
//             barH = jQuery('#wpadminbar').outerHeight();
//         }
//         var top = jQuery('.resource-list').offset().top - headerH - barH;
//         jQuery('html,body').animate({
//             scrollTop: top
//         }, 100)
//     }
// }
//

var postSlider = function () {
  if (jQuery(".js-slider-list .item").length > 1) {
    if (jQuery(".js-slider-list").length) {
      jQuery(".js-slider-list").each(function () {
        var count = jQuery(this).data("item-count"),
          count2 = jQuery(this).data("item-tablet-count");
          // console.log('count',count);
        const slider = tns({
          container: this,
          loop: true,
          items: 1,
          slideBy: 1,
          gutter: 18,
          nav: false,
          controls: false,
          autoplay: false,
          speed: 400,
          autoplayButtonOutput: false,
          mouseDrag: true,
          swipeAngle: false,
          center: true,
          edgePadding: 30,
          responsive: {
            767: {
              slideBy: 1,
              items: count2,
              gutter: 21,
              edgePadding: 30,
              freezable: true,
              center: false,
            },
            990: {
              items: count,
              disable: true,
              autoWidth: true
            },
          },
        });
      });
    }
  }
  // if(jQuery('.js-endor-slider-list .item').length > 1) {
  //         jQuery('.js-endor-slider-list').each(function(){
  //             var count = jQuery(this).data('item-count'),
  //                 count2 = jQuery(this).data('item-tablet-count'),
  //                 count3 = jQuery(this).data('item-mobile-count'),
  //                 arrow = jQuery(this).data('arrow-status'),
  //                 dots = jQuery(this).data('dots-status');
  //             const slider = tns({
  //                 container: this,
  //                 loop: false,
  //                 items: count3,
  //                 slideBy: count3,
  //                 gutter: 5,
  //                 nav: dots,
  //                 controls: arrow,
  //                 autoplay: false,
  //                 speed: 400,
  //                 autoplayButtonOutput: false,
  //                 mouseDrag: true,
  //                 swipeAngle: false,
  //                 responsive: {
  //                     640: {
  //                         slideBy: count2,
  //                         items: count2,
  //                         gutter: 24,
  //                     },
  //                     990: {
  //                         slideBy: count,
  //                         items: count,
  //                         gutter: 24,
  //                     }
  //                 },
  //             });
  //         });
  // }
  // if (jQuery('.js-rs-slide .item').length > 1) {
  //     jQuery('.js-rs-slide').each(function(){
  //         const slider = tns({
  //             container: this,
  //             loop: true,
  //             items: 1,
  //             nav: false,
  //             controls: true,
  //             autoplay: false,
  //             speed: 400,
  //             autoplayButtonOutput: false,
  //             mouseDrag: false,
  //         });
  //     })
  // }
};
//
var copyLink = function ($id) {
  /* Get the text field */
  var copyText = document.getElementById($id);

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  jQuery(document.body).append(
    '<div id="msg"><svg style="vertical-align: -5px;" width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.6667 7.38625V7.99958C14.6659 9.4372 14.2004 10.836 13.3396 11.9875C12.4788 13.1389 11.2689 13.9812 9.89028 14.3889C8.51166 14.7965 7.03821 14.7475 5.68969 14.2493C4.34116 13.7511 3.18981 12.8303 2.40735 11.6243C1.62488 10.4183 1.25323 8.99163 1.34783 7.55713C1.44242 6.12263 1.99818 4.75714 2.93223 3.6643C3.86628 2.57146 5.12856 1.80984 6.53083 1.49301C7.9331 1.17619 9.40022 1.32114 10.7134 1.90625" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M14.6667 2.66699L8 9.34033L6 7.34033" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>  &nbsp;Link has been copied to clipboard.</div>'
  );
  var x = document.getElementById("msg");
  x.className = "show";
  setTimeout(function () {
    x.className = x.className.replace("show", "");
    x.remove();
  }, 2500);

  // alert("Copied the text: " + copyText.value);
};

var imageSlider = function () {
  if (jQuery(".js-image-slider-list .item").length > 1) {
    if (jQuery(".js-image-slider-list").length) {
      jQuery(".js-image-slider-list").each(function () {
        var count = jQuery(this).data("item-count"),
          count2 = jQuery(this).data("item-tablet-count");
        const slider = tns({
          container: this,
          loop: true,
          items: 1,
          slideBy: 1,
          // gutter: 18,
          // nav: true,
          controls: true,
          autoplay: false,
          speed: 400,
          autoplayButtonOutput: false,
          mouseDrag: true,
          swipeAngle: false,
          center: true,
          // controlsContainer: "#controls",
          navContainer: "#dots",
          prevButton: ".prev",
          nextButton: ".next",
          // edgePadding: 30,
          // responsive: {
          //     767: {
          //         slideBy: 1,
          //         items: count2,
          //         gutter: 21,
          //         edgePadding: 30,
          //         freezable: true,
          //         center: false,
          //     },
          //     990: {
          //         slideBy: 1,
          //         items: count,
          //         gutter: 24,
          //         disable: true,
          //         // nav: false,
          //         // controls: false,
          //     }
          // },
        });
      });
    }
  }
};
var classifiedForm = function () {
  if (jQuery(".post-a-classified").length > 0) {
    gform.addAction(
      "gform_input_change",
      function (elem, formId, fieldId) {
        if (elem.id === "field_2_14") {
          var removeBtn = jQuery("#gfield_description_2_11");
          if (removeBtn) {
            removeBtn.addClass("show");
          }
        }

        gform.addFilter("gform_file_upload_status_markup", function () {
          return '<div id="{0}" class="ginput_preview">{1} 12345 <span style="color:#f00;">{2}</span> <b></b> <a href="javascript:void(0)" title="{3}" onclick="{4}" onkeypress="{4}">{5}</a></div>';
        });
      },
      10,
      3
    );

    jQuery(".classified_file_upload .gfield_description").on(
      "click",
      function () {
        jQuery(".classified_file_upload input").val("");
        jQuery(this).removeClass("show");
      }
    );
  }
};
var customSelect = function () {
  if (jQuery(".js-style-select").length) {
    jQuery(".js-style-select").each(function () {
      var choices = new Choices(this, {
        searchEnabled: false,
        itemSelectText: "",
        shouldSort: false,
        position: "bottom",
      });
    });
  }
};
var filterSubmit = function () {
  if (jQuery("#search-cat").length) {
    jQuery("#search-cat").on("change", function () {
      document.forms["news-searchform"].submit();
    });
  }

  if (jQuery("#sort-by").length) {
    jQuery("#sort-by").on("change", function () {
      document.forms["news-searchform"].submit();
    });
  }
};

jQuery(document).ready(function ($) {
  // headerHeight();
  // bodyAnimate();
  customSelect();
  filterSubmit();
  postSlider();
  imageSlider();
  classifiedForm();

  if ($(".wp-block-gallery.is-style-slideshow").length) {
    $(".wp-block-gallery.is-style-slideshow .blocks-gallery-grid").each(
      function () {
        const slider = tns({
          container: this,
          loop: false,
          items: 1,
          slideBy: 1,
          controls: true,
          controlsPosition: "bottom",
          nav: false,
          autoplay: false,
          speed: 400,
          autoplayButtonOutput: false,
          mouseDrag: true,
          swipeAngle: false,
          center: true,
          onInit: function (data) {
            $(".tns-controls").append(
              '<div class="counter"><span class="current">' +
                data.displayIndex +
                '</span> / <span class="total">' +
                data.slideCount +
                "</span></div>"
            );
          },
        });
        var customizedFunction = function (info, eventName) {
          $(".tns-controls .counter .current").text(info.displayIndex);
        };

        // bind function to event
        slider.events.on("transitionEnd", customizedFunction);
      }
    );
  }

  // Date Format
  var initDatePicker = function () {
    if ($("#input_2_7").length > 0) {
      $("#input_2_7").datepicker({
        minDate: "0",
        dateFormat: "mm/dd/yy",
        onSelect: function (date) {
          var dt2 = $("#input_2_8");
          var minDate = $(this).datepicker("getDate");
          var minDate2 = $(this).datepicker("getDate");
          $(this).datepicker("setDate", $(this).datepicker("getDate"));
          minDate.setDate(minDate.getDate());
          minDate2.setDate(minDate.getDate() + 1);
          dt2.datepicker("option", "minDate", minDate2);
        },
      });

      $("#input_2_8, #input_2_7").keypress(function (e) {
        // PreventDefault workaround for older browsers
        if (!e.preventDefault) {
          e.returnValue = false;
        } else {
          e.preventDefault();
        }
      });

      $("#input_2_8, #input_2_7").keydown(function (e) {
        //If delete or backspace pressed
        if (e.keyCode == 46 || e.keyCode == 8) {
          $(this).val(""); // Clear text
          $(this).datepicker("hide"); // Hide the datepicker calendar (if displayed)
          $(this).blur(); // Unfocus from the field
        }

        //Prevent user from manually entering date (have to use the datepicker box)
        // PreventDefault workaround for older browsers
        if (!e.preventDefault) {
          e.returnValue = false;
        } else {
          e.preventDefault();
        }
      });
    }
    if ($("#input_2_19").length > 0) {
      $("#input_2_19").datepicker({
        minDate: "0",
        dateFormat: "mm/dd/yy",
        onSelect: function (date) {
          var dt2 = $("#input_2_20");
          var minDate = $(this).datepicker("getDate");
          var minDate2 = $(this).datepicker("getDate");
          $(this).datepicker("setDate", $(this).datepicker("getDate"));
          minDate.setDate(minDate.getDate());
          minDate2.setDate(minDate.getDate() + 1);
          dt2.datepicker("option", "minDate", minDate2);
        },
      });

      $("#input_2_20, #input_2_19").keypress(function (e) {
        // PreventDefault workaround for older browsers
        if (!e.preventDefault) {
          e.returnValue = false;
        } else {
          e.preventDefault();
        }
      });

      $("#input_2_20, #input_2_19").keydown(function (e) {
        //If delete or backspace pressed
        if (e.keyCode == 46 || e.keyCode == 8) {
          $(this).val(""); // Clear text
          $(this).datepicker("hide"); // Hide the datepicker calendar (if displayed)
          $(this).blur(); // Unfocus from the field
        }

        //Prevent user from manually entering date (have to use the datepicker box)
        // PreventDefault workaround for older browsers
        if (!e.preventDefault) {
          e.returnValue = false;
        } else {
          e.preventDefault();
        }
      });
    }
  };

  jQuery(document).bind("gform_post_render", function () {
    initDatePicker();
  });

  initDatePicker();
});

// jQuery(window).load(function ($) {
//   // headerHeight();
// });

// jQuery(window).scroll(function ($) {
//   // fixHeader();
// });

// jQuery(window).resize(function ($) {
//   // headerHeight();
// });

jQuery(document).ready(function ($) {
  jQuery(window).load(function () {
    if (jQuery(".wpDataTables").length > 0) {
      if (
        wpDataTables.table_1 &&
        jQuery(".wpDataTables.wpDataTableID-11.wpdt-pagination-center").lenght >
          0
      ) {
        wpDataTables.table_1.addOnDrawCallback(function () {
          jQuery("html,body")
            .stop()
            .animate(
              {
                scrollTop: jQuery(".wpDataTables").offset().top - 20,
              },
              600
            );
          if (
            jQuery(".wpDataTables.wpDataTableID-11.wpdt-pagination-center")
              .length > 0
          ) {
            jQuery("html,body")
              .stop()
              .animate(
                {
                  scrollTop:
                    jQuery(
                      ".wpDataTables.wpDataTableID-11.wpdt-pagination-center"
                    ).offset().top - 20,
                },
                600
              );
          }
        });
      }
      if (
        wpDataTables.table_1 &&
        jQuery(".wpDataTables.wpdt-pagination-center").lenght > 0
      ) {
        wpDataTables.table_1.addOnDrawCallback(function () {
          jQuery("html,body")
            .stop()
            .animate(
              {
                scrollTop:
                  jQuery(".wpDataTables.wpdt-pagination-center").offset().top -
                  20,
              },
              600
            );
        });
      }
      if (
        wpDataTables.table_2 &&
        jQuery(".wpDataTables.wpdt-pagination-center").lenght > 0
      ) {
        wpDataTables.table_2.addOnDrawCallback(function () {
          jQuery("html,body")
            .stop()
            .animate(
              {
                scrollTop:
                  jQuery(".wpDataTables.wpdt-pagination-center").offset().top -
                  20,
              },
              600
            );
        });
      }
    }

    jQuery("#table_1_3_filter input").attr("min", 1);
    jQuery("#table_1_range_from_3").on("input", function () {
      jQuery("#table_1_range_to_3").attr("min", jQuery(this).val());
    });

    jQuery("#table_1_3_filter input").attr("min", 1);
    jQuery('.wpDataTableID-8 .dataTables_filter input[type="search"]').attr(
      "placeholder",
      "Type your search here..."
    );

    setTimeout(function () {
      var $search26 = $(
        '.wpDataTableID-26 .dataTables_filter input[type="search"]'
      );
      var $search = $('.dataTables_filter input[type="search"]');
      if ($search26.length > 0) {
        $search26.attr("placeholder", "Search by Category or by Code");
      }
      if ($search.length > 0) {
        $search.on("input", function () {
          if ($search.val() !== "") {
            if ($("#reset").length <= 0) {
              $search.after('<span id="reset"> &times; </span>');
            }
            $("#reset").on("click", function () {
              $search.val("");
              $("#reset").remove();
              $("#table_1").DataTable().search("").draw();
            });
          }
        });
      }
    }, 800);
  });
});

jQuery(document).on(
  "click",
  '.site-header-bottom .site-navigation > nav > ul > li > a[href="#"]',
  function (event) {
    event.stopPropagation();
    event.preventDefault();
  }
);

if (jQuery("#input_10_58").length > 0) {
  let str = jQuery("#input_10_58").val();
  str = str.split("/");
  str = str[str.length - 2];
  str = str.replace(/-/g, " ");

  var t = jQuery(".blck-section-heading h2.title");
  if (t.length > 0) {
    t.addClass("text-capitalize").html(str + " Registration Form");
  }
}

if (jQuery("#input_2_5").length > 0) {
  let post_title = jQuery("#input_2_5");
  post_title.attr("maxlength", 150);
}

jQuery('a[href*="Not Provide"]').each(function () {
  jQuery(this).addClass("d-none");
});

function printPart(divId) {
  window.frames["print_frame"].document.title = document.title;
  window.frames["print_frame"].document.head.innerHTML = printDivCSS;
  window.frames["print_frame"].document.body.innerHTML =
    document.getElementById(divId).innerHTML;
  window.frames["print_frame"].window.focus();
  setTimeout(function () {
    window.frames["print_frame"].window.print();
  }, 500);
}

jQuery(document).ready(function ($) {
  //Cityscape Advertising Contract Total
  var select =
    "#field_13_4000 .gfield_repeater_item .gfield_repeater_cell + .gfield_repeater_cell select";
  var checkbox =
    "#field_13_4000 .gfield_repeater_item .gfield_repeater_cell input[type='checkbox']";
  var sum = 0;

  var sumselects = function () {
    sum = 0;
    $(select).each(function () {
      sum += parseInt($(this).val(), 10) || 0;
    });
    $(checkbox).each(function () {
      if ($(this).is(":checked")) {
        sum += parseInt($(this).val(), 10) || 0;
        $(this)
          .parent()
          .parent()
          .parent()
          .parent()
          .next(".gfield_repeater_cell")
          .find("input[type=hidden]")
          .val("$75");
      } else {
        $(this)
          .parent()
          .parent()
          .parent()
          .parent()
          .next(".gfield_repeater_cell")
          .find("input[type=hidden]")
          .val("");
      }
    });
    $(".total-price").text("$" + sum);
    $("#input_13_63").val("$" + sum);
  };

  $(checkbox).on("click", sumselects);
  $(select).on("change", sumselects);

  $(document).on("DOMNodeInserted", function (e) {
    $(e.target)
      .find(".gfield_repeater_cell+.gfield_repeater_cell select")
      .on("change", sumselects);
    $(e.target)
      .find(".gfield_repeater_cell input[type='checkbox']")
      .on("click", sumselects);
  });

  $(document).on("click", ".remove_repeater_item", sumselects);

  //Printed Directory Advertising Contract Total
  var check = '#field_15_52 input[type="checkbox"]';
  var checksum = 0;

  var sumcheck = function () {
    checksum = 0;
    $(check).each(function () {
      if ($(this).is(":checked")) {
        checksum += parseInt(
          $(this).next("label").find("strong").text().replace(/[^\d]/g, ""),
          10
        );
      }
    });
    $(".total-print").text("$" + checksum);
  };

  $(check).on("click", sumcheck);

  var ref = "#field_15_5000 .gfield_repeater_item select";
  var refsum = 0;

  var sumrefs = function () {
    refsum = 0;
    $(ref).each(function () {
      if ($(this).find("option:selected").val() !== " ") {
        refsum += 65;
      }
    });
    $(".total-reference").text("$" + refsum);
  };

  $(ref).on("change", sumrefs);

  $(document).on("DOMNodeInserted", function (e) {
    $(e.target).find("select").on("change", sumrefs);
  });

  $(document).on("click", ".remove_repeater_item", sumrefs);

  var copy = "#input_15_80";
  var copysum = 0;

  $(copy).attr("type", "number").attr("min", 0);

  var sumcopy = function (e) {
    copysum = 0;
    copysum += $(e.target).val() * 130;
    $(".total-copies").text("$" + copysum);
  };

  $(copy).on("input", sumcopy);

  var $total = $(".total_price");
  if ($total.length > 0) {
    $(document).on("click", "body", function () {
      var total = 0;
      total += parseInt($(".total-print").text().replace(/[^\d]/g, ""));
      total += parseInt($(".total-reference").text().replace(/[^\d]/g, ""));
      total += parseInt($(".total-copies").text().replace(/[^\d]/g, ""));
      $(".total_price").text("$" + total);
      $("#input_15_85 ").val("$" + total);
    });
  }


  // Header Alert

  if ($.cookie('Alert') != 'disable' ){
    jQuery('.alert-banner').addClass('visible');
  }

  $(document).on('click','.btn-alert-close', function(e){
    $.cookie("Alert", 'disable', {expires: 1 });
    e.preventDefault();
    $('.alert-banner').slideToggle('500');
  });

});

if (jQuery("#gform_12").length > 0) {
  jQuery("#input_12_3010-0")
    .mask("99999")
    .bind("keypress", function (e) {
      if (e.which == 13) {
        jQuery(this).blur();
      }
    });

  jQuery("#input_12_3005-0")
    .mask("(999) 999-9999")
    .bind("keypress", function (e) {
      if (e.which == 13) {
        jQuery(this).blur();
      }
    });

  jQuery("#gform_12").on("click", ".add_repeater_item", function () {
    setTimeout(function () {
      jQuery("#input_12_3010-1")
        .mask("99999")
        .bind("keypress", function (e) {
          if (e.which == 13) {
            jQuery(this).blur();
          }
        });
      jQuery("#input_12_3010-2")
        .mask("99999")
        .bind("keypress", function (e) {
          if (e.which == 13) {
            jQuery(this).blur();
          }
        });
      jQuery("#input_12_3005-1")
        .mask("(999) 999-9999")
        .bind("keypress", function (e) {
          if (e.which == 13) {
            jQuery(this).blur();
          }
        });
      jQuery("#input_12_3005-2")
        .mask("(999) 999-9999")
        .bind("keypress", function (e) {
          if (e.which == 13) {
            jQuery(this).blur();
          }
        });
    }, 100);
  });
}