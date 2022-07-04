window.addEventListener('load', (event) => {
  console.log('page is fully loaded')
  loadEditors()
})

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
  document.getElementById('baslik').innerHTML = sinav + ' ' + ders
  document.getElementById('active_sinav').innerHTML = sinav
  document.getElementById('active_ders').innerHTML = ders

  document.getElementById('selected_ders').value = ders_id
}
