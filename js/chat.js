botList = document.querySelector(".bot_list");
var loader = document.getElementById("preloader");

window.addEventListener("load", function () {

  loader.style.display = "none";
})

// textbox cursor position
var input = document.getElementById('input');
var isFocused = false;

input.addEventListener('focus', function () {
  isFocused = true;
});

input.addEventListener('blur', function () {
  isFocused = false;
});

document.addEventListener('mousedown', function (event) {
  if (event.target !== input) {
    input.blur();
  }
});

input.addEventListener('mousedown', function (event) {
  if (!isFocused) {
    isFocused = true;
    input.focus();
    setCursorPositionToEnd(input);
  }
});

// Function to set the cursor position to the end of the input

function setCursorPositionToEnd(element) {
  element.selectionStart = element.value.length;
  element.selectionEnd = element.value.length;
}



//bot display

let xhr = new XMLHttpRequest();
xhr.open("GET", "../php/function-class/bot_selection.php", true);
xhr.onload = () => {
  if (xhr.readyState === XMLHttpRequest.DONE) {
    if (xhr.status === 200) {
      let data = xhr.response;
      botList.innerHTML = data;
    }
  }
}
xhr.send();



//chat function
const form = document.querySelector(".forms"),
  incoming_id = form.querySelector(".incoming_id").value,
  inputField = form.querySelector(".input_text"),
  sendBtn = form.querySelector("button"),
  chatBox = document.querySelector(".chat_box");
const context = [];

form.onsubmit = (e) => {
  e.preventDefault();
}

sendBtn.onclick = () => {

  if(inputField.value){
    const message = `
        <div class="message my_message">
          <p>  ${input.value} </p>
        </div>
    `
    chatBox.innerHTML += message
    scrollToBottom();
    bot()
    input.value = null
}
}

function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}

function bot() {
  var http = new XMLHttpRequest()
  var data = new FormData()
  data.append('prompt', input.value)
  http.open('POST', '../request.php', true)
  http.send(data)
  setTimeout(() => {
    chatBox.innerHTML += `
          <div class="bot_message response">
              <div class="pre-img">
                  <img class = "preload" src="../images/preload.gif" alt="preloader">
              </div>
          </div>
      `
    scrollToBottom();
  }, 1000);

  http.onload = () => {
    var response = JSON.parse(http.response)
    var replyText = processResponse(response.choices[0].text)
    var replyContainer = document.querySelectorAll('.response')
    replyContainer[replyContainer.length - 1].querySelector('div').innerHTML = replyText
    scrollToBottom();
  }
}

function processResponse(res) {
  var arr = res.split(':')
  return arr[arr.length - 1]
    .replace(/(\r\n|\r|\n)/gm, '')
    .trim()
}

//tutorial card

var tutorial = document.getElementById("help");
var body = document.getElementById("wrapper");
var emran = document.querySelectorAll(".tutorial .tuto");
var currentCard = 0;

tutorial.onclick = () => {
  body.style.opacity = "0.2";
  body.style.pointerEvents = "none";
  showCard(currentCard);
};

function showCard(cardIndex) {
  emran.forEach(function (card, index) {
    if (index === cardIndex) {
      card.style.display = "flex";
    } else {
      card.style.display = "none";
    }
  });
  updateNavigationButtons(cardIndex);
}

function updateNavigationButtons(cardIndex) {
  var backButton = emran[cardIndex].querySelector(".back");
  var forwardButton = emran[cardIndex].querySelector(".forward");
  var doneButton = document.querySelector(".done");

  if (forwardButton) {
    forwardButton.addEventListener("click", function () {
      if (cardIndex < emran.length - 1) {
        showCard(cardIndex + 1);
      }
    });
  }

  backButton.addEventListener("click", function () {
    if (cardIndex > 0) {
      showCard(cardIndex - 1);
    }
  });

  doneButton.addEventListener("click", function () {
    // Hide all tutorial cards when the "DONE" button is clicked
    emran.forEach(function (card) {
      card.style.display = "none";
      currentCard = 0;
    });
    body.style.opacity = "1";
    body.style.pointerEvents = "auto";
  });

}