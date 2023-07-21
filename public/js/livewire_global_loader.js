document.addEventListener('livewire:load', () => {
    let swalToast = null;

    this.livewire.hook('message.sent', () => {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 100000, // Use a high value to prevent automatic closing
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
        const customIcon = '<div class="d-flex align-items-center"><div class="spinner-border text-success mr-2" role="status"></div>Guardando...</div>';
        swalToast = Toast.fire({
            icon: null,
            title: customIcon,
            customClass: {
                popup: 'colored-toast'
            },
        });
    });

    this.livewire.hook('message.failed', (message, component) => {
        if (swalToast) {
            swalToast.update({ icon: 'error', title: 'Error' }); // Update the Swal toast with error icon
        }
    });

    this.livewire.hook('message.processed', (message, component) => {
        if (swalToast) {
            swalToast.close(); // Close the Swal toast when the Livewire request is done
        }
    });
});
