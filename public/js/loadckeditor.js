function loadEditor(no, placeholder) {
  ClassicEditor.create(document.querySelector('#editor' + no), {
    placeholder: placeholder,

    list: {
      properties: {
        styles: true,
        startIndex: false,
        reversed: false,
      },
    },
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

loadEditor(1, 'Soru kapsamında verilecek bilgileri, ve şartları buraya yazınız')
loadEditor(2, 'Soru içeriğini, neyin arandığını buraya yazınız')

function selectSinavDers(sinav, ders, ders_id) {
  document.getElementById('baslik').innerHTML = sinav + ' / ' + ders
  document.getElementById('active_sinav').innerHTML = sinav
  document.getElementById('active_ders').innerHTML = ders
  document.getElementById('sders').value = ders_id
}
