(function ($) {

  $.XMobileMenu = function (buttonelement, containerelement, completeSize, icon, iconclose) {
    this.buttonelement = buttonelement;
    this.containerelement = containerelement;
    this.completeSize = completeSize;
    this.icon = icon;
    this.iconclose = iconclose;
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
          self.buttonelement.addClass('xmobilemenuactive');
          if (self.iconclose !== '' && self.completeSize === false) {
            self.buttonelement.find('img').each(function () {
              $(this).attr('src', self.iconclose);
            });
          }
        } else {
          self.containerelement.fadeOut(750);
          self.buttonelement.removeClass('xmobilemenuactive');
          if (self.icon !== '' && self.completeSize === false) {
            self.buttonelement.find('img').each(function () {
              $(this).attr('src', self.icon);
            });
          }
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
        this.containerelement.css({top: (this.buttonelement.position().top + this.buttonelement.height())});
      }
    },
    setLinksActivation: function () {
      var self = this;
      $(this.containerelement).find('a').each(function () {
        $(this).click(function () {
          self.containerelement.fadeOut(750);
          if (self.icon !== '' && self.completeSize === false) {
            self.buttonelement.find('img').each(function () {
              $(this).attr('src', self.icon);
            });
          }
        });
      });
    }
  };

}(jQuery, document, window));