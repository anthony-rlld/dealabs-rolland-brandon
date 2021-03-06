/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
require('bootstrap');

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

let $ = require('jquery');
global.jQuery = $;
window.jQuery = $;
window.$ = $;

const routes = require('/public/js/fos_js_routes.json');
import Routing from '/vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

Routing.setRoutingData(routes);

global.Routing = Routing;

import ('./js/degree.js');
