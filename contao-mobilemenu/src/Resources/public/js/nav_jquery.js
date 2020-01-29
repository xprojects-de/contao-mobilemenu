(function ($) {

  $.XMobileMenu = function (buttonelement, containerelement, overlayMode, completeSize) {
    this.buttonelement = buttonelement;
    this.containerelement = containerelement;
    this.overlayMode = overlayMode;
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
          self.containerelement.hide();
        }
      });
      if (this.overlayMode === true) {
        $(window).on('resize', function () {
          self.setPosition();
        });
      }
    },
    setModeSettings: function () {
      if (this.overlayMode === true) {
        this.containerelement.css({width: '100%', 'z-index': 5000, margin: 0, left: 0, top: 0, position: 'absolute'});
      } else {
        this.containerelement.css({width: '100%', 'z-index': 5000});
      }
    },
    setPosition: function () {
      if (this.overlayMode === true) {
        if (this.completeSize === true) {
          this.containerelement.css({height: $(window).height(), top: 0, left: 0, position: 'absolute'});
        } else {
          this.containerelement.css({top: (this.buttonelement.position().top + this.buttonelement.height()), left: 0, position: 'absolute'});
        }
      }
    },
    setLinksActivation: function () {
      var self = this;
      $(this.containerelement).find('a').each(function () {
        $(this).click(function () {
          self.containerelement.hide();
        });
      });
    }
  };

}(jQuery, document, window));



