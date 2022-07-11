window.onload = (event) => {
  loadEditor()
}

function loadEditor(icerik) {
  ClassicEditor.create(document.querySelector('#editor'), {
    placeholder: 'Cevap şıkkı içeriğini buraya yazınız!',
  })

    .then((editor) => {
      let icerik = document.getElementById('ckeditor').value

      if (icerik.length > 0) {
        editor.setData(icerik)
      }

      editor.model.document.on('change:data', (evt, data) => {
        document.getElementById('ckeditor').value = editor.getData()
      })
    })
    .catch((error) => {
      console.error(error)
    })
}

function SILreadFormValues() {
  let is_correct
  let ele = document.getElementsByName('dogru_mu')

  for (i = 0; i < ele.length; i++) {
    if (ele[i].checked) {
      is_correct = ele[i].value
    }
  }

  const props = {
    qid: document.getElementById('qid').value,
    icerik: document.getElementById('ckeditor').value,
    dogru_mu: is_correct,
  }

  return props
}

function SILsubmitForm(event) {
  event.preventDefault()

  const props = readFormValues()

  if (document.getElementById('action').value == 'upd') {
    window.livewire.emit('update', props)
  } else {
    window.livewire.emit('insert', props)
  }
  toggleModal()
}

function SILtoggleModal() {
  const modal = document.getElementById('modal')

  if (document.getElementById('zeroize_editor').value == 1) {
    document.getElementById('zeroize_editor').value == '99'

    theEditor.ckeditorInstance.destroy()

    console.log(
      'loading editor 66666',
      document.getElementById('zeroize_editor').value,
    )
  }

  if (modal.classList.contains('is-active')) {
    modal.classList.remove('is-active')

    // document.getElementById('ckeditor').remove
    // document.getElementById('editor').remove
  } else {
    modal.classList.add('is-active')
  }
}

function deleteConfirm(id) {
  Swal.fire({
    title: 'Seçenek Sil ?',
    text: 'Bu Seçenek Silinecektir. Onaylıyor musunuz?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Vazgeç',
    confirmButtonText: 'Sil',
  }).then((result) => {
    if (result.isConfirmed) {
      window.livewire.emit('delete', id)
    } else {
      return false
    }
  })
}

function SILinitializeSecenekForm() {
  document.getElementById('ckeditor').value = ''
  document.getElementById('editor').innerHTML = ''

  let ele = document.getElementsByName('dogru_mu')

  for (i = 0; i < ele.length; i++) {
    ele[i].checked = false
  }
}

function SILfillSecenekForm(icerik, dogru_mu) {
  document.getElementById('ckeditor').value = icerik
  document.getElementById('editor').innerHTML = icerik

  let ele = document.getElementsByName('dogru_mu')

  for (i = 0; i < ele.length; i++) {
    if (dogru_mu == ele[i].value) ele[i].checked = true
  }
}

function SILaddSecenek() {
  document.getElementById('mtitle').innerHTML = 'Cevap Şıkkı Ekleme'

  //loadEditor('')

  toggleModal()
}

function SILeditSecenek(icerik, dogru_mu) {
  document.getElementById('mtitle').innerHTML = 'Cevap Şıkkı Güncelleme'

  fillSecenekForm(icerik, dogru_mu)

  toggleModal()
}
