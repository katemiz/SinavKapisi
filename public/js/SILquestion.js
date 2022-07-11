window.onload = (event) => {
  switch (document.getElementById('actiontype').value) {
    case 'soru_add':
    case 'soru_edit':
      loadEditor(
        1,
        'Soru kapsamında verilecek bilgileri, ve şartları buraya yazınız',
      )
      loadEditor(2, 'Soru içeriğini, neyin arandığını buraya yazınız')
      break

    case 'secenek_add':
      loadEditor(1, 'Cevap şıkkı içeriğini yazınız')
      break

    default:
      break
  }
}

function loadEditor(no, placeholder) {
  ClassicEditor.create(document.querySelector('#editor' + no), {
    placeholder: placeholder,
  })
    .then((editor) => {
      let icerik = document.getElementById('ckeditor' + no).value

      if (icerik.length > 0) {
        editor.setData(icerik)
      }

      editor.model.document.on('change:data', (evt, data) => {
        document.getElementById('ckeditor' + no).value = editor.getData()
      })
    })
    .catch((error) => {
      console.error(error)
    })
}

function selectSinavDers(sinav, ders, ders_id) {
  document.getElementById('baslik').innerHTML = sinav + ' / ' + ders
  document.getElementById('active_sinav').innerHTML = sinav
  document.getElementById('active_ders').innerHTML = ders
  document.getElementById('selected_ders').value = ders_id
}

function readSoruFormValues() {
  const props = {
    qid: document.getElementById('qid').value,
    kapsam_id: document.getElementById('selected_ders').value,
    soru_background: document.getElementById('ckeditor1').value,
    soru: document.getElementById('ckeditor2').value,
  }

  return props
}

function readSecenekFormValues() {
  let is_correct
  let ele = document.getElementsByName('dogru_mu')

  for (i = 0; i < ele.length; i++) {
    if (ele[i].checked) {
      is_correct = ele[i].value
    }
  }

  const props = {
    qid: document.getElementById('qid').value,
    icerik: document.getElementById('ckeditor1').value,
    dogru_mu: is_correct,
  }

  return props
}

function toggleForm() {
  const parent = document.getElementById('secenek_form')

  if (parent.classList.contains('is-hidden')) {
    parent.classList.remove('is-hidden')
  } else {
    parent.classList.add('is-hidden')
  }
}

function initializeSecenekForm() {
  document.getElementById('ckeditor1').value = ''
  document.getElementById('editor1').innerHTML = ''

  let ele = document.getElementsByName('dogru_mu')

  for (i = 0; i < ele.length; i++) {
    ele[i].checked = false
  }
}

function addSecenek() {
  document.getElementById('hidden_form_header').innerHTML =
    'Yeni Cevap Şıkkı Ekleme'

  initializeSecenekForm()

  toggleForm()

  //   const modal = document.getElementById('modal')

  //   if (modal.classList.contains('is-active')) {
  //     modal.classList.remove('is-active')
  //   } else {
  //     modal.classList.add('is-active')
  //   }
}

function cancelSecenekAction() {
  let parent = document.getElementById('secenek_form')
  parent.classList.add('is-hidden')
}

function editSoru(id) {
  window.livewire.emit('soru_edit', id)
}

function editSecenek(id, icerik, dogru_mu) {
  let parent = document.getElementById('secenek_form')
  parent.classList.remove('is-hidden')

  //   let secili = document.getElementById('secenek' + id)
  //   secili.classList.add('is-hidden')

  //   let newNode = prepareForm()

  //   parent.insertBefore(newNode, secili)

  //   return true

  //   let ele = document.getElementsByName('dogru_mu')

  //   for (i = 0; i < ele.length; i++) {
  //     if (ele[i].value == dogru_mu) {
  //       ele[i].checked = true
  //     }
  //   }

  //   document.getElementById('editor1').innerHTML = icerik
  //   document.getElementById('ckeditor1').value = icerik

  //   loadEditor(1, 'Cevap şıkkı içeriğini yazınız')

  //   toggleModal()
}

function deleteSecenekConfirm(qid, id) {
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
      window.livewire.emit('secenek_delete', qid, id)
    } else {
      return false
    }
  })
}

function submitFormSoru(event) {
  event.preventDefault()

  console.log('Submitting')

  const props = readSoruFormValues()

  if (document.getElementById('actiontype').value == 'soru_add') {
    window.livewire.emit('insert', props)
  }

  if (document.getElementById('actiontype').value == 'soru_edit') {
    window.livewire.emit('update', props)
  }
}

function submitFormSecenek(event) {
  event.preventDefault()

  const props = readSecenekFormValues()

  initializeSecenekForm()
  toggleForm()

  console.log('submitFormSecenek edildiğinde değerler', props)

  if (document.getElementById('actiontype').value == 'secenek_add') {
    window.livewire.emit('secenek_insert', props)
  } else {
    window.livewire.emit('secenek_update', props)
  }
}
