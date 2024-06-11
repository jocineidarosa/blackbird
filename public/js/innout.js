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



/* Aqui está o script do modal inicial */
/* $(document).ready(function() {
  // Quando o usuário clicar no botão de fechar, o modal será fechado
  $('#close-button').on('click', function() {
      $('#modalx').hide();
  });

  // Quando o usuário clicar em qualquer lugar fora do modal, o modal será fechado
  $(window).on('click', function(event) {
      if ($(event.target).is('#modalx')) {
          $('#modalx').hide();
      }
  });
}); */

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




