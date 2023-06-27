
const textarea = document.querySelector('.chatbox-message-input')
const chatboxForm = document.querySelector('.chatbox-message-form')

textarea.addEventListener('input', function () {
  let line = textarea.value.split('\n').length

  if (textarea.rows < 6 || line < 6) {
    textarea.rows = line
  }

  if (textarea.rows > 1) {
    chatboxForm.style.alignItems = 'flex-end'
  } else {
    chatboxForm.style.alignItems = 'center'
  }
})


const chatboxToggle = document.querySelector('.chatbox-toggle')
const chatboxMessage = document.querySelector('.chatbox-message-wrapper')

chatboxToggle.addEventListener('click', function () {
  chatboxMessage.classList.toggle('show')
  // Call greetUser() when chatbox is opened
  if (chatboxMessage.classList.contains('show')) {
    greetUser()
  }
})


const dropdownToggle = document.querySelector('.chatbox-message-dropdown-toggle')
const dropdownMenu = document.querySelector('.chatbox-message-dropdown-menu')

dropdownToggle.addEventListener('click', function () {
  dropdownMenu.classList.toggle('show')
})

document.addEventListener('click', function (e) {
  if (!e.target.matches('.chatbox-message-dropdown, .chatbox-message-dropdown *')) {
    dropdownMenu.classList.remove('show')
  }
})


const chatboxMessageWrapper = document.querySelector('.chatbox-message-content')
const chatboxNoMessage = document.querySelector('.chatbox-message-no-message')

chatboxForm.addEventListener('submit', function (e) {
  e.preventDefault()

  if (isValid(textarea.value)) {
    writeMessage()
    setTimeout(autoReply, 1000)
  }
})

function addZero(num) {
  return num < 10 ? '0' + num : num
}

function writeMessage() {
  const today = new Date()
  let message = `
    <div class="chatbox-message-item sent">
      <span class="chatbox-message-item-text">
        ${textarea.value.trim().replace(/\n/g, '<br>\n')}
      </span>
      <span class="chatbox-message-item-time">${addZero(today.getHours())}:${addZero(today.getMinutes())}</span>
    </div>
  `
  chatboxMessageWrapper.insertAdjacentHTML('beforeend', message)
  chatboxForm.style.alignItems = 'center'
  textarea.rows = 1
  textarea.focus()
  textarea.value = ''
  scrollBottom()
}

function greetUser() {
  const today = new Date()
  let message = `
    <div class="chatbox-message-item received">
      <span class="chatbox-message-item-text">
        Hello! How can we assist you today?
      </span>
      <span class="chatbox-message-item-time">
        ${addZero(today.getHours())}:${addZero(today.getMinutes())}
      </span>
    </div>
  `
  chatboxMessageWrapper.insertAdjacentHTML('beforeend', message)
  scrollBottom()
}

function autoReply() {
  const today = new Date()
  let message = `
    <div class="chatbox-message-item received">
      <span class="chatbox-message-item-text">
        We're on it!Someone from our team will contact you soon.
      </span>
      <span class="chatbox-message-item-time">
        ${addZero(today.getHours())}:${addZero(today.getMinutes())}
      </span>
    </div>
  `
  chatboxMessageWrapper.insertAdjacentHTML('beforeend', message)
  scrollBottom()
}

function scrollBottom() {
  chatboxMessageWrapper.scrollTo(0, chatboxMessageWrapper.scrollHeight)
}

function isValid(value) {
  let text = value.replace(/\n/g, '')
  text = text.replace(/\s/g, '')

  return text.length > 0
}
