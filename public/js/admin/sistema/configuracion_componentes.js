// Croppie
function iniciarCroppie() {
    const croppies = document.querySelectorAll('.croppie-image');

    if ( croppies.length <= 0 ) {
        return;
    }

    croppies.forEach((image, index) => {

        const min_width = image.getAttribute('data-min-width');
        const min_height = image.getAttribute('data-min-height');

        const container = image.closest('.croppie-container');
        const defaul_image = container.querySelector('.default-image-croppie');
        //permite establecer más de 1 croppie en el html, en donde se distingue por su data-croppie-container
        //de esta forma se pueden diferenciar y guardar las imagenes en un array por separado
        const containerIndex = container.getAttribute('data-croppie-container');
        const inputName = containerIndex === '1' ? 'imagenesGaleria[]' : 'imagenListado[]';

        let crop;
        let razon = 1;

        element = document.querySelectorAll('.imagen-input')[index];
        element && element.addEventListener('change', (event) => {
            const file = event.target.files[0];
            const reader = new FileReader();
            const extensions = ['image/jpg', 'image/jpeg', 'image/png'];

            // Validación de las extensiones aceptadas.
            if ( !extensions.includes(file.type) ) {
                event.target.value = '';

                Swal.fire({
                    icon: 'error',
                    title: 'Un momento...',
                    text: 'La imagen no cumple con el formato.'
                })
            }

            reader.onload = function (e) {
                const newImage = new Image();
                newImage.src = e.target.result;

                newImage.onload = function () {

                    // Validación del tamaño de la imagen.
                    if ( min_width > this.width || min_height > this.height ) {
                        event.target.value = '';

                        Swal.fire({
                            icon: 'error',
                            title: 'Un momento...',
                            text: 'La imagen no cumple con el tamaño mínimo.'
                        })
                    }

                    if ( min_width > 1500 ) {
                        razon = 4;
                    } else if ( min_width >= 500 && min_width < 1500 ) {
                        razon = 2;
                    }

                    image.classList.remove('d-none');
                    image.classList.add('d-inline-block', 'w-auto');

                    defaul_image.classList.add('d-none');

                    if ( crop ) {
                        crop.destroy();
                    }

                    crop = new Croppie(image, {
                        enableExif: true,
                        url: e.target.result,
                        viewport: {
                            width: min_width / razon,
                            height: min_height / razon,
                        },
                        boundary: {
                            width: (min_width / razon) + 30,
                            height: (min_height / razon) + 30
                        }
                    });
                };
            }

            if ( file ) {
                reader.readAsDataURL(file);
            }
        });

        element = document.querySelectorAll('.cancel-croppie')[index];
        element && element.addEventListener('click', (e) => cancelCroppie(defaul_image, image));

        element = document.querySelectorAll('.add-image-croppie')[index];
        element && element.addEventListener('click', (e) => {

            if ( image.classList.contains('d-none') ) {
                return;
            }

            const boton = e.currentTarget;
            const isSingleImage = image.classList.contains('single-image');

            crop.result({
                type: 'base64',
                format: 'jpeg|png|jpg',
                quality: 1,
                //size: 'original',
                size: { width: min_width, height: min_height }
            })
            .then(function (base64) {
                const new_image = document.createElement('img');
                const container = document.createElement('div');
                const input = document.createElement('input');
                const icon = "<button class='btn btn-danger position-absolute delete-image-croppie' type='button' style='right:20px'><i class='fas fa-trash-alt text-white pointer-none'></i></button>";

                new_image.src = base64;
                new_image.classList.add('w-100');

                input.name = inputName;
                input.type = "hidden";
                input.value = base64;

                container.classList.add('col-sm-6', 'col-md-4', 'pb-5');
                container.append(input);
                container.append(new_image);
                container.innerHTML += icon;

                if ( isSingleImage ) {
                    boton.closest('.croppie-container').querySelector('.images-gallery').innerHTML = container.outerHTML;
                }

                if ( !isSingleImage ) {
                    boton.closest('.croppie-container').querySelector('.images-gallery').append(container);
                }

                boton.closest('.croppie-container').querySelector('.imagen-input').value = '';

                cancelCroppie(defaul_image, image);
            });
        });
    });
}

function cancelCroppie(defaul_image, image) {
    defaul_image.classList.remove('d-none');
    image.classList.add('d-none');
    image.classList.remove('d-inline-block', 'w-auto');
}

window.addEventListener('click', function (event) {
    if ( event.target.classList.contains('delete-image-croppie') ) {
        event.preventDefault();

        event.target.parentElement.remove();
    }
});

iniciarCroppie();

// Ckeditor
const configuracionCkeditor = {
    language: 'es',
    removePlugins: ['MediaEmbed', 'CKFinder'],
    toolbar: {
        items: [
            'findAndReplace', 'selectAll', '|',
            'heading', '|',
            'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
            'bulletedList', 'numberedList', 'todoList', '|',
            'outdent', 'indent', '|',
            'undo', 'redo',
            '-',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
            'link', 'blockQuote', 'insertTable', 'codeBlock', 'htmlEmbed', '|',
            'specialCharacters', 'horizontalLine', 'pageBreak', '|',
            'textPartLanguage', '|',
            'sourceEditing'
        ],
        shouldNotGroupWhenFull: false,
    },
    heading: {
        options: [
            { model: 'paragraph', title: 'Párrafo', class: 'ck-heading_paragraph' },
            { model: 'heading1', view: 'h1', title: 'Título 1', class: 'ck-heading_heading1' },
            { model: 'heading2', view: 'h2', title: 'Título 2', class: 'ck-heading_heading2' },
            { model: 'heading3', view: 'h3', title: 'Título 3', class: 'ck-heading_heading3' },
            { model: 'heading4', view: 'h4', title: 'Título 4', class: 'ck-heading_heading4' },
            { model: 'heading5', view: 'h5', title: 'Título 5', class: 'ck-heading_heading5' },
            { model: 'heading6', view: 'h6', title: 'Título 6', class: 'ck-heading_heading6' }
        ]
    },
    placeholder: 'Escribe aquí lo que necesites...',
    fontFamily: {
        options: [
            'default',
            'Arial, Helvetica, sans-serif',
            'Courier New, Courier, monospace',
            'Georgia, serif',
            'Lucida Sans Unicode, Lucida Grande, sans-serif',
            'Tahoma, Geneva, sans-serif',
            'Times New Roman, Times, serif',
            'Trebuchet MS, Helvetica, sans-serif',
            'Verdana, Geneva, sans-serif'
        ],
        supportAllValues: true
    },
    fontSize: {
        options: [ 10, 12, 14, 'default', 18, 20, 22 ],
        supportAllValues: true
    },
};
