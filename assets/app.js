/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
let bootstrap = require('bootstrap');

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

let $ = require('jquery');
global.jQuery = $;
window.jQuery = $;
window.$ = $;

const routes = require('/public/js/fos_js_routes.json');
import Routing from '/vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

Routing.setRoutingData(routes);
console.log(Routing);
global.Routing = Routing;

import ('./js/degree.js');
import ('./js/activateTab');
import ('./js/savedDeal.js');
