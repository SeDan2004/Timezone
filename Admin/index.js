let AcceptButton = document.querySelector('.AcceptButton');

    AcceptButton.addEventListener('click', CheckAdmin);

    function CheckAdmin() {
        
        nickname = $('.Auth')[0].children[1].value
        pass = $('.Pass')[0].children[1].value;

        if (nickname.length === 0 || pass.length === 0) {
          alert('Не введены данные в поле!');
          return;
        }

        bool = Array.from(nickname).filter(arg => arg === ' ').length === nickname.length ||
        Array.from(pass).filter(arg => arg === ' ').length === pass.length;

        if (bool) {
          alert('Одна из строк содержит одни пробелы!');
          return;
        }

        document.cookie = `nickname = ${nickname}`;
        document.cookie = `pass = ${pass}`;

        document.location.href = '/Admin/Admin.php';

    }