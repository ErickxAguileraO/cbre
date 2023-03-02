// barra movil
$(".btn-bar-movil").click(function(){
  $(".barra-menu-movil").css({'left':'0px'});
});
$(".btn-cerrar-menu-bar").click(function(){
  $(".barra-menu-movil").css({'left':'-150%'});
});


$(document).ready(function(){
    const carouselSettings = {
        dots: false,
        infinite: true,
        speed: 300,
        responsive: [
          {
            breakpoint: 1300,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              infinite: true,
              dots: false,
            },
          },
          {
            breakpoint: 1100,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 990,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 780,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 580,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      };

      const carruselNoticias = $('.carruselNoticias');
      const noticiasCount = carruselNoticias.find('.noticia-home-n').length;
      const noticiasSlidesToShow = noticiasCount < 3 ? noticiasCount : 3;
      carruselNoticias.slick({
        ...carouselSettings,
        slidesToShow: noticiasSlidesToShow,
        slidesToScroll: 1,
      });

      const carruselCertificaciones = $('.carruselCertificaciones');
      const certificacionesCount = carruselCertificaciones.find('.certificacion-home-n').length;
      const certificacionesSlidesToShow = certificacionesCount < 5 ? certificacionesCount : 5;
      carruselCertificaciones.slick({
        ...carouselSettings,
        slidesToShow: certificacionesSlidesToShow,
        slidesToScroll: 1,
      });

      const carruselComercial = $('.carruselComercial');
      const comercialCount = carruselComercial.find('.comercial-home-n').length;
      const comercialSlidesToShow = comercialCount < 5 ? comercialCount : 5;
      carruselComercial.slick({
        ...carouselSettings,
        slidesToShow: comercialSlidesToShow,
        slidesToScroll: 1,
      });

      const carruselCaracteristicas = $('.carruselCaracteristicas');
      const caracteristicasCount = carruselCaracteristicas.find('.caracteristica-n')
        .length;
      const caracteristicasSlidesToShow =
        caracteristicasCount < 5 ? caracteristicasCount : 5;
      carruselCaracteristicas.slick({
        ...carouselSettings,
        slidesToShow: caracteristicasSlidesToShow,
        slidesToScroll: 1,
      });

  });

// Contador home
addEventListener('DOMContentLoaded', ()=>{

    $('.carruselNoticias').slick('refresh');
    $('.carruselComercial').slick('refresh');
    $('.carruselCertificaciones').slick('refresh');
    $('.carruselCaracteristicas').slick('refresh');

  const contadores = document.querySelectorAll('.contador_cantidad');
  const velocidad = 1000;

  const animarContadores = () =>{
      for(const contador of contadores){
          const actualizar_contador =() =>{
              let cantidad_maxima = +contador.dataset.cantidadTotal,
              valor_actual = +contador.innerText,
              incremento = cantidad_maxima / velocidad;
              if(valor_actual < cantidad_maxima){
                  contador.innerText = Math.ceil(valor_actual + incremento)
                  setTimeout((actualizar_contador), 5);
              }else{
                  contador.innerText = cantidad_maxima;

              }
          }
          actualizar_contador();
      }
  }

  const mostrarContadores = elementos =>{
      elementos.forEach(element => {
          if(element.isIntersecting){
                 element.target.classList.add('animar');
                 element.target.classList.remove('ocultar-animate');
                 setTimeout(animarContadores, 300)
          }
      });
  }

  const observer = new IntersectionObserver(mostrarContadores, {
      threshold: 0.75 //0 - 1
  })

  const elementosHTML = document.querySelectorAll('.contador')
  elementosHTML.forEach(elementoHTML =>{
      observer.observe(elementoHTML)
  })

})

/// old shit to resize carousel elements
/* $('.carruselCertificaciones').on('setPosition', function (event, slick) {
    // Get the current number of slides being shown
    var slidesToShow = slick.options.slidesToShow;
    var slidesCount = slick.slideCount;

    // Calculate the width of the carousel container based on the number of slides being shown
    var containerWidth = (100 / slidesToShow) * Math.min(slidesToShow, slidesCount);

    // Double the width of the carousel container if needed
    if (slidesCount < slidesToShow) {
      containerWidth *= 2;
    }

    // Set the width of the carousel container
    $('.carruselCertificaciones').css('width', containerWidth + '%');
  }); */
