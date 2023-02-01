// barra movil
$(".btn-bar-movil").click(function(){    
  $(".barra-menu-movil").css({'left':'0px'});
});
$(".btn-cerrar-menu-bar").click(function(){    
  $(".barra-menu-movil").css({'left':'-150%'});
});

$('.carruselNoticias').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
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
})


$('.carruselCaracteristicas').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 5,
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
})



$('.carruselCertificaciones').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 5,
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
})




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