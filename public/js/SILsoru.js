window.onload = (event) => {
  loadEditors()
}

function loadEditors() {
  console.log('loading')
  ClassicEditor.create(document.querySelector('#editor'))
    .then((editor) => {
      // console.log(editor);
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

  ClassicEditor.create(document.querySelector('#editor2'))
    .then((editor) => {
      // console.log(editor);
      let icerik = document.getElementById('ckeditor2').value

      if (icerik.length > 0) {
        editor.setData(icerik)
      }

      editor.model.document.on('change:data', (evt, data) => {
        document.getElementById('ckeditor2').value = editor.getData()
      })
    })
    .catch((error) => {
      console.error(error)
    })
}

function select(sinav, ders, ders_id) {
  document.getElementById('baslik').innerHTML = sinav + ' / ' + ders
  document.getElementById('active_sinav').innerHTML = sinav
  document.getElementById('active_ders').innerHTML = ders
  document.getElementById('selected_ders').value = ders_id
}

function edit(id) {
  window.livewire.emit('edit', id)
}

function readFormValues() {
  const props = {
    qid: document.getElementById('qid').value,
    kapsam_id: document.getElementById('selected_ders').value,
    soru_background: document.getElementById('ckeditor').value,
    soru: document.getElementById('ckeditor2').value,
  }

  return props
}

function submitForm(event) {
  event.preventDefault()

  const props = readFormValues()

  if (document.getElementById('action').value == 'upd') {
    window.livewire.emit('update', props)
  } else {
    window.livewire.emit('insert', props)
  }
}
