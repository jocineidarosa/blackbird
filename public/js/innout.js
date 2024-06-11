/* 
(function () {
  const menuToggle = document.querySelector('.menu-toggle');
  menuToggle.onclick = function (e) {
    const body = document.querySelector('body');
    body.classList.toggle('hide-sidebar');
  }

})() */


$(function () {
  var Accordion = function (el, multiple) {
    this.el = el || {};
    // more then one submenu open?
    this.multiple = multiple || false;

    var dropdownlink = this.el.find('.dropdownlink');
    dropdownlink.on('click',
      { el: this.el, multiple: this.multiple },
      this.dropdown);

  };

  Accordion.prototype.dropdown = function (e) {
    var $el = e.data.el,
      $this = $(this),
      //this is the ul.submenuItems
      $next = $this.next();

    $next.slideToggle();
    $this.parent().toggleClass('open');

    if (!e.data.multiple) {
      //show only one menu at the same time
      $el.find('.submenuItems').not($next).slideUp().parent().removeClass('open');
    }

  }

  var accordion = new Accordion($('.accordion-menu'), false);
})


document.addEventListener("DOMContentLoaded", function () {
  var modal = document.getElementById("modalx");
  var closeButton = document.getElementById("close-button");

  var modalShownValue = getCookie('modalShown');


if (modalShownValue !== null && modalShownValue === 'true') {
    return;
}else {
  modal.style.display='flex';
}

  // Quando o usuário clicar no botão de fechar, o modal será fechado
  closeButton.onclick = function () {
      setCookie('modalShown', 'true', 365);
      modal.style.display = "none";
  };


});


function setCookie(name, value, days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
  var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
  if (match) return match[2];
}



