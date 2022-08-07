function deleteConfirm(id) {
  let form = document.getElementById('fs' + id)

  Swal.fire({
    title: 'Cevap Şıkkı Silme ?',
    text: 'Bu Cevap Şıkkı Silinecektir. Onaylıyor musunuz?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Vazgeç',
    confirmButtonText: 'Sil',
  }).then((result) => {
    if (result.isConfirmed) {
      form.submit()
    } else {
      return false
    }
  })
}

function checkPublish(id) {
  Swal.fire({
    title: 'eSoru Yayınlama ?',
    text:
      'Bu eSoru için tutarlılık incelemesi yapılacak, sorun yok ise yayınlanacaktır. Onaylıyor musunuz?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Vazgeç',
    confirmButtonText: 'Yayınla',
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = '/esoru-publish/' + id
    } else {
      return false
    }
  })
}
