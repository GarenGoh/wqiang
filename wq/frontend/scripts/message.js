'use strict';
window.Message = {
  obj: $('#message .alert'),
  show: function(message) {
    this.obj.find('.text').html(message);
    this.obj.show();
    setTimeout(function() {
      window.Message.hide();
    }, 2000);
  },
  hide: function() {
    this.obj.fadeOut(300);
  },
  success: function(message) {
    this.obj.removeClass('alert-danger');
    this.obj.addClass('alert-success');
    this.show(message);
  },
  error: function(message) {
    this.obj.removeClass('alert-success');
    this.obj.addClass('alert-danger');
    this.show(message);
  }
};
