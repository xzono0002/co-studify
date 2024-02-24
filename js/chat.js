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

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../php/function-class/insert_chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = "";
        // bot();
        scrollToBottom();
      }
    }
  }

  let formData = new FormData(form);
  xhr.send(formData);

}

chatBox.onmouseenter = () => {
  chatBox.classList.add("active");
}

chatBox.onmouseleave = () => {
  chatBox.classList.remove("active");
}

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../php/function-class/get_chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")) {
          scrollToBottom();
        }
      }
    }
  }
  let formData = new FormData(form);
  xhr.send(formData);
}, 500);

function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
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

function showSidebar()
  {
    const sideBar = document.querySelector(".nav_menu")
    sideBar.style.display = 'flex'
  }
function showSidebar1()
{
  const sideBar = document.querySelector(".menu")
  const sideBar1 = document.querySelector(".nav_menu")
  sideBar.style.display = 'flex'
  sideBar1.style.display = 'flex'
}
function onHidebar()
  {
    const sideBar = document.querySelector(".menu")
    sideBar.style.display = '';
    const sideBar1 = document.querySelector(".nav_menu")
    sideBar1.style.display = '';
  }

