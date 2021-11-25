function alert(icon, message)
{
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: icon,
        title: message
      })    
}

function modal(title, html, button_confirm)
{
  Swal.fire({
    title: `<strong>${title}</strong>`,
    showClass: {  
      popup: 'animate__animated animate__fadeInUp animate__fast'
    },
    hideClass: {
      popup: 'animate__animated animate__fadeOutDown animate__fast'
    }, 
    html: html,
    showCloseButton: true,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonColor: '#388e3c',
    confirmButtonText: button_confirm,
    confirmButtonAriaLabel: 'Thumbs up, great!',
    cancelButtonText:
      '<i class="fa fa-times"></i> Cancelar',
    cancelButtonAriaLabel: 'Thumbs down'
    
  })
}