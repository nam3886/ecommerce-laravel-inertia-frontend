import Riode from "@/Riode/";

const moduleStickyContent = function(selector, settings) {
  var $stickyContents = Riode.$(selector),
      options = $.extend({}, Riode.defaults.stickyContent, settings),
      scrollPos = window.pageYOffset;

  if (0 == $stickyContents.length) return;

  var setTopOffset = function($item) {
      var offset = 0,
          index = 0;
      $(".sticky-content.fixed.fix-top").each(function() {
          offset += $(this)[0].offsetHeight;
          index++;
      });
      $item.data("offset-top", offset);
      $item.data("z-index", options.max_index - index);
  };

  var setBottomOffset = function($item) {
      var offset = 0,
          index = 0;
      $(".sticky-content.fixed.fix-bottom").each(function() {
          offset += $(this)[0].offsetHeight;
          index++;
      });
      $item.data("offset-bottom", offset);
      $item.data("z-index", options.max_index - index);
  };

  var wrapStickyContent = function($item, height) {
      if (
          window.innerWidth >= options.minWidth &&
          window.innerWidth <= options.maxWidth
      ) {
          $item.wrap('<div class="sticky-content-wrapper"></div>');
          $item.parent().css("height", height + "px");
          $item.data("is-wrap", true);
      }
  };

  var initStickyContent = function() {
      $stickyContents.each(function(index) {
          var $item = $(this);
          if (!$item.data("is-wrap")) {
              var height = $item.removeClass("fixed").outerHeight(true),
                  top;
              top = $item.offset().top + height;

              // if sticky header has category dropdown, increase top
              if ($item.hasClass("has-dropdown")) {
                  var $box = $item.find(".category-dropdown .dropdown-box");

                  if ($box.length) {
                      top += $box[0].offsetHeight;
                  }
              }

              $item.data("top", top);
              wrapStickyContent($item, height);
          } else {
              if (
                  window.innerWidth < options.minWidth ||
                  window.innerWidth >= options.maxWidth
              ) {
                  $item.unwrap(".sticky-content-wrapper");
                  $item.data("is-wrap", false);
              }
          }
      });
  };

  var refreshStickyContent = function(e) {
      if (e && !e.isTrusted) return;
      $stickyContents.each(function(index) {
          var $item = $(this),
              showContent = true;
          if (options.scrollMode) {
              showContent = scrollPos > window.pageYOffset;
              scrollPos = window.pageYOffset;
          }
          if (
              window.pageYOffset >
                  (false == options.top ? $item.data("top") : options.top) &&
              window.innerWidth >= options.minWidth &&
              window.innerWidth <= options.maxWidth
          ) {
              if ($item.hasClass("fix-top")) {
                  if (undefined === $item.data("offset-top")) {
                      setTopOffset($item);
                  }
                  $item.css("margin-top", $item.data("offset-top") + "px");
              } else if ($item.hasClass("fix-bottom")) {
                  if (undefined === $item.data("offset-bottom")) {
                      setBottomOffset($item);
                  }
                  $item.css(
                      "margin-bottom",
                      $item.data("offset-bottom") + "px"
                  );
              }
              $item.css("z-index", $item.data("z-index"));
              if (options.scrollMode) {
                  if (
                      (showContent && $item.hasClass("fix-top")) ||
                      (!showContent && $item.hasClass("fix-bottom"))
                  ) {
                      $item.addClass("fixed");
                  } else {
                      $item.removeClass("fixed");
                      $item.css("margin", "");
                  }
              } else {
                  $item.addClass("fixed");
              }
              options.hide &&
                  $item.parent(".sticky-content-wrapper").css("display", "");
          } else {
              $item.removeClass("fixed");
              $item.css("margin-top", "");
              $item.css("margin-bottom", "");
              options.hide &&
                  $item
                      .parent(".sticky-content-wrapper")
                      .css("display", "none");
          }
      });
  };

  var resizeStickyContent = function(e) {
      $stickyContents
          .removeData("offset-top")
          .removeData("offset-bottom")
          .removeClass("fixed")
          .css("margin", "")
          .css("z-index", "");

      Riode.call(function() {
          initStickyContent();
          refreshStickyContent();
      });
  };

  setTimeout(initStickyContent, 550);
  setTimeout(refreshStickyContent, 600);

  Riode.call(function() {
      window.addEventListener("scroll", refreshStickyContent, {
          passive: true
      });
      Riode.$window.on("resize", resizeStickyContent);
  }, 700);
};

export default moduleStickyContent;
