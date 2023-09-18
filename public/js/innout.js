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

function formatarMoeda(numero) {
    numero = numero.replace(/\./g, '').replace(',', '.');
    if (numero === '' || isNaN(numero)) {
        return '';
    }
    var partes = numero.split(".");
    var parteInteira = partes[0];
    var parteDecimal = partes[1] || '00';
    parteInteira = parteInteira.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return "R$ " + parteInteira + "," + (parteDecimal.length === 1 ? parteDecimal + '0' : parteDecimal);
}

function formatCurrency(input) {
    var valor = input.value;
    if (!valor.startsWith("R$ ")) {
        var numeroFormatado = formatarMoeda(valor);
        input.value = numeroFormatado;
    }
}



