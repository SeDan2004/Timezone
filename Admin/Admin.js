
let SelectButton = $('.ModulesDiv').children()[1],
file_link,
PropsAndMethodsObjCopy;
$('body')[0].style.height = screen.height + 'px';

SelectButton.addEventListener('click', OpenAndCloseSelect);

$.ajax({

  method: "POST",
  url: 'Upload.php',
  data: {caller: 'Admin.js'},
  success: function (arg) 
  {

    arg = JSON.parse(arg);
    //arg.push(1, 2, 3, 4)
    HR_Row = 1;
    str = '"';
    iter = 0;
    CsvTable = $('.CsvTable')[0];

    for (let i = 0; i < arg.length ; i++) 
    {

      h2 = document.createElement('h2');
      h2.innerText = arg[i];
      h2.classList.add('h2Elem');
      h2.style.gridArea = `num${i + 1}`;

      CsvTable.appendChild(h2);

      if (iter !== 4) 
      {
        str += `num${i + 1} `;
        iter++;
      } 
      else 
      {
        str += `num${i + 1}"\n`;
        str += `"HR${HR_Row} HR${HR_Row} HR${HR_Row} HR${HR_Row} HR${HR_Row}"\n"`;

        div = document.createElement('div');
        div.style.gridArea = `HR${HR_Row}`;
        div.classList.add('DivHr');

        if (arg.length > 5) {
          CsvTable.appendChild(div);
        }

        iter = 0;
        HR_Row++;
      }

    }

    point = 5 - iter;
    m = 0;

    while (m < point) 
    {
      m === point - 1 ? str += '."' : str += '. ';
      m++;
    }

    CsvTable.style.gridTemplateAreas = str;

    All_H2 = Array.from(CsvTable.querySelectorAll('h2'));

    All_H2.forEach((arg) => {
      arg.addEventListener('click', LoadCsv);
    })
    

  }

})

function LoadCsv() 
{
  $.ajax({
    method: "POST",
    url: "./Admin_Tools/PHPCSV.php",
    data: {name: this.innerText},
    success: function (arg) {
      console.log(arg);
    }
  })
}

function UpdateSetting()
{
  Option = this.parentNode.childNodes[0];
  OptionText = Option.innerText;
  OptionText = OptionText.slice(0, OptionText.indexOf(':'));
  
  Value = prompt(`Укажите новое значение для ${OptionText}`);

  if (typeof Value === 'string')
  {
    Option.innerText = OptionText + `: ${Value}`;

    $.ajax({
      method: "POST",
      url: "UpdateSetting.php",
      data: {val: Value, prop: OptionText, file: file_link},
      success: function (arg)
      {
        console.log(arg)
      }
    })

  }

}

function CheckColorAndClickFunc()
{

  this.style.transition = '0.3s';

  if ( event.type === 'mouseenter' )
  {
    if ( this.classList.contains('removeColor') ) this.classList.remove('removeColor');

    this.classList.add('setColor');
  }

  if ( event.type === 'mouseout' )
  {
    this.classList.toggle('setColor');
    this.classList.add('removeColor');
  }

  if ( event.type === 'mousedown' )
  {
    this.style.transition = '0s';
    this.style.boxShadow = '0px 0px 10px inset black';
  }

  if ( event.type === 'mouseup' )
  {
    this.style.transition = '0s';
    this.style.boxShadow = 'none';
  }

  if ( event.type === 'click' )
  {
    file_link = this.innerText.toLowerCase();
    AllModules = $('.AllModules')[0];

    ModulesList = document.createElement('div');
    ModulesList.classList.add('ModulesList');

    Current_obj = PropsAndMethodsObjCopy[event.target.innerText];

    for (i in Current_obj)
    {
      h2 = document.createElement('h2');
      OptionDiv = document.createElement('div')
      inp = document.createElement('input');

      h2.innerText = i + ': ' + Current_obj[i];
      OptionDiv.classList.add('ModuleOptionDiv')
      inp.type = 'button';
      inp.value = 'Редактировать';

      inp.addEventListener('click', UpdateSetting);

      OptionDiv.appendChild(h2);
      OptionDiv.appendChild(inp);
      ModulesList.appendChild(OptionDiv);
    }

    CloseInp = document.createElement('input');
    CloseInp.type = 'button';
    CloseInp.value = 'Закрыть';
    CloseInp.classList.add('CloseInput')

    ModulesList.appendChild(CloseInp);
    
    CloseInp.addEventListener('click', () => 
    {
      ModulesList.style.opacity = '0%';
      
      
      setTimeout(() => {
        ModulesList.remove();
        AllModules.style.visibility = 'visible';
        AllModules.style.position = 'relative';
        AllModules.style.opacity = '100%';
      }, 900)
      
    })

    $('body')[0].append(ModulesList);

    AllModules.style.opacity = '0%';
    
    setTimeout(() => {
      AllModules.style.position = 'absolute';
      AllModules.style.visibility = 'hidden';
      ModulesList.style.opacity = '100%';
    }, 700)

  }

}

function OpenAndCloseSelect()
{
  if ( getComputedStyle(SelectButton).transform === 'none' )
  {
    SelectButton.style.transform = 'rotate(90deg)';
    AllOptions = document.createElement('div');
    AllOptions.classList.add('AllOptionsDiv');

    $('.AllModules').append(AllOptions);
    
    $.ajax({
      method: "POST",
      url: '/Modules/main.php',
      data: {caller: 'admin'},
      success: function (arg) 
      {
        arg = JSON.parse(arg);
        key = Object.keys(arg);

        PropsAndMethodsObjCopy = {...arg};
        
        for (i = 0; i < key.length; i++)
        {
          div = document.createElement('div');
          div.classList.add('OptionDiv');
          div.innerText = key[i];

          AllOptions.appendChild(div);
        }

        SelectButton.removeEventListener('click', OpenAndCloseSelect);
        TweenMax.to($('.OptionDiv'), 0.5, {top: '0rem'});
        
        setTimeout(() => {

          $('.OptionDiv').each((ind, elem) => {
            elem.addEventListener('mouseenter', CheckColorAndClickFunc);
            elem.addEventListener('mouseout', CheckColorAndClickFunc);
            elem.addEventListener('mousedown', CheckColorAndClickFunc);
            elem.addEventListener('mouseup', CheckColorAndClickFunc);
            elem.addEventListener('click', CheckColorAndClickFunc);
          })

          SelectButton.addEventListener('click', OpenAndCloseSelect);

        }, 600);
    
      }
    })

  }
  else
  {
    SelectButton.style.transform = 'none';
    
    $('.AllOptionsDiv')[0].childNodes.forEach((elem) => {
      elem.style.transition = 'none';
    })

    SelectButton.removeEventListener('click', OpenAndCloseSelect);
    TweenMax.to($('.OptionDiv'), 0.5, {top: '-10rem'});
    
    setTimeout(() => {
      $('.AllOptionsDiv').remove();
      SelectButton.addEventListener('click', OpenAndCloseSelect);
    }, 600)

  }

}

