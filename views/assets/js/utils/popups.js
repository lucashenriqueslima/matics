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

function ajax_load(action) {
  ajax_load_div = $(".ajax_load");

  if (action === "open") {
      ajax_load_div.fadeIn(400).css("display", "flex");
  }

  if (action === "close") {
      ajax_load_div.fadeOut(600);
  }
}