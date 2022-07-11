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
