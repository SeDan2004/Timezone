let TimeBlockChild = $('.CurrentTime')[0].childNodes[1],
UserExit = document.querySelector('.ExitUser');

if (UserExit !== null) {
  UserExit.addEventListener('click', ExitUserFunc);
}

function ExitUserFunc() {

  $.ajax({
    method: "POST",
    url: '/PHP_Scripts/ExitUser.php',
    success: function (arg) {
      console.log(arg);
      location.reload();
    }
  })

}

function CreateClock() {

  let time = new Date().toLocaleTimeString(),
      msc = 60000 - (new Date().getSeconds() * 1000);

  function UpdateClock() {
    CreateClock();
  }

  TimeBlockChild.innerText = time.slice(0, time.lastIndexOf(':'));

  setTimeout(UpdateClock, msc)

}

CreateClock();

