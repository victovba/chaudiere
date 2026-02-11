(() => {
  const cta = document.querySelector('.sticky-cta');
  if (!cta) return;
  const text = cta.querySelector('.sticky-cta__text');
  if (!text) return;
  const full = text.textContent || '';

  const update = () => {
    if (window.innerWidth < 420) text.textContent = 'Devis gratuit';
    else text.textContent = full;
  };

  update();
  window.addEventListener('resize', update, {passive:true});
})();
