let FormType = location.search.slice(location.search.indexOf('=') + 1),
HomeButton = $('.Home')[0],
AuthOrRegButton = $('.AuthAndRegLink')[0]

HomeButton.addEventListener('click', () => {
  location.href='https://Timezone';
})

AuthOrRegButton.addEventListener('click', () => {
  FormType === 'reg' ?
  location.href = location.href.replace('reg', 'auth') : 
  location.href = location.href.replace('auth', 'reg');
})

function Reg()
{

  let Inputs = Array.from(document.querySelectorAll('input')),
  Warning = document.querySelector('.Warning'),
  InputsAccept = Inputs[Inputs.length - 1];

  InputsAccept.addEventListener('click', AddUser);
  Inputs.pop();

  function AddUser()
  {

    question = confirm('Вы Уверены?');

    if (!question) return;


    for (i = 0; i < Inputs.length; i++)
    {

        if (i === 3) continue;

        if (Inputs[i].value.trim().length === 0)
        {
        Warning.innerText = 'Есть пустые поля!';
        Warning.style.visibility = 'visible';
        return;
        }
    }

    if (Inputs[2].value !== Inputs[1].value)
    {
        Warning.style.visibility = 'visible';
        Warning.innerText = 'Пароли не совпадают!';
    }

    PhoneNumber = Inputs.filter(arg => arg.parentNode.classList[0] === 'NumberPhone').map((elem) => elem.value);
    m = 0;
    
    while (m < PhoneNumber.length)
    {

      if (m > 0 && m < 3 && PhoneNumber[m].length !== 3)
      {
        Warning.style.visibility = 'visible';
        Warning.innerText = 'Указан неправильный номер телефона!';
        return;
      }

      if (m > 2 && PhoneNumber[m].length !== 2)
      {
        Warning.style.visibility = 'visible';
        Warning.innerText = 'Указан неправильный номер телефона!';
        return;
      }

      if ( isNaN(PhoneNumber[m]) )
      {
        Warning.style.visibility = 'visible';
        Warning.innerText = 'В номере телефона были использованы буквы!';
        return;
      }

      m++;
    }

    Inputs_value = Inputs.map(elem => elem.value);

    '+' + Inputs_value.splice(4, Inputs_value.length, '+' + Inputs_value.slice(4).join('-'))

    delete Inputs_value[1];
    Inputs_value = Inputs_value.filter(arg => arg !== undefined);
    

     $.ajax({
      method: "POST",
      url: "/PHP_Scripts/RegAndAuthScript.php",
      data: {values: Inputs_value, type: 'reg'},
      success: function (arg)
      {

        arg = JSON.parse(arg);

        if (typeof arg === 'boolean')
        {
          location.href = 'https://timezone'
        }
        else 
        {
          Warning.style.visibility = 'visible';
          Warning.innerText = arg;
        }

      }
    })

  }

}

function Auth()
{
  let Inputs = Array.from($('input')),
  Warning = $('.Warning')[0],
  AcceptButton = $('.InputAccept')[0];

  Inputs.pop();
  AcceptButton.addEventListener('click', AuthUser);
  
  function AuthUser()
  {
    
    for (let i = 0; i < Inputs.length; i++)
    {

      if (Inputs[i].type === 'checkbox') continue;

      if ( Inputs[i].value.trim().length === 0 )
      {
        Warning.style.visibility = 'visible';
        Warning.innerText = 'Есть незаполненные поля!';
        return;
      }

    }

    Inputs = Inputs.map((arg) => {
      
      if (arg.type === 'text' || arg.type === 'password')
      {
        return arg.value
      }
      else 
      {
        return arg.checked;
      }

    })

    next_week_msc = 1000 * 60 * 60 * 24 * 7;
    date_delete = new Date();
    
    date_delete.setMilliseconds(date_delete.getMilliseconds() + next_week_msc);
    date_delete = date_delete.toLocaleDateString();

    $.ajax({
      method: "POST",
      url: '/PHP_Scripts/RegAndAuthScript.php',
      data: {type: 'auth', values: Inputs, date_delete: date_delete},
      success: function (arg) {

        console.log(arg);
        arg = JSON.parse(arg);

        if (typeof arg === 'string')
        {
          Warning.style.visibility = 'visible';
          Warning.innerText = arg;
        }
        else 
        {
          location.href='https://timezone';
        }

      }
    })

  }

}

FormType === 'reg' ? Reg() : Auth()