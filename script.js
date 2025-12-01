// Плавное перемещение в самый верх, при нажатии на кнопку scrollToTop
const scrollToTopBtn = document.getElementById("scrollToTop");

window.addEventListener("scroll", () => {
  if (window.pageYOffset > 300) {
    scrollToTopBtn.classList.add("visible");
  } else {
    scrollToTopBtn.classList.remove("visible");
  }
});

scrollToTopBtn.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
});

// Плавное появление элементов, когда пользователь проматывает страницу вниз
const fadeElements = document.querySelectorAll(".fade-in");

const appearOptions = {
  threshold: 0.15,
  rootMargin: "0px 0px -100px 0px",
};

const appearOnScroll = new IntersectionObserver(function (
  entries,
  appearOnScroll
) {
  entries.forEach((entry) => {
    if (!entry.isIntersecting) return;
    entry.target.classList.add("appear");
    appearOnScroll.unobserve(entry.target);
  });
},
appearOptions);

fadeElements.forEach((element) => {
  appearOnScroll.observe(element);
});

// Валидация введеной почты при помощи регулярки
const subscribeForm = document.getElementById("subscribeForm");
const emailInput = document.getElementById("emailInput");
const formMessage = document.getElementById("formMessage");

subscribeForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const email = emailInput.value.trim();
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (emailRegex.test(email)) {
    formMessage.textContent = "✓ Thank you for subscribing!";
    formMessage.style.color = "green";
    emailInput.value = "";
  } else {
    formMessage.textContent = "✗ Please enter a valid email address";
    formMessage.style.color = "red";
  }
  setTimeout(() => {
    formMessage.textContent = "";
  }, 3000);
});
