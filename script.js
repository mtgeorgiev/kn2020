
const responseCallback = response => {
    document.querySelector('#small-div input').value = response.text;
}

const onClickParent = event => {
    
    fetch('./request1.php').then(response=>response.json()).then(responseCallback);
    
    // event.target.querySelector('#small-div input').value = "asdsdagasfg";
};

const formSubmit = (event) => {
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
}

window.addEventListener('load', () => {
    document.getElementById('form').addEventListener('submit', formSubmit);

    // document.querySelector('#content').addEventListener('click', onClickParent);
});



