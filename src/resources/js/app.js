import "./bootstrap";

document.getElementById('reportForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const nicknameValue = document.getElementById('nicknameInput').value;
    window.location.href = '/report/' + nicknameValue;
});
