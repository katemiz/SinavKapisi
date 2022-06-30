function toggleShow(id) {
  const clicked = document.getElementById('box' + id)

  if (clicked.classList.contains('is-hidden')) {
    clicked.classList.remove('is-hidden')
  } else {
    clicked.classList.add('is-hidden')
  }
}
