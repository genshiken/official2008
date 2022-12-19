'use strict';

(() => {
  const formatDateInterval = () => {
    const dateEl = document.querySelector('#clock')
    const formatter = Intl.DateTimeFormat('en-US', { dateStyle: 'full', timeStyle: 'long' })
    const setDate = () => {
      dateEl.textContent = formatter.format(new Date())
    }
    setDate()
    setInterval(setDate, 1000)
  }

  if (document.readyState !== 'loading') {
    formatDateInterval()
  } else {
    document.addEventListener('DOMContentLoaded', formatDateInterval)
  }
})()
