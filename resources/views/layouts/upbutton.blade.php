    <!-- Кнопка "Наверх" -->
    <button id="scrollToTopBtn" aria-label="Наверх" class="scroll-top-btn">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="white">
        <path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.59 5.58L20 12l-8-8-8 8z"/>
      </svg>
    </button>    <!-- Кнопка "Наверх" -->
    <button id="scrollToTopBtn" aria-label="Наверх" class="scroll-top-btn">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="white">
        <path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.59 5.58L20 12l-8-8-8 8z"/>
      </svg>
    </button>
	
	<script>
  // Scroll to top button
  const scrollToTopBtn = document.getElementById("scrollToTopBtn");
  
  window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
      scrollToTopBtn.classList.add('visible');
    } else {
      scrollToTopBtn.classList.remove('visible');
    }
  });
  
  scrollToTopBtn.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
	</script>