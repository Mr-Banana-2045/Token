window.onload = function() {
    fetch('generate_token.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById("txt").innerHTML = data.token;
    fetch(`check_token.php?token=${data.token}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('message').innerText = data.text;
            document.getElementById('out').innerHTML = data.out;
        });
        });
};
