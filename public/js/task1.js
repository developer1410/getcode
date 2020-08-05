document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('send-request').addEventListener('click', (e) => {
        let http = new XMLHttpRequest();
        http.onload = () => {
            let blockB = document.getElementById('blockB');
            eval("var jsonDataFormatted =   ("+http.responseText+")");
            blockB.innerHTML = jsonDataFormatted;
            eval(blockB.getElementsByTagName('script')[0].innerText);
        };
        http.open('GET', 'https://nowdialogue.com/api/merchant/48/widget/presets/86');
        http.send();
    });
});
