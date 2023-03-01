// barra movil
$(".btn-bar-movil").click(function(){
  $(".barra-menu-movil").css({'left':'0px'});
});
$(".btn-cerrar-menu-bar").click(function(){
  $(".barra-menu-movil").css({'left':'-150%'});
});


$(document).ready(function(){
    var carruselNoticias = $('.carruselNoticias');
    var noticiasCount = carruselNoticias.find('.noticia-home-n').length;
    var slidesToShow = (noticiasCount < 3) ? noticiasCount : 3;

    carruselNoticias.slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: slidesToShow,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1300,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: true,
            dots: false
          }
        },
        {
          breakpoint: 1100,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 990,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 780,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 580,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
  });


  $(document).ready(function(){
    var carruselCaracteristicas = $('.carruselCaracteristicas');
    var caracteristicasCount = carruselCaracteristicas.find('.caracteristica-n').length;
    var slidesToShow = (caracteristicasCount < 5) ? caracteristicasCount : 5;

    carruselCaracteristicas.slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: slidesToShow,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1300,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 1,
            infinite: true,
            dots: false
          }
        },
        {
          breakpoint: 1100,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 990,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 780,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 580,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
  });

//este lo comparten certificaciones y locales comerciales, por qué? no sé
$(document).ready(function(){
    $('.carruselCertificaciones').each(function(){
      var carruselCertificaciones = $(this);
      var certificacionesCount = carruselCertificaciones.find('.certificacion-home-n').length;
      var slidesToShow = (certificacionesCount < 5) ? certificacionesCount : 5;

      carruselCertificaciones.slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: slidesToShow,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1300,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              infinite: true,
              dots: false
            }
          },
          {
            breakpoint: 1100,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 990,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 780,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 580,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
      });
    });
  });

// Contador home
addEventListener('DOMContentLoaded', ()=>{
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
