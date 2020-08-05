document.addEventListener('DOMContentLoaded', function() {
    let form = document.getElementById('formSend');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let formData = new FormData(form),
            http = new XMLHttpRequest();
        http.responseType = 'json';
        http.onload = () => {
            alert(http.response.message);
        };
        http.onerror = () => {

        };
        http.open('POST', '/load-products');
        http.setRequestHeader("Content-Type", "application/json");
        http.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        http.send(JSON.stringify({
            resource: formData.get('resource')
        }));
    });
});
