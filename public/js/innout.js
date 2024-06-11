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

/* 
document.addEventListener("DOMContentLoaded", function () {
  var modal = document.getElementById("modalx");
  var closeButton = document.getElementById("close-button");

  // Quando o usuário clicar no botão de fechar, o modal será fechado
  closeButton.onclick = function () {
      modal.style.display = "none";
  };

  // Quando o usuário clicar em qualquer lugar fora do modal, o modal será fechado
  window.onclick = function (event) {
      if (event.target === modal) {
          modal.style.display = "none";
      }
  };
});
 */

$(document).ready(function() {
  // Verifica se o cookie 'modalShown' existe
  if (!document.cookie.split(';').some((item) => item.trim().startsWith('modalShown='))) {
      // Se não existe, mostra o modal
      $('#modalx').show();
  }

  // Quando o usuário clicar no botão de fechar, o modal será fechado
  $('#close-button').on('click', function() {
      $('#modalx').hide();
      // Define o cookie 'modalShown' para evitar que o modal apareça novamente
      document.cookie = "modalShown=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
  });
});



