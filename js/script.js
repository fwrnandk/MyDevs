const button = document.querySelector("#open-modal")
const modal = document.querySelector("#modalpost")
const buttonclose = document.querySelector("#close-modal")

button.onclick = function () {
  modal.showModal()
}

buttonclose.onclick = function (){
  modal.close()
}

const button1 = document.querySelector("#open-modalimg")
const modal1 = document.querySelector("#modalimg")
const buttonclose1 = document.querySelector("#close-modalimg")

button1.onclick = function () {
  modal1.showModal()
}

buttonclose1.onclick = function (){
  modal1.close()
}

const button2 = document.querySelector("#open-modalcoment")
const modal2 = document.querySelector("#modalcoment")
const buttonclose2 = document.querySelector("#close-modalcoment")

button2.onclick = function () {
  modal2.showModal()
}

buttonclose2.onclick = function (){
  modal2.close()
}

const button3 = document.querySelector("#open-modaledit")
const modal3 = document.querySelector("#modaledit")
const buttonclose3 = document.querySelector("#close-modaledit")

button3.onclick = function () {
  modal3.showModal()
}

buttonclose3.onclick = function (){
  modal3.close()
}

const openbutton4 = document.querySelector("#open-modaledit")
const modaledit = document.querySelector("#modaledit")
const closebutton4 = document.querySelector("#close-modaledit")

openbutton4.onclick = function () {
  modaledit.showModal()
}

closebutton4.onclick = function (){
  modaledit.close()
}


