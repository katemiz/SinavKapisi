function changeCursor(el, isIn) {
  if (isIn) {
    el.classList.add('finger')
  } else {
    el.classList.remove('finger')
  }
}
