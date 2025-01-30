document.getElementById('del').addEventListener('submit', function(event) {
    event.preventDefault(); 
    const idValue = document.getElementById("input").value; 
    fetch('generate_token.php?id=' + encodeURIComponent(idValue))
        .then(response => response.json())
        .then(data => {
            if (data.token) {
                document.getElementById("txt").innerHTML = data.token;
            } else {
                document.getElementById("txt").innerHTML = 'No token received.';
            }
        })
        .catch(error => {
            console.error('Error fetching token:', error);
            document.getElementById("txt").innerHTML = 'Error fetching token.';
        });
});
