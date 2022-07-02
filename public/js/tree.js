function toggleShow(id) {
  const clicked = document.getElementById('box' + id)

  const iright = document.getElementById('iconright' + id)
  const idown = document.getElementById('icondown' + id)

  if (clicked.classList.contains('is-hidden')) {
    clicked.classList.remove('is-hidden')
    iright.classList.remove('is-hidden')
    idown.classList.add('is-hidden')
  } else {
    clicked.classList.add('is-hidden')
    iright.classList.add('is-hidden')
    idown.classList.remove('is-hidden')
  }
}

function toggleModal() {
  const modal = document.getElementById('modal')

  if (modal.classList.contains('is-active')) {
    modal.classList.remove('is-active')
  } else {
    modal.classList.add('is-active')
  }
}

function add(parentId = 0, tur = 'top') {
  document.getElementById('parent_id').value = parentId

  switch (tur) {
    case 'sinav':
      document.getElementById('mheader').innerHTML = 'Yeni Ders'
      document.getElementById('finput_label').innerHTML = 'Yeni Ders Tanımı'
      document.getElementById('submit_button').innerHTML = 'Ders Kaydet'

      document.getElementById('tur').value = 'ders'
      break

    case 'ders':
    case 'konu':
      document.getElementById('mheader').innerHTML = 'Yeni Konu'
      document.getElementById('finput_label').innerHTML = 'Yeni Konu Tanımı'
      document.getElementById('submit_button').innerHTML = 'Konu Kaydet'

      document.getElementById('tur').value = 'konu'
      break

    case 'top':
      document.getElementById('mheader').innerHTML = 'Yeni Sınav'
      document.getElementById('finput_label').innerHTML = 'Yeni Sınav Tanımı'
      document.getElementById('submit_button').innerHTML = 'Sınav Kaydet'

      document.getElementById('tur').value = 'sinav'
      break
  }

  toggleModal()
}

function readFormValues() {
  const props = {
    action: document.getElementById('action').value,
    parent_id: document.getElementById('parent_id').value,
    id: document.getElementById('id').value,
    title: document.getElementById('title').value,
    tur: document.getElementById('tur').value,
  }

  return props
}

function edit(id, title, parentId, tur) {
  document.getElementById('action').value = 'upd'
  document.getElementById('parent_id').value = parentId
  document.getElementById('id').value = id
  document.getElementById('title').value = title
  document.getElementById('tur').value = tur

  switch (tur) {
    case 'sinav':
      document.getElementById('mheader').innerHTML = 'Sınav Bilgileri Güncelle'
      document.getElementById('finput_label').innerHTML = 'Sınav Tanımı'
      document.getElementById('submit_button').innerHTML = 'Sınav Güncelle'
      break

    case 'ders':
      document.getElementById('mheader').innerHTML = 'Ders Bilgileri Güncelle'
      document.getElementById('finput_label').innerHTML = 'Ders Tanımı'
      document.getElementById('submit_button').innerHTML = 'Ders Güncelle'
      break

    case 'konu':
      document.getElementById('mheader').innerHTML = 'Konu Bilgileri Güncelle'
      document.getElementById('finput_label').innerHTML = 'Konu Tanımı'
      document.getElementById('submit_button').innerHTML = 'Konu Güncelle'
      break
  }

  toggleModal()
}

function submitForm(event) {
  event.preventDefault()

  const props = readFormValues()

  console.log('submit edildiğinde değerler', props)

  if (document.getElementById('action').value == 'upd') {
    window.livewire.emit('update', props)
  } else {
    window.livewire.emit('add', props)
  }
  toggleModal()
}

function deleteItem(id) {
  window.livewire.emit('delete', id)
}
