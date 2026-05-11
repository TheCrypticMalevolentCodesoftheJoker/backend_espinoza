document.addEventListener("DOMContentLoaded", () => {
  const wrappers = document.querySelectorAll(".toast-wrapper");

  wrappers.forEach((wrapper) => {
    let timer;
    const duration = 4000; // 4000
    // Mostrar inmediatamente
    wrapper.classList.add("show");

    const closeToast = () => {
      wrapper.classList.replace("show", "hide");

      setTimeout(() => {
        wrapper.remove();
      }, 600);
    };

    const startTimer = () => {
      wrapper.classList.remove("is-paused");

      timer = setTimeout(closeToast, duration);
    };

    const stopTimer = () => {
      wrapper.classList.add("is-paused");

      clearTimeout(timer);
    };

    startTimer();

    wrapper.addEventListener("mouseenter", stopTimer);
    wrapper.addEventListener("mouseleave", startTimer);

    const closeBtn = wrapper.querySelector(".toast-close");

    if (closeBtn) {
      closeBtn.addEventListener("click", () => {
        stopTimer();
        closeToast();
      });
    }
  });
});
