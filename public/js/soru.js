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
