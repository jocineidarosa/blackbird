const numero = 50.0;

console.log(
  new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(
    numero
  )
);// saída R$ 50,00

console.log(
  new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(
    numero
  )
);// saída 50,00 €