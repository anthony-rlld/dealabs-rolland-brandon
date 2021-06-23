import { Tab } from 'bootstrap'

if (window.location.href.indexOf("user") > -1) {
    const hash = location.hash.replace(/^#/, '');  // ^ means starting, meaning only match the first hash

    if (hash) {
        var triggerEl = document.querySelector('#' + hash);
        const tab = new Tab(triggerEl);
        tab.show();
    }
}