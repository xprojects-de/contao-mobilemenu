(function ($) {

  $.XMobileMenu = function (buttonelement, containerelement, completeSize) {
    this.buttonelement = buttonelement;
    this.containerelement = containerelement;
    this.completeSize = completeSize;
    if (this.buttonelement.length && this.containerelement.length) {
      this.init();
    }
  };

  $.XMobileMenu.prototype = {
    init: function () {
      var self = this;
      this.setModeSettings();
      this.buttonelement.css({cursor: 'pointer'});
      this.setPosition();
      this.setLinksActivation();
      this.buttonelement.click(function () {
        if (self.containerelement.css("display") === 'none') {
          self.containerelement.fadeIn();
          self.containerelement.width($(window).width() + "px");
        } else {
          self.containerelement.fadeOut(750);
        }
      });
      $(window).on('resize', function () {
        self.setPosition();
      });
    },
    setModeSettings: function () {
      this.containerelement.css({width: '100%', 'z-index': 50000, margin: 0, left: 0, top: 0, position: 'absolute'});
    },
    setPosition: function () {
      if (this.completeSize === true) {
        this.containerelement.css({height: $(window).height()});
      } else {
        this.containerelement.css({top: (this.buttonelement.offset().top + this.buttonelement.height())});
      }
    },
    setLinksActivation: function () {
      var self = this;
      $(this.containerelement).find('a').each(function () {
        $(this).click(function () {
          self.containerelement.fadeOut(750);
        });
      });
    }
  };

}(jQuery, document, window));



