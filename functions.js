(function($,sr){
    var debounce = function(func, threshold, execAsap) {
      var timeout;
  
      return function debounced () {
        var obj = this, args = arguments;
        function delayed () {
          if (!execAsap)
            func.apply(obj, args);
          timeout = null;
        }
  
        if (timeout)
          clearTimeout(timeout);
        else if (execAsap)
          func.apply(obj, args);
  
        timeout = setTimeout(delayed, threshold || 50);
      };
    };
  
    jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
  
  })(jQuery,'smartresize');
  
  (function ($) {
  
    "use strict";
    var $container = $('.list');
    var colWidth = function () {
      var w = $container.width(),
        columnNum = 1,
        columnWidth = 0;
      if (w > 1200) {
        columnNum  = 5;
      } else if (w > 900) {
        columnNum  = 4;
      } else if (w > 600) {
        columnNum  = 3;
      } else if (w > 300) {
        columnNum  = 1;
      }
      columnWidth = Math.floor(w/columnNum);
      columnWidth = columnWidth - 10;
      $container.find('.item').each(function() {
        var $item = $(this);
        var multiplier_w = $item.attr('class').match(/item-w(\d)/);
        var width = multiplier_w ? columnWidth*multiplier_w[1]-4 : columnWidth-4;
        $item.css({
          width: width
        });
      });
      return columnWidth;
    };

    var isotope = function () {
      $container.isotope({
        resizable: false,
        itemSelector: '.item',
        masonry: {
          columnWidth: colWidth(),
          gutter: 10
        }
      });
    };
  
    $('#filterNav').on('click', 'a', function () {
      var selector = $(this).attr('data-filter');
      $container.isotope({
        filter: selector
      });
    });

    isotope();
    $(window).smartresize(isotope);
  
    $(window).load(function () {
      isotope();
    });
  
  })(jQuery);