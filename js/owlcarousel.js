$(".owl-carousel").owlCarousel({
  dots: false,
  nav: false,
  slideSpeed: 300,
  paginationSpeed: 400,
  autoplay: 3000,
  stopOnHover: true,
  autoHeight: true,
  loop: true,
  margin: 0,
  responsiveClass: true,
  responsive: {
    0: {
      items: 1,
    },
    768: {
      items: 2,
    },
    1100: {
      items: 3,
    },
    1400: {
      items: 4,
    },
  },
});
