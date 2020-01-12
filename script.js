const mainPage = {
    responseCallback: response => {
        document.querySelector('#small-div input').value = response.text;
    },
    onClickParent: event => {

        fetch('./request1.php').then(response=>response.json()).then(responseCallback);

        // event.target.querySelector('#small-div input').value = "asdsdagasfg";
    },
    formSubmit: (event) => {
        event.preventDefault();

        const formElement = document.querySelector('#form');

        let data = {
            'username': formElement.querySelector('input[name="username"]').value,
            'password': formElement.querySelector('input[name="password"]').value,
            'text': formElement.querySelector('textarea[name="text"]').value,
        };

        fetch('form.php', {
            method: 'POST',
            body: JSON.stringify(data),
        })
        .then(response=>response.json())
        .then(response => {
            formElement.querySelector('input[name="username"]').value = response.username;
        });
    },
};

window.addEventListener('load', () => {
    document.getElementById('form').addEventListener('submit', mainPage.formSubmit);

    // document.querySelector('#content').addEventListener('click', onClickParent);
});

/*

async login request

fetch('login.php', {
  method:'POST',
  body: JSON.stringify({
    'username': 'test1',
    'password': '0000',
 })
}).then(response=>response.json())
.then(response => {
    console.log(response);
});

*/
